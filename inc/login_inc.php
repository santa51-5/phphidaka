<?php
$keep_time = 60*30;
 
session_start();
if (!isset($_SESSION['time'])) {
    $_SESSION['time'] = time();
}
if (time() > $_SESSION['time'] + $keep_time) {
  header('Location: '.SITE_URL.'./do/logout.php');
  //echo "終了";
    //session_unset($_SESSION['time']);
    unset($_SESSION['time']);
    unset($_SESSION['unam']);
  } else {
    // 再セット
    $_SESSION['time'] = time();
    //echo '継続します。<br />';
    //echo '開始 or 更新時間 : ' . $_SESSION['time'] . '<br />';
    //echo '終了時間 : ' . ($_SESSION['time'] + $keep_time);
}
?>
