<?php 
session_start();
if(isset($_SESSION['staff_email'])) {
	unset($_SESSION['staff_email']);
}
?>
<h3> You have successgfully logged out</h3>
