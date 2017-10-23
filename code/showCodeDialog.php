<?php
$conn = mysqli_connect("localhost", "root", "Qwer1234");
mysqli_select_db($conn, "fashion");
$result = mysqli_query($conn, "SELECT * FROM CODE WHERE CODE = '".$_GET['code']."'");
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="../styles/form.css">
</head>
<body>
<form>
  <table>
    <tr>
      <td class="labelRequired">코드명</td>
      <td class="field"><?php echo $row['code'] ?></td>
    </tr>
    <tr>
      <td class="label">상세</td>
      <td class="field"><?php echo $row['desc'] ?></td>
    </tr>
    <tr>
      <td class="label">부모 코드</td>
      <td><?php echo $row['parent_code'] ?></td>
    </tr>
  </table>

</form>

</body>
</html>
