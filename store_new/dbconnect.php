<?php

//connecting to the databse
$con = mysqli_connect("localhost","root","admin1234","e_comm");
if (!$con) { //if failed display error
 die("ERROR : can not connect to database ");
}
else
{
	define('BASEURL','https://electeroniccart.tk/dev/');
}
	