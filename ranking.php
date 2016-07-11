<?php

require_once("config.php");
require_once("function.php");

$dbh = connectDb();
$stmt = $dbh->query("select * from users where teacher_flg <> 1 and class_id = ".$_SESSION['me']['class_id']);
$students = $stmt->fetchALL(PDO::FETCH_ASSOC);

for ($i=0; $i < count($students); $i++) {
  $students[$i]["score"] = getscore($students[$i]['id']);
}

$students = sortStudent($students);

?>

<html>
<head>
  <title>ranking</title>
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
      <h3 class="title">Ranking</h3>

      <ul class="nav nav-tabs">
        <li><a href="#lastweek" data-toggle="tab">Last week</a></li>
        <li class="active"><a href="#thisweek" data-toggle="tab">This week</a></li>
        <li><a href="#total" data-toggle="tab">Total</a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane " id="lastweek"></div>
        <div class="tab-pane active" id="thisweek">
          <table>
            <?php $rank = 0; ?>
            <?php foreach ($students as $student) { ?>
              <?php $rank = $rank + 1; ?>
            <tr>
              <td>
                <?php switch ($rank) {
                  case 1:
                    echo '<img src="picture/first.png" width=40>';
                    break;
                  case 2:
                    echo '<img src="picture/second.png" width=40>';
                    break;
                  case 3:
                    echo '<img src="picture/third.png" width=40>';
                    break;
                  default:
                    echo $rank;
                    break;
                }
                ?>
              </td>
              <td><?php echo $student['name']; ?></td>
              <td><?php echo $student['score']; ?>pt</td>
            </tr>
            <?php } ?>
          </table>
        </div>
        <div class="tab-pane" id="total">Tab3 Content</div>
      </div>

    </div>
    </div>
    <?php if($_SESSION['me']['teacher_flg'] == 0) { ?>
      <ul class="footer_menu">
        <li><a href="top.php">Top</a></li>
        <li><a href="qanda.php">Q&A</a></li>
        <li><a href="evaluation.php">Evaluation</a></li>
        <li><a href="ranking.php">Ranking</a></li>
      </ul>

      <?php } else { ?>
      <ul class="footer_menu">
      <li><a href="top_pro.php">Top</a></li>
      <li><a href="register.php">Register</a></li>
      <li><a href="analysis.php">Analysis</a></li>
      <li><a href="ranking.php">Ranking</a></li>
      </ul>
      <?php } ?>
    </body>
    </html>
