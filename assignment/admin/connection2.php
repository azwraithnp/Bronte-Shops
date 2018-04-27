<?php 
$hostname = 'localhost/xe'; 
$username = 'avinash'; 
$password = 'avinash';  
$connection = oci_connect($username, $password, $hostname) or exit("Unable to connect to database!");
?>
