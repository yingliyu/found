<?php
include_once '../inc/conn.php';
session_start();
$username = htmlspecialchars($_POST['username'], ENT_QUOTES);
$passwords = isset($_POST['password'])? sha1($_POST['password']):'';

$exec = "select password from users where username='$username'";
    $result = mysql_query($exec);
    if ($rs = @mysql_fetch_object($result)){

            if ($rs->password == $passwords) {//检查登陆密码
                $_SESSION['admin'] = "OK"; //检查登陆用户
                $_SESSION['user'] = $username;
                $t = time();    
                $data = date("Y-m-d H:i:s", $t);
                $ip = $_SERVER['REMOTE_ADDR'];
                $exec="update users set  lastlogintime='".$data."', lastloginip='".$ip."' where username="."'".$_POST['username']."'";
                $result=mysql_query($exec);
                $data = array(
                    "status"=>'1',
                    "message"=>'信息正确'
                    );
                echo json_encode($data);
            } else{
                $data = array(
                    "status"=>'0',
                    'message'=>'用户名或密码错误'
                    );
                echo json_encode($data);
            }
    }else{
        $data = array(
                    'status'=>'0',
                    'message'=>'用户名或密码错误'
                    );
                echo json_encode($data);
    }