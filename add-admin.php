<?php include('partials/menu.php'); ?>



<div class="main-content">
	<div class="wrapper">
      <h1>Add Admin</h1>

      <br><br>

      <?php 

         if(isset($_SESSION['add']))
         {
         	echo $_SESSION['add'];//Displaing the session message if set
         	unset($_SESSION['add']);//REmove session message
         }

      ?>

      <form action="" method="POST">
      	
      	<table class="tbl-30">
      		<tr>
      			<td>Full Name</td>
      			<td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
      		</tr>

            <tr>
	            <td>Username</td>
	            <td>
	            	<input type="text" name="username" placeholder="Your Username">
	            </td>
            </tr>

            <tr>
            	<td>Password</td>
            	<td>
            		<input type="password" name="password" placeholder="Your Password">
            	</td>
            </tr>

            <tr>
            	<td colspan="2">
            		
            		<input type="submit" name="submit" value="Add Admin" class="btn-secondary">
            	</td>
            </tr>
      		

      	</table>

      </form>
	</div>

</div>

<?php include('partials/footer.php'); ?>

<?php

//Process the Value from form and save it in database
//chexk whether the submit button is clicked is clicked or not

if(isset($_POST['submit']))
{
	// Button Clicked
	//echo "Button Clicked"

	//Get the Datta from form
	$full_name = $_POST['full_name'];
	$username = $_POST['username'];
	$password = md5($_POST['password']); //pass encryption md5


//sql query to save data into db
$sql = "INSERT INTO tbl_admin SET full_name='$full_name', username='$username', password='$password'";

//executing query and saving data into bd
$res = mysqli_query($conn, $sql) or die(mysqli_error());

//check whether the (query was executed) data is inserted or not and display appropriate message

if($res==TRUE)
{
	//Data inserted
	//echo "Data Inserted";
	//create a session variable to display message
	$_SESSION['add'] = "Admin was added successfully";
	//redicrect page to Manage admin
	header("location:".SITEURL.'admin/manage-admin.php');

}

else
{
	//Failed to Insert data
	//echo "Failed to Insert Data";
	//create a session variable to display message
	$_SESSION['add'] = "Failed to add Admin";
	//redicrect page to Add admin
	header("location:".SITEURL.'admin/add-admin.php');
}

}


?>