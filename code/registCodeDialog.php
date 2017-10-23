<?php
$conn = mysqli_connect("localhost", "root", "Qwer1234");
mysqli_select_db($conn, "fashion");
$result = mysqli_query($conn, "SELECT * FROM CODE WHERE CODE = '".$_GET['code']."'");
$row = mysqli_fetch_assoc($result);

$parentCodeRaw = mysqli_query($conn, "SELECT * FROM CODE WHERE PARENT_CODE = ''");
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="../styles/form.css">
<script type="text/javascript">
function fnValidate() {
  var validateDomNameArray = ["code"];
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
<form name="inputForm" method="post" target="pagehidden" action="../code/registCodeProcess.php">
  <table>
    <tr>
      <td class="labelRequired">코드명</td>
      <td class="field"><input type="text" name="code" value="<?php echo $row['code'] ?>"/></td>
    </tr>
    <tr>
      <td class="label">상세</td>
      <td class="field">
          <textarea name="desc" cols="50" rows="5"><?php echo $row['desc'] ?></textarea>
      </td>
    </tr>
    <tr>
      <td class="label">부모 코드</td>
      <td>
        <select name="parent_code">
          <option value=''>&nbsp;</option>
<?php
  $checkedExpr = "";
  while ( $parentCodeRow = mysqli_fetch_assoc($parentCodeRaw) )
  {
    $checkedExpr = $parentCodeRow['code'] == $row['parent_code'] ? "checked" : "";
    echo "<option value=\"".$parentCodeRow['code']."\" ".$checkedExpr.">".$parentCodeRow['desc']."</option>";
  }
?>
        </select>
      </td>
    </tr>
  </table>

  <input type="button" value="Apply" onclick="fnApply()" /><input type="hidden" name="isApply" value="" />
  <input type="button" value="Done" onclick="fnSubmit()" />
  <input type="button" value="Cancel" onclick="javascript:top.close();" />

</form>

<iframe name="pagehidden" style="display:none;" />

</body>
</html>
