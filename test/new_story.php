<!DOCTYPE html>
<head>
    <meta charset="utf-8"/>
    <title>Story </title>
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
            
            session_start();
            $username = $_SESSION['username'];
            if(!hash_equals($_SESSION['token'], $_POST['token'])){
                echo $_SESSION['token'];
                echo $_POST['token'];
                    die("Request forgery detected");
            }
            
            $petname = $_POST['petname'];
            $species = $_POST['species'];
            $weight=$_POST['weight'];
            $description=$_POST['description'];
            $picture=$_POST['picture'];
            
            
            $filename = basename($_FILES['picture']['name']);
            if( !preg_match('/^[\w_\.\-]+$/', $filename) ){
                echo "Invalid filename";
                exit;
            }
            $username = $_SESSION['username'];
            if( !preg_match('/^[\w_\-]+$/', $username) ){
                echo "Invalid username";
                exit;
            }
            $full_path = sprintf("/home/wushuo/public_html/new/%s", $filename); // upload file as told
            
            if( move_uploaded_file($_FILES['picture']['tmp_name'], $full_path) ){
                echo "The file ". $filename . " has been successfully uploaded";
                
            }else{
                echo "The file ". $filename . " has not been successfully uploaded! You should Do it again.";
                die();
            }
            
            
            
            
            require 'database.php';
            // create new story & link in link table
            $stmt1 = $mysqli->prepare("insert into pets(username, species,name,filename,weight,description)values ('$username', '$species','$petname','$filename','$weight','$description')");
            if(!$stmt1){
                printf("11st Query Prep Failed: %s\n", $mysqli->error);
                exit;
                }
               
                // check whether the story exist or not 
            //if(mysqli_num_rows(mysqli_query($mysqli, "select topic from pets where name = '$topic'" )) !=0){
            //printf(" the TOPIC ALREADY exists");
            //echo '<blockquote>Go to the home page!<br>';
            //echo '<form action="login-m3-home-user.php" method="POST">';
            //echo '<input type="submit" name="Back" value="Back"> ';
            //echo '</form>';
            //exit;
            //}
            // check whether the link exist or not
            //if(mysqli_num_rows(mysqli_query($mysqli, "select story_link from link where story_link = '$link'" )) !=0){
            //printf(" the LINK ALREADY exists");
            //echo '<blockquote>Go to the home page!<br>';
            //echo '<form action="login-m3-home-user.php" method="POST">';
            //echo '<input type="submit" name="Back" value="Back"> ';
            //echo '</form>';
            //exit;
            //}
            //$stmt1->bind_param('ss', $topic, $link);
            $stmt1->bind_param('ssssss', $username, $species,$petname,$picture,$weight,$description);
            $stmt1->execute();
     
            $stmt1->close();
            echo 'Submitted<br> ';
            echo $petname. $username;
            
            
    ?>
    <blockquote>Go back!<br>
                    <form action="home-user.php" method="POST">
                    <input type="hidden" name="username" value="<?php echo $_SESSION['username'];?>" />
                    <input type="submit" name="Back" value="Back"> 
                </form>
</body>
</html>