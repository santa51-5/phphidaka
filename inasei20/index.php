<html>
<head>
<title>set_company</title>


<?php

setCookie('campany', 'inasei20',(time()+60*60*24), '/');
setCookie('campany_root', 'inasei20',(time()+60*60*24), '/');
setCookie('ID_Customer', 'inasei20',(time()+60*60*24), '/');
setCookie('campanyName', '株式会社　稲垣製作所',(time()+60*60*24), '/');
setCookie('DSN_Campany', 'mysql:dbname=db_doc;host=localhost;charset=utf8',(time()+60*60*24), '/');
//setCookie('DSN_Company', 'mysql:dbname=m-hidaka00001;host=localhost;charset=utf8',(time()+60*60*24), '/');

//define('SITE_URL', 'http://localhost/m-phphidaka/');
//define('SITE_URL', 'http://mm-system.m-hidaka.com/mm-system2/');

//header('Location: '.SITE_URL.'do/login.php');
header('Location: '.'../do/login.php');
exit;
?>

</head>
<body>
    
</body>
</html>