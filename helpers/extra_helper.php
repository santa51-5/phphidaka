<?php

function html_escape($word){
    return htmlspecialchars($word, ENT_QUOTES, 'UTF-8');
}

function get_post($key){
    if(isset($_POST[$key])){
        $var = trim($_POST[$key]);
        return $var;
    }
}

function check_words($word, $length) {

    if(mb_strlen($word) === 0){
        return FALSE;
    }elseif(mb_strlen($word) > $length){
        return FALSE;
    }else{
        return TRUE;
    }
}
function tokuisaki($dbh,$campany){

    $sql = 'SELECT * FROM tb_hmaster WHERE ID_Customer = :ID_Customer LIMIT 1';
    
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':ID_Customer', $campany, PDO::PARAM_STR);
    $stmt->execute();
    
    if($stmt->rowCount() > 0 ){
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }else{
        return FALSE;
    }
}

// 配列から選択リストを作成する関数
// パラメータ：配列／選択リスト名／選択値
/* 前セット
// 選択リストの値を取得
$name = "menu1";
$selected_value = $_POST[$name];
 
// 選択リストの要素を配列に格納 → この配列からドロップダウンリストを作成
$ar_menu1 = array(
    "1"=>"PHP入門",
    "2"=>"PHPサンプルコード",
    "3"=>"PHPデータベース構築法"
);
*/
function disp_list($array, $name, $selected_value = "") {
    echo '<select name="" . $name . ">"';
    while (list($value, $text) = each($array)) {
        echo "<option ";
        if ($selected_value == $value) {
            echo " selected ";
        }
        echo ' value="'.$value.'">' . $text . "</option>";
    }
    echo "</select>";
}
// 配列から選択リストを作成する関数2
// パラメータ：配列／選択リスト名／選択値
/* 前セット
// 選択リストの値を取得
$name = "menu1";
$selected_value = $_POST[$name];
 
// 選択リストの要素を配列に格納 → この配列からドロップダウンリストを作成
$ar_menu1 = array(
    "1"=>"PHP入門",
    "2"=>"PHPサンプルコード",
    "3"=>"PHPデータベース構築法"
);
*/
// ①DB接続しSQLを発行してデータを取得
function disp_list2($sql,$Clum_name,$SESSION_value){
$dbh = get_db_connect($_COOKIE['DSN_Campany']);
//error_log(print_r($SESSION_value,true),"3","./debug.log");
$errs = array();
if ($data = Record_Load($dbh,$sql)){
//error_log(print_r(array_keys($data),true),"3","./debug.log");
    // ②テーブルのデータをoptionタグに整形
	if($SESSION_value===""){
		$data1 = '<option value selected>指定なし</OPTION>';
	}else{
		$data1 ='<OPTION value="" >指定なし</OPTION>';
	}
    foreach($data as $key1=> $value1 ){
//error_log(print_r($data,true),"3","./debug.log");
//error_log(print_r(array_keys($key1),true),"3","./debug.log");
//error_log(print_r($value1),"3","./debug.log");
        $_value1=array_column($value1,1);
        //$_value2=array_column($value1,$_value1);
        foreach($value1 as $key2 => $value2){
            //$value_column=array_column($value2,1);
//error_log(print_r($value2),"3","./debug.log");
//error_log(print_r($key1,true),"3","./debug.log");
            $data2 .= '<option value="'.$_value1[0];
		    if($SESSION_value===$_value1[0]){
			    $data2 .=' selected ';
	        }
    	    $data2 .= '">'.$_value1[1].'</option>';
        }      
    }   
}
return $data1.$data2;
}
function Create_List($_dbh,$_sql,$_clum1,$_clum2,$_SESSION_value){
	if($_data = Record_Load($_dbh,$_sql)){
        //error_log(print_r($_data,true),"3","./debug.log");
        // ②テーブルのデータをoptionタグに整形
	    if($_SESSION_value===""){
			$data1 .= '<option value selected>指定なし</OPTION>';
	    }else{
			$data1 .= '<OPTION value="" >指定なし</OPTION>';
            error_log(print_r($data1,true),"3","./debug.log");
	    }
	    foreach($_data as $data_val){
    	    $data .= '<option value="'. $data_val[$_clum1];
		    if($_SESSION_value===$data_val[$_clum1]){
			    $data .=' selected ';
		    }
    	    $data .= '">'. $data_val[$_clum2].'</option>';
	    }
        return $data1.$data;
    }
}
