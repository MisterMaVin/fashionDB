<?php
$conn = mysqli_connect("localhost", "root", "Qwer1234");
mysqli_select_db($conn, "fashion");
$result = mysqli_query($conn, "SELECT CODE, DESC, PARENT_CODE FROM CODE");
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
      }
    }
    checkAllObj.checked = checked;
  }
}
</script>
</head>
<body>
<form>
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
    echo "<td><input type=\"checkbox\" name=\"checkRow\" onchange=\"fnCheckAll(this)\" /></td>";
    echo "<td><a href=\"../wardrobe/showCodeDialog.php?code=".$row['code']."\">".$row['code']."</a></td>";
    echo "<td>".$row['desc']."</td>";
      echo "<td><a href=\"../wardrobe/showCodeDialog.php?code=".$row['parent_code']."\">".$row['parent_code']."</a></td>";
    echo "</tr>";
    $rowCnt++;
  }
?>
    </tbody>

  </table>

</form>

</body>
</html>
