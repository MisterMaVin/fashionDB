<?php
// 1. connect to DB
$conn = mysqli_connect("localhost", "root", "Qwer1234");
mysqli_select_db($conn, "fashion");

// 2. insert
$sql = "INSERT INTO CODE (`CODE`, `DESC`, `PARENT_CODE`) VALUES('".$_POST['code']."', '".$_POST['desc']."', '".$_POST['parent_code']."')";

$result = mysqli_query($conn, $sql);
?>
<script type="text/javascript">
if ( "<?php echo $_POST['isApply'] ?>" == "true" )
{
  parent.inputForm.isApply.value = "";
  alert("Complete.");
}
else
{
  parent.location.href = "../code/showCodeDialog.php?code=<?php echo $_POST['code'] ?>";
}
</script>
