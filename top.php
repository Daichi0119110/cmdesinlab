<?php

require_once("config.php");
require_once("function.php");

if($_SERVER["REQUEST_METHOD"] != "POST"){
    // ブラウザからHTMLページを要求された場合
    if($_GET["user"]){
      $dbh = connectDb();
      $_SESSION['me'] = getuser($_GET["user"], $dbh);
    } else {
      if(!$_SESSION['me']){
        header("location: index.php");
      }
    }

}else{
    // フォームからPOSTによって要求された場合
    // 新規登録
    $name = $_POST['name'];
    $class_id = $_SESSION['class_id'];

    $dbh = connectDb();
    $stmt = $dbh->query('insert into users (name, class_id, teacher_flg) values ("'.$name.'", '.$class_id.', 0)');
    $_SESSION['me'] = getuser($dbh->lastInsertId(), $dbh);
}

$dbh = null;

?>

<html>
<head>
  <title>top</title>
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
  		<h3 class="title">Choose the action</h3>
  		<div class="col-md-4 abt-grid">
  			<div class="hi-icon-wrap hi-icon-effect-7 hi-icon-effect-7b">
  				<a href="qanda.php" class="hi-icon icon1"></a>
  			</div>
  			<h4>Q&A</h4>
  		</div>
  		<div class="col-md-4 abt-grid">
  			<div class="hi-icon-wrap hi-icon-effect-7 hi-icon-effect-7b">
  				<a href="evaluation.php" class="hi-icon icon2"></a>
  			</div>
  			<h4>EVALUATION</h4>
  		</div>
  		<div class="col-md-4 abt-grid">
  			<div class="hi-icon-wrap hi-icon-effect-7 hi-icon-effect-7b">
  				<a href="ranking.php" class="hi-icon icon3"></a>
  			</div>
  			<h4>RANKING</h4>
  		</div>
      <div class="col-md-4 abt-grid">
  			<div class="hi-icon-wrap hi-icon-effect-7 hi-icon-effect-7b">
  				<a href="login.php" class="hi-icon icon4"></a>
  			</div>
  			<h4>LOGOUT</h4>
  		</div>
  		<div class="clearfix"></div>
        <a href="http://goo.gl/forms/d7Qfy37unEU5moky1" class="btn btn-warning">Feedback</a><br>
  	</div>
  </div>

  <ul class="footer_menu">
    <li><a href="top.php">Top</a></li>
    <li><a href="qanda.php">Q&A</a></li>
    <li><a href="evaluation.php">Evaluation</a></li>
    <li><a href="ranking.php">Ranking</a></li>
  </ul>

</body>
</html>
