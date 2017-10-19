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
    echo "<td><input type=\"checkbox\" name=\"checkRow\" onchange=\"fnCheckAll(this)\" /></td>";
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

</body>
</html>
