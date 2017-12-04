<?php

$sql = "Select * FROM distribution_list WHERE distribution_KEY='".$distroKey."'";
$tmp = $dbh->prepare($sql);
$tmp-> execute();
$distro = $tmp->fetchALL(\PDO::FETCH_ASSOC);


$survey_ID = $distro[0][survey_ID];
$accountID = $distro[0][user_ID];


$sql = "Select * FROM category WHERE survey_ID='".$survey_ID."'";
  $tmp = $dbh->prepare($sql);
$tmp-> execute();
$category = $tmp->fetchALL(\PDO::FETCH_ASSOC);
$num_cats = count($category);



$sql = "Select * FROM question WHERE survey_ID='".$survey_ID."'";
  $tmp = $dbh->prepare($sql);
$tmp-> execute();
$question = $tmp->fetchALL(\PDO::FETCH_ASSOC);
$num_questions = count($question);


?>
