<?php
$conn = mysqli_connect("localhost", "root", "Qwer1234");
mysqli_select_db($conn, "fashion");
$result = mysqli_query($conn, "SELECT * FROM WARDROBE WHERE CLOTH_NO = '".$_GET['cloth_no']."'");
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="../styles/form.css">
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
</script>
</head>
<body>
<form name="inputForm" method="post" target="pagehidden" action="../registWardrobeProcess.php" enctype="multipart/form-data">
  <table>
    <tr>
      <td class="labelRequired">품명</td>
      <td class="field"><?php echo $row['cloth_name'] ?></td>
    </tr>
    <tr>
      <td class="labelRequired">분류</td>
      <td class="field"><?php echo $row['category'] ?></td>
    </tr>
    <tr>
      <td class="labelRequired">색상</td>
      <td class="field"><?php echo $row['color'] ?></td>
    </tr>
    <tr>
      <td class="labelRequired">사이즈</td>
      <td class="field"><?php echo $row['size'] ?></td>
    </tr>
    <tr>
      <td class="label">용도</td>
      <td class="field"><?php echo $row['usage'] ?></td>
    </tr>
    <tr>
      <td class="labelRequired">브랜드</td>
      <td class="field"><?php echo $row['brand'] ?></td>
    </tr>
    <tr>
      <td class="labelRequired">Image</td>
      <td class="field">
        <img src="<?php echo $row['photo_location'] ?>" height="300"/>
      </td>
    </tr>
    <tr>
      <td class="label">비고</td>
      <td class="field"><?php echo $row['note'] ?></td>
    </tr>
    <!--
    <tr>
      <td>참고 코디</td>
      <td><input type="text" name="cloth_name" /></td>
    </tr>
  -->
  </table>

</form>

</body>
</html>
