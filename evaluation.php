<?php

require_once("config.php");
require_once("function.php");

// postだったら実行
if($_SERVER["REQUEST_METHOD"] == "POST"){
  foreach($_POST as $user => $point){
    $evaluation = explode("_", $user);

    evaluate($_SESSION['me']['id'], $evaluation[1], $point);

  }
}
$dbh = connectDb();
$stmt = $dbh->query("select * from users where teacher_flg <> 1 and class_id = ".$_SESSION['me']['class_id']." and id <> ".$_SESSION['me']['id']);
$students = $stmt->fetchALL(PDO::FETCH_ASSOC);

?>
<html>
<head>
  <title>Evaluation</title>
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
  <div id="about" class="about all_pad text-center" style="padding-bottom:0;">
    <div class="container">
      <h3 class="title">Evaluation</h3>
    </div>
  </div>
  <div class="footer" style="padding-top:0;">
  <form action="" method="post">
    <?php foreach($students as $student){ ?>
    <label><?php echo $student['name']; ?>: </label>
    <select name="point_<?php echo $student['id']; ?>">
      <option value="5" <?php if(getpoint($_SESSION['me']['id'], $student['id']) == 5){ echo "selected"; }?>>5</option>
      <option value="4" <?php if(getpoint($_SESSION['me']['id'], $student['id']) == 4){ echo "selected"; }?>>4</option>
      <option value="3" <?php if(getpoint($_SESSION['me']['id'], $student['id']) == 3){ echo "selected"; }?>>3</option>
      <option value="2" <?php if(getpoint($_SESSION['me']['id'], $student['id']) == 2){ echo "selected"; }?>>2</option>
      <option value="1" <?php if(getpoint($_SESSION['me']['id'], $student['id']) == 1){ echo "selected"; }?>>1</option>
    </select><br>
    <?php } ?>
    <br>

    <div class="text-center">
      <input type="submit" value="send" class="btn">
    </div>
  </form>

</div>

  <ul class="footer_menu">
    <li><a href="top.php">Top</a></li>
    <li><a href="qanda.php">Q&A</a></li>
    <li><a href="evaluation.php">Evaluation</a></li>
    <li><a href="ranking.php">Ranking</a></li>
  </ul>

</body>
</html>
