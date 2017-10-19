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
<form name="inputForm" method="post" target="pagehidden" action="../wardrobe/registWardrobeProcess.php" enctype="multipart/form-data">
  <table>
    <tr>
      <td class="labelRequired">품명</td>
      <td class="field"><input type="text" name="cloth_name" /></td>
    </tr>
    <tr>
      <td class="labelRequired">분류</td>
      <td class="field">
        <select name="category">
          <option value=""></option>
          <option value="top">상의</option>
          <option value="bottom">하의</option>
          <option value="outer">아우터</option>
          <option value="shoes">신발</option>
          <option value="handkerchief">손수건</option>
          <option value="accessory">악세서리</option>
          <option value="etc">기타</option>
        </select>
      </td>
    </tr>
    <tr>
      <td class="labelRequired">색상</td>
      <td class="field"><input type="text" name="color" /></td>
    </tr>
    <tr>
      <td class="labelRequired">사이즈</td>
      <td class="field"><input type="text" name="size" /></td>
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
      <td class="field"><input type="text" name="brand" /></td>
    </tr>
    <tr>
      <td class="labelRequired">Image</td>
      <td class="field"><input type="file" name="photo_location" /></td>
    </tr>
    <tr>
      <td class="label">비고</td>
      <td class="field"><input type="text" name="note" /></td>
    </tr>
    <!--
    <tr>
      <td>참고 코디</td>
      <td><input type="text" name="cloth_name" /></td>
    </tr>
  -->
  </table>

  <input type="button" value="Done" onclick="fnSubmit()" />
  <input type="button" value="Cancel" onclick="javascript:top.close();" />

</form>

<iframe name="pagehidden" style="display:none;" />

</body>
</html>
