<html>
<head>
<title>set_company</title>


<?php

setCookie('campany', 'chuo20',(time()+60*60*24), '/');
setCookie('campany_root', 'chuo20',(time()+60*60*24), '/');
setCookie('ID_Customer', 'chuo20',(time()+60*60*24), '/');
setCookie('DSN_Company', 'mysql:dbname=db_doc;host=localhost;charset=utf8',(time()+60*60*24), '/');

define('SITE_URL', 'http://localhost/m-phphidaka/');

header('Location: '.SITE_URL.'./do/login.php');
exit;
?>

</head>
<body>
    
</body>
</html>