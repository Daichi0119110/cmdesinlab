<?php

require_once("config.php");
require_once("function.php");

$dbh = connectDb();
if(answerCheck($_SESSION['me']['class_id'], $_SESSION['me']['id'], $dbh)){
  $dbh = null;
  header("location: finish.php");
  exit;
}

$stmt = $dbh->query("select * from questions where class_id = ".$_SESSION['me']['class_id']);
$questions = $stmt->fetchALL(PDO::FETCH_ASSOC);
$question = $questions[countAnswer($_SESSION['me']['id'])];

?><html>
<head>
  <title>question</title>
  <!-- for-mobile-apps -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="keywords" content="Consortium Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
  Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
  <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
  		function hideURLbar(){ window.scrollTo(0,1); } </script>
  <!-- //for-mobile-apps -->
  <link rel="stylesheet" href="css/swipebox.css">
  <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
  <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
  <!-- js -->
  <script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
  <!-- //js -->
  <!--animate-->
  <link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
  <script src="js/wow.min.js"></script>
  	<script>
  		 new WOW().init();
  	</script>
  <!--//end-animate-->
  <link href='//fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
  <link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
  <script src="js/responsiveslides.min.js"></script>
  		<!-- swipe box js -->
  			<script src="js/jquery.swipebox.min.js"></script>
  				<script type="text/javascript">
  					jQuery(function($) {
  						$(".swipebox").swipebox();
  					});
  			</script>
  		<!-- //swipe box js -->
  	<!-- start-smoth-scrolling -->
  		<script type="text/javascript" src="js/move-top.js"></script>
      <script type="text/javascript" src="js/easing.js"></script>
      <script type="text/javascript" src="js/jquery.js"></script>
  		<script type="text/javascript">
  			jQuery(document).ready(function($) {
  				$(".scroll").click(function(event){
  					event.preventDefault();
  					$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
  				});
  			});
  		</script>
  	<!-- start-smoth-scrolling -->
</head>
<body>

  <div id="about" class="about all_pad text-center">
    <div class="container">
      <h3 class="title">Question No.<?php echo countAnswer($_SESSION['me']['id'])+1; ?></h3>
  <!-- 問題 -->
  <p class="question">Question:</p>
  <p><?php echo $question['question']; ?></p><br><br>

  <!-- 選択肢 -->
  <p class="answer">Choices:</p>
    <p><a class="btn button-link" data-answer="1" data-target="<?php if($question['correct'] == 1) { echo "modal-correct"; } else { echo "modal-incorrect"; } ?>" style="text-align:left;">A:  <?php echo $question['choice1']; ?></a></p>
    <p><a class="btn button-link" data-answer="2" data-target="<?php if($question['correct'] == 2) { echo "modal-correct"; } else { echo "modal-incorrect"; } ?>" style="text-align:left;">B:  <?php echo $question['choice2']; ?></a></p>
    <p><a class="btn button-link" data-answer="3" data-target="<?php if($question['correct'] == 3) { echo "modal-correct"; } else { echo "modal-incorrect"; } ?>" style="text-align:left;">C:  <?php echo $question['choice3']; ?></a></p>
    <p><a class="btn button-link" data-answer="4" data-target="<?php if($question['correct'] == 4) { echo "modal-correct"; } else { echo "modal-incorrect"; } ?>" style="text-align:left;">D:  <?php echo $question['choice4']; ?></a></p>

  <!-- ここからモーダルウィンドウ -->
  <div id="modal-incorrect">
  	<!-- モーダルウィンドウのコンテンツ開始 -->
    <img src="./images/cross.png" style="width:80%; padding:20 0 20 0;">
  	<p>Miss...</p>
  	<p><a id="modal-close" class="button-link btn" style="padding-left:10;">Next question</a></p>
     	<!-- モーダルウィンドウのコンテンツ終了 -->
  </div>

  <div id="modal-correct">
  	<!-- モーダルウィンドウのコンテンツ開始 -->
    <img src="./images/circle.png" style="width:80%; padding:20 0 20 0;">
  	<p>Great! Correct!</p>
  	<p><a id="modal-close" class="button-link btn" style="padding-left:10;">Next question</a></p>
  	<!-- モーダルウィンドウのコンテンツ終了 -->
  </div>
  <!-- ここまでモーダルウィンドウ -->

</div>
</div>
  <ul class="footer_menu">
    <li><a href="top.php">Top</a></li>
    <li><a href="qanda.php">Q&A</a></li>
    <li><a href="evaluation.php">Evaluation</a></li>
    <li><a href="ranking.php">Ranking</a></li>
  </ul>

  <script>
$(function(){
  $(".button-link").click( function(){
    //DBに保存
    $.post("answer.php", {
      "user_id": <?php echo $_SESSION['me']['id']; ?>,
      "question_id": <?php echo $question['id']; ?>,
      "answer": $(this).data("answer")
    });
  });
});
  </script>

</body>
</html>
