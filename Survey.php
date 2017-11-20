<!DOCTYPE HTML PUBLIC>
<?php echo"<title>".$Title."</title>"?>
<head>
        <link rel="stylesheet" type="text/css" href="./design.css">
</head>
        <?php
   // Connect to the database

   if (!include('MyersDBConneciton.php')) {
      die('error finding connect file');
   }

   $dbh = ConnectDB();

        $Title ='Webbased Survey';
        require('./Question.tpl');
?>

<?php

$sql = "Select * FROM category";
  $tmp = $dbh->prepare($sql);
$tmp-> execute();
$category = $tmp->fetchALL(\PDO::FETCH_ASSOC);
$num_cats = count($category);

$sql = "Select * FROM question";
  $tmp = $dbh->prepare($sql);
$tmp-> execute();
$question = $tmp->fetchALL(\PDO::FETCH_ASSOC);
$num_questions = count($question);


echo"<div class='tab'>";
  for($i=0; $i<$num_cats; $i++){
   $Category= $category[$i];
   echo"<button class='tablinks' onclick='openTab(event,".$Category[cat_ID].")'>".$Category[category_Name]."</button>";
}
echo"</div></br>";

          for($i=0; $i<$num_cats; $i++){
               $Category = $category[$i];
               echo "<div id='".$Category[cat_ID]."'class='tabcontent'>";
                    for($j=0; $j<$num_questions; $j++){
                             $Question = $question[$j];
                             if($Category[cat_ID]==$Question[cat_ID])
                             GenerateQuest($Question);
                                                 }
                                                 echo"</div>";
}


?>

<script>

function openTab(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
	    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
}

                    // Get the element with id="defaultOpen" and click on it
tab = document.getElementsByClassName("tablinks");
tab[0].click();
</script>

<html>
  <body>
    <br>
        <button type="reset">Clear</button>
        <button type="submit">Next</button>
</body>
</html>
