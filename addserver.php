<!DOCTYPE html>
<html>
<head>

<h1>Assignment2</h1>
</head>
<ul>
<li><a  href="index.php">Add device</a></li>
  <li><a class="active" href="addserver.php">Add Server</a></li>
  <li><a  href="deletedevice.php">Remove Device</a></li>
  <li><a  href="deleteserver.php">Remove Server</a></li>
  <li><a href="monitor.php">Monitor</a></li>
 </ul> 
 <h3> Enter the ip of the server to monitor</h3> 
<form action="addserver.php" method="post">
ip:        <input type="text" name="serverip" required><br>
<input type="submit" value="add server">
</form>
<?php
if(!empty($_POST["serverip"])) {
 $x= $_POST["serverip"];  


#require "find.php";
$myfile = fopen("../db.conf", "r") or die("Unable to open file!");
eval(fread($myfile,filesize("../db.conf")));
fclose($myfile);



$conn = mysqli_connect($host,$username, $password,$database,$port);

// Check connection
if (!$conn) {
   die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully<br>";
mysqli_select_db($conn,"$database");

$tbl = "CREATE TABLE IF NOT EXISTS gan_servers ( 
                id INT(11) NOT NULL AUTO_INCREMENT,
                server VARCHAR(255) NOT NULL,
                
                PRIMARY KEY (id),
                UNIQUE (id,server) 
                )"; 
$query = mysqli_query($conn, $tbl); 
if ($query === TRUE) {
	#echo "<h3>blockedusers table created OK :) </h3>"; 
} else {
	echo "<h3>blockedusers table NOT created :( </h3>"; 
}
$sqls = "INSERT INTO gan_servers (server)
VALUES (\"$x\")";

if (mysqli_query($conn, $sqls)) {
    echo "New server '$x' added succesfully";
} else {
 echo "error server already exists";
    echo "Error: " . $sqls . "<br>" . mysqli_error($conn);
}
}

?>

</html>
