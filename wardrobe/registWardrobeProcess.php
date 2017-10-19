<?php
// 1. connect to DB
$conn = mysqli_connect("localhost", "root", "Qwer1234");
mysqli_select_db($conn, "fashion");

// 2. upload file
$file_name = $_FILES['photo_location']['name'];
$tmp_file = $_FILES['photo_location']['tmp_name'];

$photo_location = "../images/uploaded/".$file_name;
move_uploaded_file($tmp_file, $photo_location);

// 3. DML
$sql = "INSERT INTO WARDROBE (`CLOTH_NAME`, `CATEGORY`, `COLOR`, `SIZE`, `USAGE`, `BRAND`, `PHOTO_LOCATION`, `NOTE`) VALUES('".$_POST['cloth_name']."', '".$_POST['category']."', '".$_POST['color']."', '".$_POST['size']."','".$_POST['usage']."','".$_POST['brand']."','".$photo_location."','".$_POST['note']."')";

$result = mysqli_query($conn, $sql);
$last_id = $conn->insert_id;

// 4. redirect
header('Location: ../wardrobe/showWardrobeDialog.php?cloth_no='.$last_id);
?>
