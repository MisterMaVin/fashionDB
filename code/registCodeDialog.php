<?php
require("../config/config.php");
require("../lib/db.php");

$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
$parentCodeRaw = mysqli_query($conn, "SELECT * FROM CODE WHERE PARENT_CODE = ''");
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="../styles/form.css">
<script src="//code.jquery.com/jquery.min.js"></script>
<script src="../common/scripts/commonUtil.js"></script>
<script type="text/javascript">
function fnValidate(formName) {
  var validateDomNameArray = ["code", "code_ko"];
  return fnCommonValidate(validateDomNameArray, formName);
}
</script>
</head>
<body>
<form name="inputForm" method="post" target="pagehidden" action="../code/registCodeProcess.php">
  <table>
    <tr>
      <td class="labelRequired">코드명</td>
      <td class="field"><input type="text" name="code" value=""/></td>
    </tr>
    <tr>
      <td class="labelRequired">코드명(한글)</td>
      <td class="field"><input type="text" name="code_ko" value=""/></td>
    </tr>
    <tr>
      <td class="label">상세</td>
      <td class="field">
          <textarea name="desc" cols="50" rows="5"></textarea>
      </td>
    </tr>
    <tr>
      <td class="label">부모 코드</td>
      <td class="appended">
        <input type="hidden" name="parent_code" value="" />
        <select class="parent_code" onchange="fnDrawChildSelectbox(this, 'parent_code', '../code/getChildCodeList.php', 'code', 'code_ko', 'inputForm')">
          <option value=''>&nbsp;</option>
<?php
  while ( $parentCodeRow = mysqli_fetch_assoc($parentCodeRaw) )
  {
    echo "<option value=\"".$parentCodeRow['code']."\">".$parentCodeRow['code_ko']."</option>";
  }
?>
        </select>
      </td>
    </tr>
  </table>

  <input type="button" value="Apply" onclick="fnApply('inputForm')" /><input type="hidden" name="isApply" value="" />
  <input type="button" value="Done" onclick="fnSubmit('inputForm')" />
  <input type="button" value="Cancel" onclick="javascript:top.close();" />

</form>

<iframe name="pagehidden" style="display:none;" />

</body>
</html>
