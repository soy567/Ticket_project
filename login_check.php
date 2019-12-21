<?php
  include('dbconn.php');
  $id = $_POST['id'];
  $pw = $_POST["pw"];
?>

<html>
  <head>

  <!-- 구글 정식 글꼴타입 하이퍼링크로 따옴-->
  <link href="https://fonts.googleapis.com/css?family=Bangers|Black+Han+Sans|Jua|Staatliches&display=swap" rel="stylesheet">
    <style type="text/css">

 		  .font_big { font-size: 2em; }
       .font_normal {font-size: 1.5em;}
       .font_color {color: white;}
       .font_bold { font-weight: bold; }
       .font_center { text-align: center; }
       .font_jua {font-family: 'Jua';}
       .font_han {font-family: 'Black Han Sans';}

       p#round_font {font-size : 300%;  font-weight: bold ; font-family: 'Bangers', cursive;}

       body{
          background-image : url('img/background/img2.jpg');
          background-size : 200% ;
        }

        button{
  background:#617be3;
  color:#fff;
  border:none;
  position:relative;
  text-align:center;
  font-family: 'Jua';
  height:50px;
  font-size:2.3em;
  padding:0em;
  cursor:pointer;
  transition:800ms ease all;
  outline:none;
}
button:hover{
  background:#fff;
  color:#617be3;
}
button:before,button:after{
  content:'';
  position:absolute;
  top:0;
  right:0;
  height:2px;
  width:0;
  background: #617be3;
  transition:400ms ease all;
}
button:after{
  right:inherit;
  top:inherit;
  left:0;
  bottom:0;
}
button:hover:before,button:hover:after{
  width:100%;
  transition:800ms ease all;
}


    </style>

  <script language="JavaScript">
    function move_page() {
    opener.document.location.href='main_page.php';
    window.close();
  }
  </script>
<body>
  <?php

   $check = "SELECT * FROM user WHERE user_id='$id'";
   $result = $conn->query($check);
   /*
    if($id == NULL || $pw == NULL){
    echo "아이디나 패스워드가 입력되지 않았습니다.</br>";
  } */
  if ($result->num_rows == 1) {
      $row = $result->fetch_array(MYSQLI_ASSOC); //하나의 열을 배열로 가져오기
  if ($row['user_pw'] == $pw) { //MYSQLI_ASSOC 필드명으로 첨자 가능
      $_SESSION['user_id'] = $id; //로그인 성공시 세션 변수 만들기
      if (isset($_SESSION['user_id'])) { // 세션 변수가 정의되어 있을때
        echo("<script language='javascript'>move_page();</script>"); //로그인 성공시 메인 페이지로 이동
      } else {
          echo "세션 저장 실패";
      }
  } else {
      echo "<center>";
      echo "<br>";
      echo "<br>";
      echo "<br>";
      echo "<br>";
      echo "<br>";
      echo "<br>";

      echo "<br>";

      echo "<div class= 'font_big font_color font_jua'>아이디나 패스워드가 틀렸습니다.</div>";
      echo "</center>";

  }
  } else {
    echo "<center>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";

    echo "<div class= 'font_big font_color font_jua'>아이디나 패스워드가 틀렸습니다.</div>";
    echo "</center>";
  }
  ?>
  <br>
  <br>
  <br>
  <center>
  <button class="font_big font_jua" onclick= "location.href='login.php'">뒤로가기</button>
  </center>
  </body>
</html>
