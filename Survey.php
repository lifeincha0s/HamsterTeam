<!DOCTYPE HTML PUBLIC>
<?php echo"<title>".$Title."</title>"?>
<head>
  <link rel="stylesheet" type="text/css" href="./CSS_Soft/design.css">
  <link rel="stylesheet" type="text/css" href="./CSS_Soft/tab.css">
  <script type="text/javascript" src="./clear.js"></script>
 
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

$survey_ID = '1';

include 'LoadDBLocal.php';

echo"<div class='tab'>";
  for($i=0; $i<$num_cats; $i++){

   $Category= $category[$i];
   if($survey_ID==$Category[survey_ID])
{
echo"<button class='tablinks' onclick='openTab(event,".$Category[cat_ID].")'>".$Category[category_Name]."</button>";

			  }
			  } 
echo"</div>";

	  for($i=0; $i<$num_cats; $i++){
               $Category = $category[$i];
	       echo "<div id='".$Category[cat_ID]."'class='tabcontent'>";
	            for($j=0; $j<$num_questions; $j++){
       		             $Question = $question[$j];
                             if(($Category[cat_ID]==$Question[cat_ID])&&($survey_ID==$Question[survey_ID]))
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
        <button type="reset" onclick="clearBut()">Clear</button>
        <button type="submit">Next</button>
</body>
</html>
