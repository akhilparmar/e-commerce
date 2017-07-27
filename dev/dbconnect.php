<?php

//connecting to the databse
$con = mysqli_connect("localhost","root","admin1234","new");
if (!$con) { //if failed display error
 die("ERROR : can not connect to database ");
}
else
{
	define('BASEURL','https://electeroniccart.tk/dev/');
	define('ROOTURL','https://electeroniccart.tk/');
}
	