<?php
// 1. connect to DB
$conn = mysqli_connect("localhost", "root", "Qwer1234");
mysqli_select_db($conn, "fashion");

// 2. get file cdnURL
$photo_location = $_POST['photo_location'];
echo "$photo_location";

// 3. insert or update
$last_id = null;
if ( $_POST['cloth_no]'] == "" )
{
  $sql = "INSERT INTO WARDROBE (`CLOTH_NAME`, `CATEGORY`, `COLOR`, `SIZE`, `USAGE`, `BRAND`, `PHOTO_LOCATION`, `NOTE`) VALUES('".$_POST['cloth_name']."', '".$_POST['category']."', '".$_POST['color']."', '".$_POST['size']."','".$_POST['usage']."','".$_POST['brand']."','".$photo_location."','".$_POST['note']."')";
  $result = mysqli_query($conn, $sql);
  $last_id = $conn->insert_id;
}
else
{
  $sql = "UPDATE WARDROBE SET ";
  $sql = $sql."`CLOTH_NAME` = '".$_POST['cloth_name']."'";
  $sql = $sql.", `CATEGORY` = '".$_POST['category']."'";
  $sql = $sql.", `COLOR` = '".$_POST['color']."'";
  $sql = $sql.", `SIZE` = '".$_POST['size']."'";
  $sql = $sql.", `USAGE` = '".$_POST['usage']."'";
  $sql = $sql.", `BRAND` = '".$_POST['brand']."'";
  $sql = $sql.", `PHOTO_LOCATION` = '".$_POST['photo_location']."'";
  $sql = $sql.", `NOTE` = '".$_POST['note']."'";
  $sql = $sql." WHERE CLOTH_NO = '".$_POST['cloth_no']."'";
  $result = mysqli_query($conn, $sql);
  $last_id = $_POST['cloth_no]'];
}
?>
<script type="text/javascript">
if ( "<?php echo $_POST['isApply'] ?>" == "true" )
{
  // parent.inputForm.isApply.value = "";
  alert("Complete.");
  parent.location.reload();
}
else
{
  parent.location.href = "../wardrobe/showClothesDialog.php?cloth_no=<?php echo $last_id ?>";
}
</script>
