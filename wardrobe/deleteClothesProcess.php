<?php
$conn = mysqli_connect("localhost", "root", "Qwer1234");
mysqli_select_db($conn, "fashion");

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
