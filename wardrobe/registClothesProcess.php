<?php
// 1. connect to DB
$conn = mysqli_connect("localhost", "root", "Qwer1234");
mysqli_select_db($conn, "fashion");

// 2. get file cdnURL
$photo_location = $_POST['photo_location'];
echo "$photo_location";

// 3. insert
$sql = "INSERT INTO WARDROBE (`CLOTH_NAME`, `CATEGORY`, `COLOR`, `SIZE`, `USAGE`, `BRAND`, `PHOTO_LOCATION`, `NOTE`) VALUES('".$_POST['cloth_name']."', '".$_POST['category']."', '".$_POST['color']."', '".$_POST['size']."','".$_POST['usage']."','".$_POST['brand']."','".$photo_location."','".$_POST['note']."')";

$result = mysqli_query($conn, $sql);
$last_id = $conn->insert_id;
?>
<script type="text/javascript">
if ( "<?php echo $_POST['isApply'] ?>" == "true" )
{
  parent.inputForm.isApply.value = "";
  alert("Complete.");
}
else
{
  parent.location.href = "../code/showClothesDialog.php?cloth_no=<?php echo $last_id ?>";
}
</script>
