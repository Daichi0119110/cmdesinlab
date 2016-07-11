<?php

function connectDb(){
	try {
		return new PDO(DSN, DB_USER, DB_PASSWORD);
	} catch (PDOException $e){
		echo $e->getMessage();
		exit;
	}
}

function h($s) {
	return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}

function setToken() {
	$token = sha1(uniqid(mt_rand(), true));
	$_SESSION['token'] = $token;
}

function checkToken() {
	if (empty($_SESSION['token']) || ($_SESSION['token'] != $_POST['token'])) {
		echo "不正な処理が行われました。";
		exit;
	}
}

function emailExist($email, $dbh){
	$sql = "select * from users where email = :email limit 1";
	$stmt = $dbh->prepare($sql);
	$stmt->execute(array(":email" => $email));
	$user = $stmt->fetch();
	return $user ? true : false;
}

function userExist($facebook_id, $dbh){
	$sql = "select * from users where facebook_id = :facebook_id limit 1";
	$stmt = $dbh->prepare($sql);
	$stmt->execute(array(":facebook_id" => $facebook_id));
	$user = $stmt->fetch();
	return $user ? true : false;
}

function getuser($user_id, $dbh){
  $sql = "select * from users where id = ".$user_id." limit 1";
	$stmt = $dbh->query($sql);
	$user = $stmt->fetch(PDO::FETCH_ASSOC);
	return $user;
}

function answerCheck($class_id, $user_id, $dbh){
  // 一番最後の問題のidを取得
  $stmt = $dbh->query("select id from questions where class_id = ".$class_id);
  $questions = $stmt->fetchALL(PDO::FETCH_ASSOC);
  $last = end($questions);

  // 最後の問題の回答があるかをチェック
  $stmt = $dbh->query("select * from answers where user_id = ".$user_id." and question_id = ".$last['id']);
  $answer = $stmt->fetch(PDO::FETCH_ASSOC);
	return $answer ? true : false;
}

function evaluate($user_id, $subject, $point){
	$dbh = connectDb();
	$stmt = $dbh->query("select id from evaluations where user_id = ".$user_id." and subject = ".$subject." limit 1");
	$id = $stmt->fetch();

	if($id){
		//評価の更新
		$stmt =$dbh->query("update evaluations set evaluation = ".$point." where id = ".$id['id']);
	} else {
		//評価の新規登録
		$stmt =$dbh->query("insert into evaluations (user_id, subject, evaluation) values (".$user_id.", ".$subject.", ".$point.")");
	}
	$dbh = null;
}

function getpoint($user_id, $subject){
	$dbh = connectDb();
	$stmt = $dbh->query("select evaluation from evaluations where user_id = ".$user_id." and subject = ".$subject." limit 1");
	$evaluation = $stmt->fetch();

	if($evaluation){
		$point = $evaluation['evaluation'];
	} else {
		$point = 3;
	}
	return $point;
}

function getscore($user_id){
	$dbh = connectDb();

	// 評価の算出
	$stmt = $dbh->query("select evaluation from evaluations where subject = ".$user_id);
	$evaluations = $stmt->fetchALL(PDO::FETCH_ASSOC);
	$total = 0;
	foreach ($evaluations as $evaluation) {
		$total = $total + $evaluation['evaluation'];
	}

	// クイズ結果の算出
	$stmt = $dbh->query("select * from answers left join questions on answers.question_id = questions.id where user_id = ".$user_id);
	$answers = $stmt->fetchALL(PDO::FETCH_ASSOC);
	$correctanswer = 0;
	foreach ($answers as $answer) {
		if($answer['answer'] == $answer['correct']){
			$correctanswer = $correctanswer + 1;
		}
	}

	return $total + $correctanswer;
}

function sortStudent($students){
	$lengthArray = count($students);
	for ($i=0; $i < $lengthArray; $i++) {
		$maxelement = 0;
		$change_flg = 0;
		for ($j=0; $j < count($students); $j++) {
			if($j == 0){
				$maxelement = $students[$j];
				continue;

			}
			if($students[$j]['score'] >= $maxelement['score']){
				$maxelement = $students[$j];
				$change_flg = $j;
			}
		}

		$newArray[] = $maxelement;
		array_splice($students, $change_flg, 1);
	}
	return $newArray;
}

function countAnswer($user_id){
	$dbh = connectDb();
	$stmt = $dbh->query("select * from answers where user_id = ".$user_id);
	$answers = $stmt->fetchALL(PDO::FETCH_ASSOC);
	return count($answers);
}

?>
