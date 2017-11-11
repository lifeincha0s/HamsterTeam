<?php 
   // Connect to the database
   
   if (!include('connect.php')) {
      die('error finding connect file');
   }
   
   $dbh = ConnectDB();

function NewUser()
{
    $fullname = $_POST['name'];
    $userName = $_POST['user'];
    $password = $_POST['pass'];
    $query = "INSERT INTO websiteusers (fullname,userName,email,pass) VALUES ('$fullname','$userName','$password')";
    $data = mysql_query ($query)or die(mysql_error());
if($data)
{
    echo "Your Registration is Completed";
}
}
 function SignUp()

{
    if(!empty($_POST['user']))
    { $query = mysql_query("SELECT * FROM websiteusers WHERE userName = '$_POST[user]' AND pass = '$_POST[pass]'") or die(mysql_error());
    if(!$row = mysql_fetch_array($query) or die(mysql_error()))
    {
        newuser();
    }
    else
        {
            echo "ALREADY REGISTERED USER.";
        }
    }
}
if( isset($_POST['submit']))
{
    SignUp();
}

    ?>
