<?php

require_once("config.php");
require_once("function.php");

$dbh = connectDb();

// postだったら実行
if($_SERVER["REQUEST_METHOD"] == "POST"){
  //questionsに登録
  for ($i=1; $i <= $_POST['num'] ; $i++) {
    if($_POST[$i."id"]){
      //編集（idが存在したら）
      $stmt = $dbh->prepare("update questions set question = :question, choice1 = :choice1, choice2 = :choice2, choice3 = :choice3, choice4 = :choice4, correct = :correct where id = :id");
      $values = array(
        ":question"=>$_POST[$i."question"],
        ":choice1"=>$_POST[$i."choice1"],
        ":choice2"=>$_POST[$i."choice2"],
        ":choice3"=>$_POST[$i."choice3"],
        ":choice4"=>$_POST[$i."choice4"],
        ":correct"=>$_POST[$i."correct"],
        ":id"=>$_POST[$i."id"]
      );
    }else{
      if($_POST[$i."question"]){
        //新規登録（idが存在しない）
        $stmt = $dbh->prepare("insert into questions (question, class_id, choice1, choice2, choice3, choice4, correct) values (:question, :class_id, :choice1, :choice2, :choice3, :choice4, :correct)");
        $values = array(
          ":question"=>$_POST[$i."question"],
          ":class_id"=>$_SESSION['me']['class_id'],
          ":choice1"=>$_POST[$i."choice1"],
          ":choice2"=>$_POST[$i."choice2"],
          ":choice3"=>$_POST[$i."choice3"],
          ":choice4"=>$_POST[$i."choice4"],
          ":correct"=>$_POST[$i."correct"]
        );
      }
    }
    $stmt->execute($values);
  }
}

$stmt = $dbh->query('select * from questions where class_id = '.$_SESSION['me']['class_id']);
$questions = $stmt->fetchALL(PDO::FETCH_ASSOC);

?>

<html>
<head>
  <title>register</title>
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
      <h3 class="title">Register Q&A</h3>
      <form action="" method="post" name="register">
        <table border="1" cellspacing="0" class="register">
          <tbody id="table">
            <tr>
              <!-- <td>delete</td> -->
              <td>No.</td>
              <td>Question</td>
              <td>choice1</td>
              <td>choice2</td>
              <td>choice3</td>
              <td>choice4</td>
              <td>Answer</td>
            </tr>
            <?php $i=1; ?>
            <?php foreach ($questions as $question) { ?>
            <tr>
              <!-- <td><img src="./images/delete.png" width=10></td> -->
              <td><?php echo $i; ?></td>
              <input type="hidden" name="<?php echo $i; ?>id" value="<?php echo $question['id']; ?>">
              <td><input type="text" name="<?php echo $i; ?>question" value="<?php echo $question['question']; ?>" placeholder="Question"></td>
              <td><input type="text" name="<?php echo $i; ?>choice1" value="<?php echo $question['choice1']; ?>" placeholder="choice1"></td>
              <td><input type="text" name="<?php echo $i; ?>choice2" value="<?php echo $question['choice2']; ?>" placeholder="choice2"></td>
              <td><input type="text" name="<?php echo $i; ?>choice3" value="<?php echo $question['choice3']; ?>" placeholder="choice3"></td>
              <td><input type="text" name="<?php echo $i; ?>choice4" value="<?php echo $question['choice4']; ?>" placeholder="choice4"></td>
              <td>
                <select name="<?php echo $i; ?>correct">
                  <option value="1" <?php if($question['correct'] == 1){ echo "selected"; }?>>1</option>
                  <option value="2" <?php if($question['correct'] == 2){ echo "selected"; }?>>2</option>
                  <option value="3" <?php if($question['correct'] == 3){ echo "selected"; }?>>3</option>
                  <option value="4" <?php if($question['correct'] == 4){ echo "selected"; }?>>4</option>
                </select>
              </td>
            </tr>
            <?php $i = $i + 1 ; ?>
            <?php } ?>
            <tr>
              <!-- <td><img src="./images/delete.png" width=10></td> -->
              <td><?php echo $i; ?></td>
              <td><input type="text" name="<?php echo $i; ?>question"></td>
              <td><input type="text" name="<?php echo $i; ?>choice1"></td>
              <td><input type="text" name="<?php echo $i; ?>choice2"></td>
              <td><input type="text" name="<?php echo $i; ?>choice3"></td>
              <td><input type="text" name="<?php echo $i; ?>choice4"></td>
              <td>
                <select name="<?php echo $i; ?>correct">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                </select>
              </td>
            </tr>
          </tbody>
        </table>
        <button type="button" class="formadd">+ Add row</button>
        <input type="hidden" name="num" id="num" value="<?php echo $i; ?>">
        <input type="submit" value="register" class="btn btn-start">
      </form>
    </div>
  </div>

  <ul class="footer_menu">
    <li><a href="top_pro.php">Top</a></li>
    <li><a href="register.php">Register</a></li>
    <li><a href="analysis.php">Analysis</a></li>
    <li><a href="ranking.php">Ranking</a></li>
  </ul>
  <script>
  $(function(){
    var formcount = <?php echo $i; ?>;
    $("button.formadd").click(function(){
      formcount++;
      var div_element = document.createElement("tr");
      div_element.innerHTML = '<!-- <td><img src="./images/delete.png" width=10></td> --><td>'+formcount+'</td><td><input type="text" name="'+formcount+'question"></td><td><input type="text" name="'+formcount+'choice1"></td><td><input type="text" name="'+formcount+'choice2"></td><td><input type="text" name="'+formcount+'choice3"></td><td><input type="text" name="'+formcount+'choice4"></td><td><select name="'+formcount+'correct"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option></select></td>';
      var parent_object = document.getElementById("table");
      parent_object.appendChild(div_element);
      document.getElementById("num").value = formcount;
    });
  });
  </script>
</body>
</html>
