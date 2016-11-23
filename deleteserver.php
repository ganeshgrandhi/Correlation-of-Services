<!DOCTYPE html>
<html>
<head >

<h1>Assignment2</h1>
</head>
<body>
<ul>
<li><a  href="index.php">Add Device</a></li>
  <li><a href="addserver.php">Add Server</a></li>
  <li><a  href="deletedevice.php">Remove Device</a></li>
  <li><a class="active" href="deleteserver.php">Remove Server</a></li>
  <li><a href="monitor.php">Monitor</a></li>
 </ul> 
 <h3> Select the server to be removed </h3>
 
 
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
if (!empty($_POST['delete_list2'])) 
{
foreach($_POST['delete_list2'] as $value)
										 {
														echo "$value<br>"; 
														$sql = "DELETE FROM gan_servers WHERE id=$value";

														if (mysqli_query($conn, $sql)) {
																echo "Record deleted successfully";
														} else {
																echo "Error deleting record: " . mysqli_error($conn);
														}
												
										}


}
 echo "<form action='' method=post>";
 $result = mysqli_query($conn,"SELECT id,server  FROM gan_servers");
 echo "<table>";
 echo "<tr><th>Select</th><th>Server</th></tr>";
 
 while($row = mysqli_fetch_array($result))
 {
 echo "<tr><td><input type='checkbox' name='delete_list2[]' value=$row[id]></td><td>$row[server]</td></tr>";
 
 }
 
  echo "</table>";
 echo "<input type=submit value='delete server'>";
 echo "</form>";


 
 
 ?>
