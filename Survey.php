<!DOCTYPE HTML PUBLIC>
<?php echo"<title>Web-Based Survey</title>"?>
<head>
  <link rel="stylesheet" type="text/css" href="./CSS_Soft/design.css">
  <link rel="stylesheet" type="text/css" href="./CSS_Soft/tab.css">
  <script type="text/javascript" src="./Javascript/clear.js"></script>

</head>
<?php


// Connect to the database

   if (!include('MyersDBConneciton.php')) {
      die('error finding connect file');
   }

   $dbh = ConnectDB();
        require('./Question.tpl');
  $distroKey =$_GET['distributionKey'];

?>

<body>

<?php
include 'LoadDBLocal.php';

  echo"<div class='tab'>";
  for($i=0; $i<$num_cats; $i++){

   $Category= $category[$i];
			 
echo"<button class='tablinks' name='cats' onclick='openTab(event,".$Category[category_ID].")'>".$Category[category_name]."</button>";
} 
echo"</div>";

	  for($i=0; $i<$num_cats; $i++){
               $Category = $category[$i];
		    echo "<div id='".$Category[category_ID]."'class='tabcontent'>";
				  
	            for($j=0; $j<$num_questions; $j++){
       		             $Question = $question[$j];
                             if($Category[category_ID]==$Question[category_ID])
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
tab = document.getElementsByClassName("tablinks");
tab[0].click();
		    

function nextTab(){
    var tab, i, current;
    tab = document.getElementsByName("cats");
    for (i = 0; i < tab.length;i++) {
        if(tab[i].className=="tablinks active"){
             current=i;
        }
    }

    if((current!=null)&&(current!= tab.length-1))
       tab[current+1].click();
}

function prevTab(){
    var tab, i, current;
    tab = document.getElementsByName("cats");
    for (i = 0; i < tab.length;i++) {
        if(tab[i].className=="tablinks active"){
             current=i;
        }
    }
    if((current!=null)&&(current!=0))
       tab[current-1].click();
}
		    
</script>
<html>
  <br>
        <button type="reset" onclick="clearBut()" id="reset">Clear</button>
	<button type="prev" onclick="prevTab()" id="prev">Previous</button>
        <button type="next" onclick="nextTab()" id="next">Next</button>
	
<form method="post"><button type="submit" id="submit">Submit</button></form>
</body>
</html>
