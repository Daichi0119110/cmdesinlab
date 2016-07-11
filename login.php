<?php

require_once("config.php");
require_once("function.php");

if($_GET["class"]) {
  $_SESSION['class_id'] = $_GET["class"];
}

$_SESSION['me'] = "";

$dbh = connectDb();
$stmt = $dbh->query("select * from users where class_id = ".$_SESSION['class_id']);
$users = $stmt->fetchALL(PDO::FETCH_ASSOC);

$dbh = null;

?>

<html>
<head>
  <title>login</title>
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
  <h2 class="text-center" style="color:white; padding:20;">cmdesignlab</h2>
  <div id="about" class="about all_pad text-center" style="padding-top:0;">
    <div class="container">
      <h3 class="title">Login</h3>
      <?php foreach($users as $user) { ?>
        <?php if($user['teacher_flg'] == 1) { ?>
          <a href="top_pro.php?user=<?php echo $user['id']; ?>" class="btn btn-warning"><?php echo $user['name']; ?></a>
          <?php } else { ?>
            <a href="top.php?user=<?php echo $user['id']; ?>" class="btn btn-start"><?php echo $user['name']; ?></a>
            <?php }} ?>
            <br><br><br>
            <h3 class="title">New user</h3>
            <div class="footer" style="padding-top:0;">
              <form action="top.php" method="post">
                <input type="text" placeholder="please enter your name!" name="name">
                <input type="submit" value="register" class="btn">
              </form>
            </div>
          </div>
        </div>

        <ul class="footer_menu">
          <li><a href="index.php">class choose</a></li>
        </ul>

      </body>
      </html>
