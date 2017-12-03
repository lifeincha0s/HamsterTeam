<!DOCTYPE HTML PUBLIC>

<?php
//Database connection
//if (! include ('MyersDBConnection.php')){
//die('error finding connect file');
//}
//$dbh=ConnectDB();

$survey_name=$_GET["survey_name"];
$number_of_category=$_GET["number_of_category"];
$category_counter= $_GET["number_of_category"];

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
        <h2 align="center"> <?php echo $survey_name ?> </h2>

        <form action="" method="POST">
            <!--Get Category Name-->
            <label align="center"><b>Category Name</b></label>
            <input type="text" placeholder="Enter Category <?php echo $category_counter ?> Name" id="survey_name" name="category_name<?php $category_counter ?>"
                   required value="<?php if(isset($_POST['category_name'])){echo htmlentities($_POST['category_name']);}?>">

            <!--PHP function for number of questions below-->
            <?php
            $selected_num_question='';
            function get_QuestionNum($select){
                $number_of_question = array('Select Number'=> 0,'1' => 1, '2' => 2, '3' => 3, '4' => 4, '5' => 5, '6' => 6, '7' => 7, '8' => 8, '9' => 9, '10' => 10);
                $options2 = '';
                while (list($kk, $vv) = each($number_of_question)) {
                    if($select==$vv){
                        $options2.='<option value="'.$vv.'" selected_num_question>'.$kk.'</option>';
                    }
                    else{
                        $options2.='<option value="'.$vv.'">'.$kk.'</option>';
                    }
                }
                return $options2;
            }
            if(isset($_POST['number_of_question']))
            {
                $selected_num_question=$_POST['number_of_question'];
                for($tt=1; $tt<= $selected_num_question; $tt++) {
                    echo "<br><input type=\"text\" placeholder=\"Enter question $tt\" maxlength='100' 
                        name=\"question_content_$tt\" id='category_name'required >";
                }
            }
            ?>
            <br>
            <br>
            <!--Select Number of Questions, this produces number of questions-->
            <label align="center"><b>Number of Questions</b></label>
            <select name="number_of_question" onchange="this.form.submit();">
                <?php
                echo get_QuestionNum($selected_num_ques);
                ?>
            </select>
             <br>
            <button type="submit" ; id ="next">Next</button>
    </div>
    <br>

</div>

</form>

</div>

</div>
</body>
</html>