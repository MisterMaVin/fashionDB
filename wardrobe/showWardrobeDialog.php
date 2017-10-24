<?php
$conn = mysqli_connect("localhost", "root", "Qwer1234");
mysqli_select_db($conn, "fashion");
$result = mysqli_query($conn, "SELECT * FROM WARDROBE");
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
  window.open("../wardrobe/registClothesDialog.php", "popup", winOpt);
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
    window.open("../wardrobe/registClothesDialog.php?cloth_no=" + checkedRowVal, "popup", winOpt);
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
    listForm.submit();
  }
  else
  {
    alert("Select at least 1 row.");
  }
}
</script>
</head>
<body>

  <input type="button" value="Create" onclick="fnCreate()" />
  <input type="button" value="Edit" onclick="fnEdit()" />
  <input type="button" value="Delete" onclick="fnDelete()" />

<form name="listForm" method="post" target="pagehidden">

  <input type="text" name="deleteClothes" />

  <table>
    <thead>
      <tr>
        <th><input type="checkbox" id="checkAll" onchange="fnCheckAll(this)" /></th>
        <th>품명</th>
        <th>분류</th>
        <th>색상</th>
        <th>사이즈</th>
        <th>용도</th>
        <th>브랜드</th>
        <th>Image</th>
        <th>비고</th>
      <tr>
    </thead>
    <tbody>
<?php
  $rowCnt = 0;
  while( $row = mysqli_fetch_assoc($result) ) {
    $rowClass = $rowCnt%2 ? "even" : "odd";

    echo "<tr class=\"".$rowClass."\">";
    echo "<td><input type=\"checkbox\" name=\"checkRow\" onchange=\"fnCheckAll(this)\" value=\"".$row['cloth_no']."\" /></td>";
    echo "<td><a href=\"../wardrobe/showClothesDialog.php?cloth_no=".$row['cloth_no']."\">".$row['cloth_name']."</a></td>";
    echo "<td>".$row['category']."</td>";
    echo "<td>".$row['color']."</td>";
    echo "<td>".$row['size']."</td>";
    echo "<td>".$row['usage']."</td>";
    echo "<td>".$row['brand']."</td>";
    echo "<td><a href=\"".$row['photo_location']."\">"."<img src=\"".$row['photo_location']."-/scale_crop/50x50/\" /></a></td>";
    echo "<td>".$row['note']."</td>";
    echo "</tr>";
    $rowCnt++;
  }
?>
    </tbody>

  </table>

</form>

<iframe name="pagehidden" style="display:none;" />

</body>
</html>
