<?php
require("../config/config.php");
require("../lib/db.php");

$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
$result = mysqli_query($conn, "SELECT * FROM WARDROBE WHERE CLOTH_NO = '".$_GET['cloth_no']."'");
$row = mysqli_fetch_assoc($result);

$categoryRaw = mysqli_query($conn, "SELECT * FROM CODE WHERE PARENT_CODE = 'cloth_category'");
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="../styles/form.css">
<script>
  UPLOADCARE_PUBLIC_KEY = "89bbd226fb29bf199354";
</script>
<script charset="utf-8" src="//ucarecdn.com/libs/widget/3.1.4/uploadcare.full.min.js"></script>
<script type="text/javascript">
function fnValidate() {
  var validateDomNameArray = ["cloth_name","category","color","size","brand","photo_location"];
  var vaildateDomName = null;

  for (var k = 0; k < validateDomNameArray.length; k++)
  {
    vaildateDomName = validateDomNameArray[k];
    if ( eval("inputForm." + vaildateDomName + ".value") === "" )
    {
      alert(vaildateDomName + " is essential.");
      return false;
    }
  }
  return true;
}
function fnSubmit() {
  if ( fnValidate() )
  {
    inputForm.submit();
  }
}
function fnApply() {
  inputForm.isApply.value = "true";
  fnSubmit();
}
</script>
</head>
<body>
<form name="inputForm" method="post" target="pagehidden" action="../wardrobe/registClothesProcess.php" enctype="multipart/form-data">

  <input type="hidden" name="cloth_no" value="<?php echo $row['cloth_no'] ?>" />

  <table>
    <tr>
      <td class="labelRequired">품명</td>
      <td class="field"><input type="text" name="cloth_name" value="<?php echo $row['cloth_name'] ?>"/></td>
    </tr>
    <tr>
      <td class="labelRequired">분류</td>
      <td class="field">
        <select name="category">
          <option value=''>&nbsp;</option>
<?php
  $selectedExpr = "";
  while ( $categoryRow = mysqli_fetch_assoc($categoryRaw) )
  {
    $selectedExpr = $categoryRow['code'] == $row['category'] ? "selected" : "";
    echo "<option value=\"".$categoryRow['code']."\" ".$selectedExpr.">".$categoryRow['desc']."</option>";
  }
?>
        </select>
      </td>
    </tr>
    <tr>
      <td class="labelRequired">색상</td>
      <td class="field"><input type="text" name="color" value="<?php echo $row['color'] ?>"/></td>
    </tr>
    <tr>
      <td class="labelRequired">사이즈</td>
      <td class="field"><input type="text" name="size" value="<?php echo $row['size'] ?>"/></td>
    </tr>
    <tr>
      <td class="label">용도</td>
      <td class="field">
        <select name="usage">
          <option value=""></option>
          <option value="outing">외출</option>
          <option value="training">츄리닝</option>
        </select>
      </td>
    </tr>
    <tr>
      <td class="labelRequired">브랜드</td>
      <td class="field"><input type="text" name="brand" value="<?php echo $row['brand'] ?>"/></td>
    </tr>
    <tr>
      <td class="labelRequired">Image</td>
      <td class="field">
        <!-- <input type="file" name="photo_location" /> -->
        <input type="hidden" role="uploadcare-uploader" name="photo_location" data-images-only="true" value="<?php echo $row['photo_location'] ?>" />
<?php if ( $row['photo_location'] != "" ) { ?>
        <div>
          <a href="<?php echo $row['photo_location'] ?>">
            <img src="<?php echo $row['photo_location']."-/scale_crop/300x300/" ?>" />
          </a>
        </div>
<?php } ?>
      </td>
    </tr>
    <tr>
      <td class="label">비고</td>
      <td class="field">
          <textarea name="note" cols="50" rows="5"><?php echo $row['note'] ?></textarea>
      </td>
    </tr>
    <!--
    <tr>
      <td>참고 코디</td>
      <td><input type="text" name="cloth_name" /></td>
    </tr>
  -->
  </table>

  <input type="button" value="Apply" onclick="fnApply()" /><input type="hidden" name="isApply" value="" />
  <input type="button" value="Done" onclick="fnSubmit()" />
  <input type="button" value="Cancel" onclick="javascript:top.close();" />

</form>

<iframe name="pagehidden" style="display:none;" />

</body>
</html>
