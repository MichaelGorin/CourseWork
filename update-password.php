<?php include('partials/menu.php'); ?>


<div class="main-content">
	<div class="wrapper">
		<h1>Change Password</h1>
		<br><br>

		<?php 
		if(isset($_GET['id']))
		{
			$id=$_GET['id'];
		}

		?>


		<form action="" method="POST">
			
			<table class="TBL-30">
				<tr>
					<td>Old Password:</td>
					<td>
						<input type="password" name="current_password" placeholder="Old Password">
					</td>
				</tr>

				<tr>
					<td>New Password:</td>
					<td>
						<input type="password" name="new_password" placeholder="New Password">
					</td>
				</tr>

				<tr>
					<td>Confirm Password</td>
					<td>
						<input type="password" name="confirm_password" placeholder="Confirm Password">
					</td>
				</tr>

				<tr>
					<td colspan="2">
						<input type="hidden" name="id" value="<?php echo $id; ?>">
						<input type="submit" name="submit" value="Change Password">
					</td>
				</tr>
				

			</table>

		</form>





	</div>
</div>

<?php
//Check whether the submit Button is clicked or not
if(isset($_POST['submit']))
{
	//echo "Clicked";

	//1 get the data from form
	$id=$_POST['id'];
	$current_password = md5($_POST['current_password']);
	$new_password = md5($_POST['new_password']);
	$confirm_password = md5($_POST['confirm_password']);



	//2 check wether the user with current id and current password exists or not

	$sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

	//execute the query
	$res = mysqli_query($conn, $sql);

	if($res==true)
	{
		//check whether data is available or not
		$count=mysqli_num_rows($res);

		if($count==1)
		{
			//User exist and password can be changed
			//echo "User found";
			//check whether the new password and confirm match or not
			if($new_password==$confirm_password)
			{
				//Update the password
				//echo "Password Match";
				$sql2 = "UPDATE tbl_admin SET 
				password='$new_password' 
				WHERE id=$id";

				//execute the query
				$res2 = mysqli_query($conn, $sql2);

				//Check whether the query executed
				if($res2==true)
				{
					//Display success message
					//redirect to manage admin page with Success
			$_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully</div>";
			//Redirect the user
			header('location:'.SITEURL.'admin/manage-admin.php');
				}
				else
				{
					//Display error message
					//redirect to manage admin page with error
			$_SESSION['change-pwd'] = "<div class='error'>Failed to Change Password</div>";
			//Redirect the user
			header('location:'.SITEURL.'admin/manage-admin.php');
				}

			}
			else
			{
				//redirect to manage admin page with error
			$_SESSION['pwd-not-match'] = "<div class='error'>Password Did not Patch</div>";
			//Redirect the user
			header('location:'.SITEURL.'admin/manage-admin.php');
			}
		}
		else
		{
			//User doesn't exist set message and redirect
			$_SESSION['user-not-found'] = "<div class='error'>User Not Found</div>";
			//Redirect the user
			header('location:'.SITEURL.'admin/manage-admin.php');
		}
	}



	//3 check whether the new pass and confirm pass match or not



	//4 change pass if all above is true



}

?>



<?php include('partials/footer.php'); ?>