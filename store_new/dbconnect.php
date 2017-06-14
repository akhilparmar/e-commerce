<?php

//connecting to the databse
$con = mysqli_connect("localhost","root","","e-commerce");
if (!$con) { //if failed display error
 die("ERROR : can not connect to database ");
}
else
{
	define('BASEURL','http://localhost/store_new/');
}
	