<?php

require_once("config.php");
require_once("function.php");

$dbh = connectDb();
$stmt = $dbh->query("insert into answers (answer, user_id, question_id) values (".$_POST['answer'].", ".$_POST['user_id'].", ".$_POST['question_id'].")");

$dbh = null;
?>
