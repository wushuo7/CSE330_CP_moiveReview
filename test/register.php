    <!DOCTYPE html>
    <head>
        <meta charset="utf-8"/>
        <title>Add User </title>
        <style type="text/css">
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
    require 'database.php';
    session_start();
    $user = $_POST['username'];
    $password1 = $_POST['password'];
    $options = [
    'cost' => 12 // the default cost is 10
    ];
    // $password_en=crypt($password,$salt);
    $password_new = password_hash($password1,PASSWORD_DEFAULT,$options);
    
    // check the username exists
    if(mysqli_num_rows(mysqli_query($mysqli, "select username from petuser where username = '$user'" )) ==1){
        printf(" the username already exists");
       exit;
    }
    
    // insert the username
    $stmt = $mysqli->prepare("insert into petuser (username, password) values ('$user','$password_new')");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    

    $stmt->execute();
    
    $stmt->close();
    mkdir("/home/wushuo/users/$username",0777,true); // make a dir for the new user to store files
    chmod("/home/wushuo/users/$username",0777,true);
    
    mkdir("/home/wushuo/public_html/$username",0777,true); // make a dir for the new user to store files
    chmod("/home/wushuo/public_html/$username",0777,true);
    echo 'Creat user successfully';

?>
  <blockquote>
    <br>
    Log In here!<br>
                <form action="login.html" method="POST">
                <input type="submit" name="login" value="LOG IN"> 
            </form>
            </blockquote>
        
    </div>
</body>
</html>