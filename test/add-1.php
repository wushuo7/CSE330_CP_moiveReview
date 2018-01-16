<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
    <title>add A Story </title>
    <style type="text/css">
        div#welcome{
        background-color:aquamarine;
        padding: 10px;
        width: 100%;
    }
    
    
     p#welcomewords2{
        border-top: 3px solid black;
        border-bottom: 3px solid black;
        text-align:center;
        font-family:fantasy;
        font-size: 25px;
        font-weight: bold;
        width: 100%;
        background-color:lightgreen;
        
        padding-top: 20px;
        padding-bottom: 20px;
       
    }
    
     
        </style>
</head>

        <?php
        session_start();
        if(isset($_POST['submit'])){// check the usename 
        if(isset($_POST['username'])){
            $_SESSION['username']=$_POST['username'];
            $username=$_SESSION['username'];
            if( !preg_match('/^[\w_\-]+$/', $username) ){
            echo "Invalid username";
            exit;
                }
            }
        }
        
       if(!hash_equals($_SESSION['token'], $_POST['token'])){
                    die("Request forgery detected");
            }
        
        // creat new story topic and content
        
        ?>
        <form name ="new" action = "new_story.php" method = "POST" enctype="multipart/form-data"><br>
        <p id=welcomewords2>Pet name:</p><br>
        <p id=welcomewords2><input type= "text" name="petname"></p><br>
        
        <label><input type="radio" name="species" value="cat" checked>cat</label>
        <label><input type="radio" name="species" value="dog">dog</label>
        <label><input type="radio" name="species" value="chinchilla">chinchilla</label>
        <label><input type="radio" name="species" value="snake">snake</label>
        <label><input type="radio" name="species" value="rabbit">rabbit</label>
        
        
        <p id=welcomewords2>Pet weight:</p><br>
        <p id=welcomewords2><input type="number" name="weight" min="0"></p><br>
        Description :<input type="textarea" name="description">
        File:<input type="file" name="picture">
        <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>">
        <input type="hidden" name="username" value="<?php echo $_SESSION['username'];?>">
        <p id=welcomewords2><input type="submit" value="CREATE" class="button"></p><br>
        </form>

        
        
        </body>
        </html>