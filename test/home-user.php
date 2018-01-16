<!DOCTYPE html>
<head>
    <meta charset="utf-8"/>
    <title>Story </title>
    <style type="text/css">
    body{
        /*width: 760px;  how wide to make your web page */
        /*background-color:lightslategray;  what color to make the background */
        margin: 0 auto;
        padding: 0;
        font:12px/16px Verdana, sans-serif; /* default font */
    }
    div#welcome{
        background-color:aquamarine;
        padding: 10px;
        width: 100%;
    }
    div#title{
        background-color:pink;
        padding: 10px;
        width: 100%;
    }
    p#title{
        text-align:left;
        font-family:Times New Roman;
        font-size: 30px;
        font-weight: bold;
        width: 100%;
        background-color:pink;
        padding: 10px;
        
    }
    p#welcomewords{
        text-align:center;
        font-family:fantasy;
        font-size: 60px;
        font-weight: bold;
        width: 100%;
    }
     div#welcome2{
        background-color:lightgreen;
        padding: 10px;
        width: 100%;
    }
     p#welcomewords2{
        text-align:left;
        font-family:fantasy;
        font-size: 25px;
        font-weight: bold;
        width: 100%;
        background-color:lightgreen;
        padding: 10px;
       
    }
     div#welcome3{
        background-color:lemonchiffon;
        padding: 25px;
        width: 100%;
    }
    p#welcomewords3{
        text-align:center;
        font-family:fantasy;
        font-size: 60px;
        font-weight: bold;
        width: 100%;
    }
    .loginpart{
        text-align:center;
        /*border: 2px solid black;*/
        /*position:relative;*/
        /*left: 50%;
        top: 50%;
        right: 50%;
        bottom: 50%;*/
        overflow: auto;
        width: 100%;
        margin: 50px 0px 0px 0px;
        padding-top: 25px;
        padding-bottom: 80px;

    }
    blockquote{
        border-top: 3px solid black;
        border-bottom: 3px solid black;
        font-family: Georgia, 'Times New Roman', Times, serif;
        font-size: 125%;
        font-style: italic;
        text-align:center;
        padding-top: 50px;
        padding-bottom: 50px;
    }
    </style>
</head>

<body>
    <div id="welcome">

    <p id=welcomewords>Welcome to the <del>worst</del> <ins>Best</ins> Story Website</p>

    </div>
<?php
    require 'database.php';
    session_start();
        
        $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
        
        
        //if(isset($_POST['token'])){
        //$_SESSION['checkToken'] = $_POST['token'];
        //}
        
        //if(!hash_equals($_SESSION['token'], $_POST['token'])){
        //	echo $_SESSION['token'];
        //    echo '1';
        //    echo $_POST['token'];
        //    exit;
        //    die("Request forgery detected");
        //}

        $username=$_SESSION['username'];
        echo "<p id =welcomewords3>Logged in as: $username</p></br>";
        // get story information 
        $stmt = $mysqli->prepare("select id, username, species, name,filename, weight, description from pets");
        if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }
        
    $stmt->execute();
    echo'<ul>';
    $stmt->bind_result($id ,$user, $species,$name,$filename,$weight,$description);
    // print out the information of ecah story
    while($stmt->fetch()){
        printf("<p id=title>Pet Name: %s</p>",htmlspecialchars($name));
        printf("<p id=welcomewords2>Owner: %s</p>",htmlspecialchars($user));
        printf("<p id=welcomewords2>ID: %s</p>",htmlspecialchars($id));
        $link = sprintf("onepet.php?id=%u", $id);
        //echo "<p><a href=".$link.">Read the story</a></p></br>";
        
        echo '<form name="viewstory" action="'.$link.'" method = "POST">';
        echo '<input type="hidden" name="token" value="'.$_SESSION['token'].'" />';
        echo '<p id=welcomewords4 ><input type="submit" name="create" value="View the Pet"></p>';
        echo '</form>';
        $filepath = "/home/wushuo/public_html/new/".$filename;
        $filedisppath = "/~wushuo/new/".$filename;
        $fileinfo = pathinfo($filepath);
        printf("<img class = \"displayed\" src = \"%s\" >",$filedisppath);
        
        //$link = sprintf("storyandcomment.php?topic=%s", $topic);
        //echo "<p><a href=".$link.">Read the story</a></p></br>";
        
        //echo '<form name="viewpet" action="'.$link.'" method = "POST">';
        //echo '<input type="hidden" name="token" value="'.$_SESSION['token'].'" />';
        
        //echo '<p id=welcomewords4 ><input type="submit" name="create" value="View the pet"></p>';
        //echo '</form>';
        
    }
    

    $stmt->close();
    
    
?>
    
    
        <blockquote>
            <br>add Your own pet!<br>
            <form action="add-1.php" method="POST">
            <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
            <input type="submit" name="addstory" value="SHARE">
            
        </form>
            <br>
            
            
        </blockquote>
        
    </div>
</body>
</html>