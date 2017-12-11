<html>
  <head>
    <link rel="stylesheet" type="text/css" href="./CSS_Soft/thanks.css">
  </head>
  <body>
    <div id="Thanks">  
      <h2>Thank you for submitting your survey!</h2>
      <form action="http://google.com">
	<input type="submit" value="View Results" />
      </form>
    </div>
  </body>
</html>
<?php
   if (!include('MyersDBConneciton.php')) {
      die('error finding connect file');
   }

  $dbh = ConnectDB();
   

  $sc1=$_POST['sc1'];
  $sc2=$_POST['sc2'];
  $sc3=$_POST['sc3'];
  $sc4=$_POST['sc4'];
  $sc5=$_POST['sc5'];
  $distroKey = $_POST['dKey'];
  include 'LoadDBLocal.php';

$dbh->beginTransaction();

if($sc1!="NaN"){
$sql1 ="INSERT INTO survey_result(user_ID, survey_ID, scores, category_ID) values('".$accountID."', '".$survey_ID."', '".$sc1."', '".$category[0][category_ID]."');";
$dbh->exec($sql1);
}

if($sc2!="NaN"){
$sql2 = "INSERT INTO survey_result(user_ID, survey_ID, scores, category_ID) values('".$accountID."', '".$survey_ID."', '".$sc2."', '".$category[1][category_ID]."');";
$dbh->exec($sql2);
}

if($sc3!="NaN"){
$sql3 ="INSERT INTO survey_result(user_ID, survey_ID, scores, category_ID) values('".$accountID."', '".$survey_ID."', '".$sc3."', '".$category[2][category_ID]."');";
$dbh->exec($sql3);
}

if($sc4!="NaN"){
$sql4 ="INSERT INTO survey_result(user_ID, survey_ID, scores, category_ID) values('".$accountID."', '".$survey_ID."', '".$sc4."', '".$category[3][category_ID]."');";
$dbh->exec($sql4);
}

if($sc5!="NaN"){
$sql5 ="INSERT INTO survey_result(user_ID, survey_ID, scores, category_ID) values('".$accountID."', '".$survey_ID."', '".$sc5."', '".$category[4][category_ID]."');";
$dbh->exec($sql5);
}
$dbh->commit();

?>
