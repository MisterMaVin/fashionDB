<?php
require("../config/config.php");
require("../lib/db.php");

$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);

$deleteClothesNoExpr = "";
$deleteClothesNoArray = split("\\|", $_POST['deleteClothes']);

for ($k = 0; $k < sizeof($deleteClothesNoArray); $k++)
{
  if ( $deleteClothesNoExpr != "" )
  {
    $deleteClothesNoExpr = $deleteClothesNoExpr.",";
  }
  $deleteClothesNoExpr = $deleteClothesNoExpr."'".$deleteClothesNoArray[$k]."'";
}
$result = mysqli_query($conn, "DELETE FROM WARDROBE WHERE `CLOTH_NO` IN (".$deleteClothesNoExpr.")");
?>
<script type="text/javascript">
parent.location.reload();
</script>
