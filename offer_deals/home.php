<?php
session_start();
include_once 'dbconnect.php';
if (!isset($_SESSION['user_id'])) {
	header("Location: index.php");
}

$query = mysqli_query($con, "SELECT * FROM user WHERE id=".$_SESSION['user_id']);
$result = mysqli_fetch_object($query);
?>
<?php   
//including header and navigation
include "includes/header.php";
?>

<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="http://www.codingcage.com">Offer deals</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp; <?php echo $result->name; ?></a></li>
            <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp; Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
<div>//Content goes here</div>
<?php include "includes/footer.php"; ?>