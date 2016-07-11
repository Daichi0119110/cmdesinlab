<?php

require_once("config.php");
require_once("function.php");

$dbh = connectDb();
$stmt = $dbh->query("select * from questions where class_id =".$_SESSION['me']['class_id']);
$questions = $stmt->fetchALL(PDO::FETCH_ASSOC);

$stmt = $dbh->query("select * from answers left join questions on answers.question_id = questions.id where class_id = ".$_SESSION['me']['class_id']." order by question_id");
$answers = $stmt->fetchALL(PDO::FETCH_ASSOC);

for ($i=0; $i < count($questions); $i++) {
  $questions[$i]["choice1"] = 0;
  $questions[$i]["choice2"] = 0;
  $questions[$i]["choice3"] = 0;
  $questions[$i]["choice4"] = 0;
  $questions[$i]["num"] = 0;
}

$num = 0;

for ($i=0; $i < count($answers); $i++) {
  $num = $num + 1;
  $a[$answers[$i]["answer"]] = $a[$answers[$i]["answer"]] + 1;

  if($answers[$i]['question_id'] !== $answers[$i+1]['question_id'] || $i == count($answers)-1){
    for ($j=0; $j < count($questions); $j++) {
      if($questions[$j]['id'] == $answers[$i]['question_id']){
        break;
      }
    }
    $questions[$j]["choice1"] = round($a["1"]/$num*100);
    $questions[$j]["choice2"] = round($a["2"]/$num*100);
    $questions[$j]["choice3"] = round($a["3"]/$num*100);
    $questions[$j]["choice4"] = round($a["4"]/$num*100);
    $questions[$j]["num"] = $num;

    $num = 0;
    $a = "";
    }
}

?>

<html>
<head>
  <title>analysis</title>
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
        <h3 class="title">Analysis</h3>
        <table>
          <tr>
            <td>No.</td>
            <td>Question</td>
            <td>1</td>
            <td>2</td>
            <td>3</td>
            <td>4</td>
            <td>N</td>
          </tr>
          <?php $i = 0; ?>
          <?php foreach ($questions as $question) { ?>
          <tr>
            <td><?php $i = $i + 1; echo $i?></td>
            <td><?php echo $question['question']; ?></td>
            <td><?php if($question['correct'] == 1) {echo "<font color=red>";} ?><?php echo $question['choice1']; ?>%<?php if($question['correct'] == 1) {echo "</font>";} ?></td>
            <td><?php if($question['correct'] == 2) {echo "<font color=red>";} ?><?php echo $question['choice2']; ?>%<?php if($question['correct'] == 2) {echo "</font>";} ?></td>
            <td><?php if($question['correct'] == 3) {echo "<font color=red>";} ?><?php echo $question['choice3']; ?>%<?php if($question['correct'] == 3) {echo "</font>";} ?></td>
            <td><?php if($question['correct'] == 4) {echo "<font color=red>";} ?><?php echo $question['choice4']; ?>%<?php if($question['correct'] == 4) {echo "</font>";} ?></td>
            <td><?php echo $question['num']; ?></td>
          </tr>
          <?php } ?>
        </table>
</div>
</div>

<ul class="footer_menu">
<li><a href="top_pro.php">Top</a></li>
<li><a href="register.php">Register</a></li>
<li><a href="analysis.php">Analysis</a></li>
<li><a href="ranking.php">Ranking</a></li>
</ul>

</body>
</html>
