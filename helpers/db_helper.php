<?php

function get_db_connect($_DB_name) {
try{
    $dsn = $_DB_name;//DSN_master;
    $user = DB_USER;
    $password = DB_PASSWORD;
    //error_log($_DB_name,"3","./debug.log");

    $dbh = new PDO($dsn, $user, $password);
    }catch (PDOException $e){
       echo($e->getMessage());
       die();
    }
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;
}
//データベース接続inatec
function get_db_connect_Campany() {
    try{
        $dsn = DSN_Campany;
        $user = DB_USER;
        $password = DB_PASSWORD;
        
        $dbh = new PDO($dsn, $user, $password);
        }catch (PDOException $e){
           echo($e->getMessage());
           die();
        }
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbh;
    }

function usr_master_id_exists($dbh, $usrid) {

    $sql = "SELECT COUNT(ID_USRCustomer) FROM tb_usr_master where ID_USRCustomer = :ID_USRCustomer";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':ID_USRCustomer', $usrid, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if($row['COUNT(ID_USRCustomer)'] > 0 ){
        return TRUE;
    }else{
        return FALSE;
    }
}
function usr_master_id_exists2($dbh, $usrid,$campany) {

    $sql = "SELECT COUNT(ID_USRCustomer) FROM tb_usr_master where ID_USRCustomer = :ID_USRCustomer AND ID_Customer = :ID_Customer";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':ID_USRCustomer', $usrid, PDO::PARAM_STR);
    $stmt->bindValue(':ID_Customer', $campany, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if($row['COUNT(ID_USRCustomer)'] > 0 ){
        return TRUE;
    }else{
        return FALSE;
    }
}

function email_exists($dbh, $email) {

    $sql = "SELECT COUNT(id) FROM members where email = :email";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if($row['COUNT(id)'] > 0 ){
        return TRUE;
    }else{
        return FALSE;
    }
}


function insert_member_data($dbh, $mngusr_name, $mngusr_id, $mngusr_passwd){

    $mngusr_passwd = password_hash($mngusr_passwd, PASSWORD_DEFAULT);
//    $date = date('Y-m-d H:i:s');
    $sql = "INSERT INTO mngusr (mngusr_name, mngusr_id, mngusr_passwd )".
/*		", mngusr_ position,".
//		"mngusr_ FL_menu1,mngusr_ FL_menu2,mngusr_ FL_menu3,mngusr_ FL_menu4,".
		",mngusr_ FL_menu5,mngusr_ FL_menu6,mngusr_ FL_menu7,mngusr_ FL_menu8,".
		"mngusr_ FL_admin,mngusr_ FL_change,mngusr_ FL_menu9) ".
*/
		" VALUE (:mngusr_name, :mngusr_id, :mngusr_passwd) ";
/*		", :mngusr_ position,".
		":mngusr_ FL_menu1,:mngusr_ FL_menu2,:mngusr_ FL_menu3,:mngusr_ FL_menu4,".
		":mngusr_ FL_menu5,:mngusr_ FL_menu6,:mngusr_ FL_menu7,:mngusr_ FL_menu8,".
		":mngusr_ FL_admin,:mngusr_ FL_change,mngusr_ FL_menu9) "
*/  
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':mngusr_name', $mngusr_name, PDO::PARAM_STR);
    $stmt->bindValue(':mngusr_id', $mngusr_id, PDO::PARAM_STR);
    $stmt->bindValue(':mngusr_passwd', $mngusr_passwd, PDO::PARAM_STR);
/*    $stmt->bindValue(':mngusr_ position', $mngusr_ position, PDO::PARAM_STR);
    $stmt->bindValue(':mngusr_ FL_menu1', $mngusr_ FL_menu1, PDO::PARAM_STR);
    $stmt->bindValue(':mngusr_ FL_menu2', $mngusr_ FL_menu2, PDO::PARAM_STR);
    $stmt->bindValue(':mngusr_ FL_menu3', $mngusr_ FL_menu3, PDO::PARAM_STR);
    $stmt->bindValue(':mngusr_ FL_menu4', $mngusr_ FL_menu4, PDO::PARAM_STR);
    $stmt->bindValue(':mngusr_ FL_menu5', $mngusr_ FL_menu5, PDO::PARAM_STR);
    $stmt->bindValue(':mngusr_ FL_menu6', $mngusr_ FL_menu6, PDO::PARAM_STR);
    $stmt->bindValue(':mngusr_ FL_menu7', $mngusr_ FL_menu7, PDO::PARAM_STR);
    $stmt->bindValue(':mngusr_ FL_menu8', $mngusr_ FL_menu8, PDO::PARAM_STR);
    $stmt->bindValue(':mngusr_ FL_menu9', $mngusr_ FL_menu9, PDO::PARAM_STR);
    $stmt->bindValue(':mngusr_ FL_admin', $mngusr_ FL_admin, PDO::PARAM_STR);
    $stmt->bindValue(':mngusr_ FL_change', $mngusr_ FL_change, PDO::PARAM_STR);
*/
    if($stmt->execute()){
        return TRUE;
    }else{
        return FALSE;
    }
}

function select_member($dbh, $mngusr_id, $mngusr_passwd) {

    $sql = 'SELECT * FROM tb_usr_master WHERE ID_USRCustomer = :ID_USRCustomer LIMIT 1';

    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':ID_USRCustomer', $mngusr_id, PDO::PARAM_STR);
    $stmt->execute();

    if($stmt->rowCount() > 0 ){
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if( password_verify($data['id_passwd'],$mngusr_passwd)){
            return $data;
        }else{
        
            return FALSE;
        }
    }else{
//

        return FALSE;
    }
}
function select_member2($dbh, $mngusr_id, $mngusr_passwd,$campany) {

    $sql = 'SELECT * FROM tb_usr_master WHERE (ID_USRCustomer = :ID_USRCustomer AND ID_Customer = :ID_Customer ) LIMIT 1';

    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':ID_USRCustomer', $mngusr_id, PDO::PARAM_STR);
    $stmt->bindValue(':ID_Customer', $campany, PDO::PARAM_STR);
    $stmt->execute();

    if($stmt->rowCount() > 0 ){
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if( password_verify($data['id_passwd'],$mngusr_passwd)){
            return $data;
        }else{
        
            return FALSE;
        }
    }else{
//

        return FALSE;
    }
}

function select_members($dbh) {

    $sql = "SELECT mngusr_name FROM mngusr";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return $data;
}

/**
* バックトレースを表示する
*
* <code>
* //バックトレースを表示
* print_backtrace(debug_backtrace());
* </code>
*
* @param array $backtrace debug_backtraceの返値
* @return void
*/
function print_backtrace($backtrace){
   echo "<table border=\"1\" cellpadding=\"3\">";
   echo "<tr align=\"center\"><td>#</td><td>call</td><td>path</td></tr>";
   foreach ($backtrace as $key => $val){
       echo "<tr><td>".$key."</td>";
       echo "<td>".$val['function']."(".print_r($val['args'],true).")</td>";
       echo "<td>".$val['file']." on line ".$val['line']."</td></tr>";
   }
   echo "</table>";
}



//ログイン履歴
function insert_log_data($dbh, $mngusr_id,$login_log_action,$login_log_note){

    $date = date('Y-m-d H:i:s');
    $sql = "INSERT INTO login_log (login_log_ID,login_log_loginTime, login_log_action, log_ipADDRESS,login_log_name,login_log_note  )".
		" VALUE (:login_log_ID,:login_log_loginTime, :login_log_action, :log_ipADDRESS,:login_log_name,:login_log_note) ";

    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':login_log_ID', NULL, PDO::PARAM_STR);
    $stmt->bindValue(':login_log_loginTime', $date, PDO::PARAM_STR);
    $stmt->bindValue(':login_log_action', $login_log_action, PDO::PARAM_STR);
    $stmt->bindValue(':log_ipADDRESS', $_SERVER['REMOTE_ADDR'], PDO::PARAM_STR);
    $stmt->bindValue(':login_log_name', $mngusr_id, PDO::PARAM_STR);
    $stmt->bindValue(':login_log_note', $login_log_note, PDO::PARAM_STR);
    if($stmt->execute()){
        return TRUE;
    }else{
        return FALSE;
    }
}
//ログイン履歴2
function insert_log_data2($dbh, $mngusr_id,$login_log_action,$login_log_note,$_ID_Customer){

    $date = date('Y-m-d H:i:s');
    $sql = "INSERT INTO login_log (login_log_ID,login_log_loginTime, login_log_action, log_ipADDRESS,login_log_name,login_log_note,ID_Customer)".
		" VALUE (:login_log_ID,:login_log_loginTime, :login_log_action, :log_ipADDRESS,:login_log_name,:login_log_note,:ID_Customer) ";

    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':login_log_ID', NULL, PDO::PARAM_STR);
    $stmt->bindValue(':login_log_loginTime', $date, PDO::PARAM_STR);
    $stmt->bindValue(':login_log_action', $login_log_action, PDO::PARAM_STR);
    $stmt->bindValue(':log_ipADDRESS', $_SERVER['REMOTE_ADDR'], PDO::PARAM_STR);
    $stmt->bindValue(':login_log_name', $mngusr_id, PDO::PARAM_STR);
    $stmt->bindValue(':login_log_note', $login_log_note, PDO::PARAM_STR);
    $stmt->bindValue(':ID_Customer', $_ID_Customer, PDO::PARAM_STR);
    if($stmt->execute()){
        return TRUE;
    }else{
        return FALSE;
    }
}

//配列格納
function Record_Load($_dbh,$_sql){
    $sth = $_dbh -> query($_sql);
    $aryList = $sth -> fetchAll(PDO::FETCH_ASSOC);
    return $aryList;
}
//レコード数
function Record_count($_dbh,$_sql){
    
    $sth = $_dbh -> query($_sql);
    $arycount = $sth -> fetchColumn();
    return $arycount;
}
//前回のログイン情報取得
function GetPREVLOG(){
    //データベース接続
    $_dbh = get_db_connect($_COOKIE['DSN_Campany']);//_Campany();//db_***
    $errs = array();

    $_sql='SELECT login_log_loginTime FROM login_log WHERE 	ID_Customer = "'.$_COOKIE['campany'].'" and login_log_action="login" ORDER BY login_log_loginTime desc limit 1';
    $sth = $_dbh -> query($_sql);
    $GetPREVLOG = $sth -> fetchColumn();
    return $GetPREVLOG;

}



