<?php
 $servername = "localhost";
 $username = "id19365017_tubes";
 $password = "Tubes123@";
 $dbname = "id19365017_iot";
 $conn = new mysqli("$servername", "$username", "$password","$dbname");
 // Check connection
 if ($conn -> connect_errno) {
 echo "Failed to connect to MySQL: " . $conn -> connect_error;
 exit();
}
?>
