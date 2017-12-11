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

function saveSQL(){
   cat1JS= <?php echo $cat1JS; ?>;
   cat2JS= <?php echo $cat2JS; ?>;
   cat3JS= <?php echo $cat3JS; ?>;
   cat4JS= <?php echo $cat4JS; ?>;
   cat5JS= <?php echo $cat5JS; ?>;
		    
    if(cat1JS.length!=0){
    var cat1Score = 0;
	for(i=0;i<cat1JS.length;i++){
	   cat1Score += checkedAnswer(cat1JS[i]);
	}
	var scj1 = Math.round(cat1Score/cat1JS.length);
        document.getElementById('sc1').value=scj1;
    }
    if(cat2JS.length!=0){
    var cat2Score = 0;
        for(j=0;j<cat2JS.length;j++){
           cat2Score += checkedAnswer(cat2JS[j]);
	}
	var scj2 =  Math.round(cat2Score/cat2JS.length);
        document.getElementById('sc2').value=scj2;
    }
    if(cat3JS.length!=0){
    var cat3Score = 0;
        for(k=0;k<cat3JS.length;k++){
           cat3Score += checkedAnswer(cat3JS[k]);
        }
        var scj3 =  Math.round(cat3Score/cat3JS.length);
        document.getElementById('sc3').value=scj3;
    }
    if(cat4JS.length!=0){
    var cat4Score = 0;
        for(l=0;l<cat4JS.length;l++){
           cat4Score += checkedAnswer(cat4JS[l]);
        }
        var scj4 =  Math.round(cat1Score/cat4JS.length);
        document.getElementById('sc4').value=scj4;
    }
    if(cat5JS.length!=0){
    var cat5Score = 0;
        for(m=0;m<cat5JS.length;m++){
           cat5Score += checkedAnswer(cat5JS[m]);
        }
        var scj5 =  Math.round(cat5Score/cat5JS.length);
        document.getElementById('sc5').value=scj5;
    }
}

function checkedAnswer(name){
	   var thisAns = document.getElementsByName(name);
	   for(j=0;j<thisAns.length;j++){
		   if(thisAns[j].checked)
			  return parseInt(thisAns[j].value);
           }
}

</script>
<html>
  <br>
        <button type="reset" onclick="clearBut()" id="reset">Clear</button>
	<button type="prev" onclick="prevTab()" id="prev">Previous</button>
        <button type="next" onclick="nextTab()" id="next">Next</button>
	<form method="post" onsubmit ="saveSQL()"action="./thankYou.php">
	      <input type="hidden" id="sc1" name="sc1">
	      <input type="hidden" id="sc2" name="sc2">
	      <input type="hidden" id="sc3" name="sc3">
	      <input type="hidden" id="sc4" name="sc4">
	      <input type="hidden" id="sc5" name="sc5">
	      <input type="hidden" id="dKey" name="dKey" value=<?php echo $distroKey?>>
  <button type="submit">Submit</button>
	</form>

</body>
</html>
