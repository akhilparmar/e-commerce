<?php 
include("../dbconnect.php");

?>
<html>
<head>
<link rel="stylesheet" href="<?php echo BASEURL; ?>assets/admin_style.css">
</head>
<body>
<div class="header-top">
	<div class="left-column">
		<h2>Admin Panel</h2>
	</div>	
	<div class="right-column">
		<div class="user_panel"><h3></h3></div>
	</div>	
</div>
<div class="clear"></div>
<div class="header-cont">
    <div class="left-column">
    	<ul class="sidebar-nav navbar-nav">
	    	<li class="nav-item active">
	            <a class="nav-link" href="<?php echo BASEURL; ?>admin/users.php">Users</a>
	        </li>
	        <li class="nav-item">
	            <a class="nav-link" href="<?php echo BASEURL; ?>admin/products.php"">Products</a>
	        </li>
	        <li class="nav-item">
	            <a class="nav-link" href="<?php echo BASEURL; ?>admin/category.php"">Category</a>
	        </li>
        </ul>
    </div>
    