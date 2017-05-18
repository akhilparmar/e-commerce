<?php


$con = mysqli_connect("localhost","root","","e-commerce");
if (!$con) {
 die("ERROR : can not connect to database ");
}
else
{
	define('BASEURL','http://localhost/offer_deals/');
}
	