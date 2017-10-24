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
<script src="//code.jquery.com/jquery.min.js"></script>
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
function fnDrawChildSelectbox(obj) {
  // 1. obj가 selectbox 중 몇번째 index인지 구하기
  var index = $("select.parent_code").index(obj);

  // 2. index보다 큰 selectbox 제거
  $("select.parent_code:gt(" + index + ")").each(function(){
    $(this).remove();
  });

  // 3. 입력값이 있을 때만 하위 부모 코드 조회
  var parent_code = $("select.parent_code:last").val();
  if ( parent_code !== "" )
  {
    $.ajax({
      url: "../code/getChildCodeList.php",
      type: "post",
      data: {"parent_code": parent_code}
    }).done(function(data) {
      // 4. json_encode로 encoding된 값을 parsing하기
      var parsedData = JSON.parse(data);
      var appendHTML = "<select class=\"parent_code\" onchange=\"fnDrawChildSelectbox(this)\">";
      appendHTML += "<option>&nbsp;</option>";
      var row = null;

      for (var k = 0; k < parsedData.length; k++)
      {
        row = parsedData[k];
        appendHTML += "<option value=\"" + row['code'] + "\">";
        appendHTML += row['code_ko'];
        appendHTML += "</option>";
      }

      appendHTML += "</select>";

      // 5. 화면에 rendering하기
      $("td.appended").append(appendHTML);
    });
  }
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
      <td class="labelRequired">코드명(한글)</td>
      <td class="field"><input type="text" name="code_ko" value="<?php echo $row['code_ko'] ?>"/></td>
    </tr>
    <tr>
      <td class="label">상세</td>
      <td class="field">
          <textarea name="desc" cols="50" rows="5"><?php echo $row['desc'] ?></textarea>
      </td>
    </tr>
    <tr>
      <td class="label">부모 코드</td>
      <td class="appended">
        <input type="hidden" name="parent_code" value="<?php echo $row['parent_code'] ?>" />
        <select class="parent_code" onchange="fnDrawChildSelectbox(this)">
          <option value=''>&nbsp;</option>
<?php
  $checkedExpr = "";
  while ( $parentCodeRow = mysqli_fetch_assoc($parentCodeRaw) )
  {
    $checkedExpr = $parentCodeRow['code'] == $row['parent_code'] ? "checked" : "";
    echo "<option value=\"".$parentCodeRow['code']."\" ".$checkedExpr.">".$parentCodeRow['code_ko']."</option>";
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
