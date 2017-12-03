<!DOCTYPE HTML PUBLIC>

<?php
//Database connection
//if (! include ('MyersDBConnection.php')){
//die('error finding connect file');
//}
//$dbh=ConnectDB();
?>

<html xmlns="http://www.w3.org/1999/html">
<head>

    <title>Survey Creation</title>

    <link rel="stylesheet" type="text/css" href="index.css">
    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
</head>

<body>

<div class="SurveyOptions">

    <div id="Selection" float="center" align="center">
        <br>
        <br>
        <br>
        <h2 align="center">Step 1</h2>

        <form action="category.php" method="get">
            <!--Get survey Name-->
            <label align="center"><b>Your Survey's Name</b></label>
            <input type="text" placeholder="Enter Title" id="survey_name" name="survey_name"
                   required value="<?php if(isset($_POST['survey_name'])){echo htmlentities($_POST['survey_name']);}?>">
            <br>
            <br>

            <!--Select Number of Category, this includes a function for number of questions-->
            <label align="center"><b>Number of Categories</b></label>
            <select name="number_of_category">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
            </select>
            <button type="submit" ; id ="next">Next</button>
    </div>
    <br>

</div>

</form>

</div>

</div>
</body>
</html>