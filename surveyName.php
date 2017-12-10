<!DOCTYPE HTML PUBLIC>

<?php
//Database connection
//if (! include ('MyersDBConnection.php')){
//die('error finding connect file');
//}
//$dbh=ConnectDB();
?>

<html xmlns="http://www.w3.org/1999/html">

<script>
    var max_questions = 10;

    function addCategories() {
        var num_categories = document.getElementById("num_cat").options.selectedIndex + 1;
        var category_div = document.getElementById("categories");
        while(category_div.hasChildNodes()) {
            category_div.removeChild(category_div.lastChild);
        }
        for(i = 0; i < num_categories; i++) {
            var dynamic_cat_div = document.createElement("div");
            dynamic_cat_div.id = "category_div_" + (i+1);
            category_div.appendChild(dynamic_cat_div);
            dynamic_cat_div.appendChild(document.createTextNode("Category " + (i+1) + " name:"));
            var cat_name_input = document.createElement("input");
            cat_name_input.type = "text";
            cat_name_input.name = "categories[]";
            dynamic_cat_div.appendChild(cat_name_input);
            dynamic_cat_div.appendChild(document.createTextNode("Number of questions:"));
            var num_questions_select = document.createElement("select");
            for(j = 0; j < max_questions; j++) {
                var option = document.createElement("option");
                option.text = "" + (j+1);
                option.value = "" + j + 1;
                num_questions_select.add(option);
            }
            num_questions_select.id = "num_questions_" + (i + 1);
            dynamic_cat_div.appendChild(num_questions_select);
            var dynamic_question_div = document.createElement("div");
            dynamic_question_div.id = "question_div_" + (i+1);
            dynamic_cat_div.appendChild(dynamic_question_div);
            num_questions_select.onchange = addQuestions(num_questions_select.id, dynamic_question_div.id);
            dynamic_cat_div.appendChild(document.createElement("br"));
        }
    }

    function addQuestions(cat_id, div_id) {
        console.log(cat_id + " " + div_id);
        var num_questions = document.getElementById(cat_id).options.selectedIndex + 1;
        var question_div = document.getElementById(div_id);
        while(question_div.hasChildNodes()) {
            question_div.removeChild(question_div.lastChild);
        }
        for(var i = 0; i < num_questions; i++) {
            question_div.appendChild(document.createTextNode("Question " + (i+1)));
        }
    }
</script>

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
            <select name="number_of_category" id="num_cat" onchange="addCategories()">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
            </select>

            <div id="categories">
            </div>
            <button type="submit" ; id ="next">Next</button>
    </div>
    <br>

</div>

</form>

</div>

</div>
</body>
</html>