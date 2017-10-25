<?php
require("../config/config.php");
require("../lib/db.php");

$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
$result = mysqli_query($conn, "SELECT * FROM CODE WHERE PARENT_CODE = '".$_POST['parent_code']."'");

// return할 json array 생성
$o = array();
while ( $row = mysqli_fetch_object($result) )
{
  $t = new stdClass();
  $t->code = $row->code;
  $t->code_ko = $row->code_ko;
  // $o[$index] = $t;
  $o[] = $t;
  unset($t);
}

echo json_encode($o, JSON_UNESCAPED_UNICODE);
?>
