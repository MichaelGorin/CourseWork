<?php

//include constants.php
include('../config/constants.php');

//1. get the id of admin to be deleted
$id = $_GET['id'];

//2. create sql query to delete admin
$sql = "DELETE FROM tbl_admin WHERE id=$id";

//execute the query
$res = mysqli_query($conn, $sql);

//check whether the query executed successfully or not
if($res==true)
{
	//Query execuetd successfully and admin deleted
	//echo "Admin Deleted";
	//Create session variable to display message
	$_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>";
	//REdirect to Manage Admin Page
	header('location:'.SITEURL.'admin/manage-admin.php');

}
else
{
	//failed to deleted admin
	//echo "Failed to Deleted Admin";
	$_SESSION['delete'] = "<div class='error'>Failed to Deleted Admin. Try Again Later</div>";
	header('location:'.SITEURL.'admin/manage-admin.php');

}

//3. Redirect to manage admin page with message (success/error)

?>