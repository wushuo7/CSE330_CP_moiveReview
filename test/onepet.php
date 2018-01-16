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
        border-top: 3px solid black;
        border-bottom: 3px solid black;
        background-color:pink;
        padding: 10px;
        width: 100%;
        padding-top: 50px;
        padding-bottom: 50px;
    }
    p#title{
        border-top: 3px solid red;
        border-bottom: 3px solid red;
        text-align:center;
        font-family:Times New Roman;
        font-size: 30px;
        font-weight: bold;
        width: 100%;
        background-color:pink;
        
        padding-top: 10px;
        padding-bottom: 10px;
        
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
        border-top: 3px solid black;
        border-bottom: 3px solid black;
        text-align:center;
        font-family:fantasy;
        font-size: 25px;
        font-weight: bold;
        width: 100%;
        background-color:yellow;
        
        padding-top: 20px;
        padding-bottom: 20px;
       
    }
    p#welcomewords23{
        text-align:center;
        font-family:fantasy;
        font-size: 40px;
        font-weight: bold;
        width: 100%;
        color: pink;
        padding: 10px;
       
    }
     div#welcome3{
        text-align:center;
        font-size: 40px;
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
    p#welcomewords4{
        text-align:center;
        font-size: 20px;
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
<?php
    session_start();
    
    $id = $_GET['id'];
    
    $username = $_SESSION['username'];
    require 'database.php';
    // select story info from the table
    $stmt = $mysqli->prepare("select name, username, species, weight,description, filename from pets where id='$id'");
    if(!$stmt){
	printf(" 1st Query Prep Failed: %s\n", $mysqli->error);
	exit;
    }

    $stmt->execute();

    $stmt->bind_result($petname,$user,$species,$weight,$comment,$filename);

    echo "<ul>";
    // print out the information
    while($stmt->fetch()){
        printf("<p id=title>Pet name: %s</p><br>",htmlspecialchars($petname));
        printf("<p>Owner: %s</p><br>",htmlspecialchars($user));
        printf("<p>Species: %s</p><br>",htmlspecialchars($species));
        printf("<p>Weight: %s</p><br>",htmlspecialchars($weight));
        printf("<p>Description: %s</p><br>",htmlspecialchars($comment));
        echo '<form name="viewstory" action="openFile.php" method = "POST">';
        echo '<input type="hidden" name="token" value="'.$_SESSION['token'].'" />';
        echo '<input type="hidden" name="openFiles" value="'.$filename.'" />';
        echo '<input type="submit" name="create" value="View the Pet">';
        echo '</form>';
        

    }
    
    $stmt->close();
    
    
   
    

?>
    
    <ul>
         <blockquote>Go to the home page!<br>
    
       <form action="home-user.php" method="POST">
    <input type="submit" name="Back" value="Back"> 
    </form>

</body>
</html>