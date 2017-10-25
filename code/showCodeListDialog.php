<?php
require("../config/config.php");
require("../lib/db.php");

$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
$result = mysqli_query($conn, "SELECT * FROM CODE");
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="../styles/list.css">
<script type="text/javascript">
function fnCheckAll(obj) {
  var checkAllObj = document.getElementById("checkAll");
  var checked = obj.checked;
  var checkboxArray = document.getElementsByName("checkRow");

  if ( obj.id == "checkAll" )
  {
    for (var k = 0; k < checkboxArray.length; k++)
    {
      checkboxArray[k].checked = checked;
    }
  }
  else
  {
    for (var k = 0; k < checkboxArray.length; k++)
    {
      if ( checkboxArray[k].checked != checked )
      {
        checkAllObj.checked = false;
        return;
      }
    }
    checkAllObj.checked = checked;
  }
}
var winOpt = "resizable=yes,scrollbars=yes,height=500,width=400";
function fnCreate() {
  window.open("../code/registCodeDialog.php", "popup", winOpt);
}
function fnEdit() {
  var checkRowArray = document.getElementsByName("checkRow");
  var checkedRowCnt = 0;
  var checkedRowVal = null;
  for (var k = 0; k < checkRowArray.length; k++)
  {
    if ( checkRowArray[k].checked )
    {
      checkedRowCnt++;
      checkedRowVal = checkRowArray[k].value;
    }
  }

  if ( checkedRowCnt == 1 )
  {
    window.open("../code/editCodeDialog.php?code=" + checkedRowVal, "popup", winOpt);
  }
  else
  {
    alert("Select 1 row.");
  }
}
function fnDelete() {
  var checkRowArray = document.getElementsByName("checkRow");
  var checkedRowCnt = 0;
  var checkedRowVal = "";
  for (var k = 0; k < checkRowArray.length; k++)
  {
    if ( checkRowArray[k].checked )
    {
      checkedRowCnt++;

      if ( checkedRowVal !== "" )
      {
        checkedRowVal += "|";
      }

      checkedRowVal += checkRowArray[k].value;
    }
  }

  if ( checkedRowCnt > 0 )
  {
    listForm.deleteClothes.value = checkedRowVal;
    listForm.action = "../wardrobe/deleteClothesProcess.php";
  }
  else
  {
    alert("Select at least 1 row.");
  }
}
</script>
</head>
<body>
<form>

  <input type="button" value="Create" onclick="fnCreate()" />
  <input type="button" value="Edit" onclick="fnEdit()" />
  <input type="button" value="Delete" onclick="fnDelete()" />

  <table>
    <thead>
      <tr>
        <th><input type="checkbox" id="checkAll" onchange="fnCheckAll(this)" /></th>
        <th>코드명</th>
        <th>상세</th>
        <th>부모 코드</th>
      <tr>
    </thead>
    <tbody>
<?php
  $rowCnt = 0;
  while( $row = mysqli_fetch_assoc($result) ) {
    $rowClass = $rowCnt%2 ? "even" : "odd";

    echo "<tr class=\"".$rowClass."\">";
    echo "<td><input type=\"checkbox\" name=\"checkRow\" onchange=\"fnCheckAll(this)\" value=\"".$row['code']."\" /></td>";
    echo "<td><a href=\"../code/showCodeDialog.php?code=".$row['code']."\">".$row['code']."</a></td>";
    echo "<td>".$row['desc']."</td>";
    echo "<td><a href=\"../code/showCodeDialog.php?code=".$row['parent_code']."\">".$row['parent_code']."</a></td>";
    echo "</tr>";
    $rowCnt++;
  }
?>
    </tbody>

  </table>

</form>

</body>
</html>
