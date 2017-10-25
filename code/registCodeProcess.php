<?php
// 1. connect to DB
require("../config/config.php");
require("../lib/db.php");

$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);

// 2. insert
$sql = "INSERT INTO CODE (`CODE`, `CODE_KO`, `DESC`, `PARENT_CODE`) VALUES('".$_POST['code']."', '".$_POST['code_ko']."', '".$_POST['desc']."', '".$_POST['parent_code']."')";

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
