<?php
    session_start();
    $username = $_SESSION['username'];
    if( !preg_match('/^[\w_\-]+$/', $username) ){
            echo "Invalid username";
            exit;
     }
     $filename=$_POST["openFiles"];
    if( !preg_match('/^[\w_\.\-]+$/', $filename) ){
        echo "Invalid filename";
        exit;
    }

    $filepath = "/home/wushuo/public_html/new/".$filename;
        $filedisppath = "/~wushuo/new/".$filename;
        $fileinfo = pathinfo($filepath);
        printf("<img class = \"displayed\" src = \"%s\" >",$filedisppath);

    
?>