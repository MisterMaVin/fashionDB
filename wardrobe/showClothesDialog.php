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
</head>
<body>
<form>
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
        <a href="<?php echo $row['photo_location'] ?>">
          <img src="<?php echo $row['photo_location']."-/scale_crop/300x300/" ?>" />
        </a>
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
