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
?>