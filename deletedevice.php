<!DOCTYPE html>
<html>
<head>

<h1>Assignment2</h1>
</head>
<body>
<ul>
<li><a  href="index.php">Add Device</a></li>
  <li><a href="addserver.php">Add Server</a></li>
  <li><a class="active" href="deletedevice.php">Remove Device</a></li>
  <li><a href="deleteserver.php">Remove Server</a></li>
  <li><a href="monitor.php">Monitor</a></li>
 </ul> 
 <h3> Select the device to be removed </h3>
 <?php 
 
 #require "find.php";

$myfile = fopen("../db.conf", "r") or die("Unable to open file!");
eval(fread($myfile,filesize("../db.conf")));
fclose($myfile);


$conn = mysqli_connect($host,$username, $password,$database,$port);
// Checkconnection
if (!$conn) {
   die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully<br>";
mysqli_select_db($conn,"$database");
if (!empty($_POST['delete_list1'])) 
{
foreach($_POST['delete_list1'] as $value)
										 {
														echo "$value<br>"; 
														$sql = "DELETE FROM gan_devices WHERE id=$value";

														if (mysqli_query($conn, $sql)) {
																echo "Record deleted successfully";
														} else {
																echo "Error deleting record: " . mysqli_error($conn);
														}
												
										}


}
 echo "<form action='' method=post>";
 $result = mysqli_query($conn,"SELECT id,IP, PORT, COMMUNITY  FROM gan_devices");
 echo "<table>";
 echo "<tr><th>Select</th><th>Ip</th><th>Port</th><th>Community</th></tr>";
 
 while($row = mysqli_fetch_array($result))
 {
 echo "<tr><td><input type='checkbox' name='delete_list1[]' value=$row[id]></td><td>$row[IP]</td><td>$row[PORT]</td><td>$row[COMMUNITY]</td></tr>";
 
 }
 
  echo "</table>";
 echo "<input type=submit value='delete device'>";
 echo "</form>";


 
 
 ?>

