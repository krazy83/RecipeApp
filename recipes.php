<?php
$servername = "localhost";
$username = "pragmeec_recipes";
$password = "Recipes@123";
$dbname = "pragmeec_recipes";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * from recipe";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Title: " . $row["title"]. "<br>";
       $db_img = $row['image'];
       echo "$db_img";
    }
} else {
    echo "0 results";
}

$db_img = base64_decode($db_img);
							//print_r($db_img );<br/><br/>			
	$db_img = imagecreatefromstring($db_img);
if ($db_img !== false) {	
	switch ($type) {
case "jpg":
header("Content-Type: image/jpeg");
    imagejpeg($db_img);
    break;
case "gif":
header("Content-Type: image/gif");
    imagegif($db_img);
    break;
case "png":
header("Content-Type: image/png");
    imagepng($db_img);
    break;
}
}
imagedestroy($db_img);

$conn->close();
?>