<!-- 넘겨받은 회원가입 정보 서버에 저장하여 회원가입 완료 -->
<?php
  include("dbconn.php");
 ?>
<html>
  <head>
  <!-- 구글 정식 글꼴타입 하이퍼링크로 따옴-->
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR|Bangers|Black+Han+Sans|Jua|Staatliches&display=swap" rel="stylesheet">
  <style>
		 .font_big { font-size: 2em; }
      .font_normal {font-size: 1.5em;}
      .font_color {color: white;}
      .font_bold { font-weight: bold; }
      .font_center { text-align: center; }
      .font_jua {font-family: 'Jua';}
      .font_han {font-family: 'Black Han Sans';}
      .font_noto{font-family: 'Noto Sans KR', sans-serif;}
      p#round_font {font-size : 300%;  font-weight: bold ; font-family: 'Bangers', cursive;}

      body{
          background-image : url('img/background/img2.jpg');
          background-size : 200% ;
        }

    </style>
  </head>

  <body>
    <?php
      $id = $_POST['id'];
      $pw = $_POST['pw1'];
      $pw2 = $_POST['pw_2'];
      $name = $_POST['name'];
      $email = $_POST['Email'];
      $gender = $_POST['gender'];

      if($pw != $pw2) {
        echo "<p align='center' height='100'  style='margin-top:30%' class='font_jua font_Color font_big'>비밀번호와 비밀번호 확인이 다릅니다.</p>";
        echo "<a align='center'  style='margin-left:auto; margin-right:auto;display:block;margin-top:22%;margin-bottom:0%' class= 'font_big font_color font_jua' href=register.php>back page</a>";
        exit();
      }

      if($id==NULL || $pw==NULL || $name==NULL || $email==NULL || $gender==NULL) {
        echo "<p align='center' height='100' style='margin-top:30%' class='font_jua font_color font_big'>빈 칸을 모두 채워주세요</p>";
        echo "<a align='center'  style=' margin-left:auto; margin-right:auto;display:block;margin-top:22%;margin-bottom:0%' class= 'font_big font_color font_jua' href=register.php>back page</a>";
        exit();
      }

      //$conn = mysqli_connect("localhost","root","phpbeta","project_test");

      $check="SELECT *from user WHERE user_id='$id'";
      $result=$conn->query($check);

      if($result->num_rows==1) {
        echo "<p align='center' height='100' style='margin-top:30%' class='font_jua font_center font_color font_big'>중복된 id입니다.</p>";
        echo "<a align='center'  style=' margin-left:auto; margin-right:auto;display:block;margin-top:22%;margin-bottom:0%' class= 'font_big font_color  font_jua' href=register.php>back page</p>";
        exit();
      }

      $signup = mysqli_query($conn,"INSERT INTO user (user_id,user_pw,user_name,user_email,user_gender)
      VALUES ('$id','$pw','$name','$email','$gender')");
      if($signup) {
        echo"<br>";
        echo"<br>";
        echo"<br>";

        echo "<p class='font_big font_color font_center font_jua'>회원가입 완료</p>";
        echo "<a align='center'  style=' margin-left:auto; margin-right:auto;display:block;margin-top:22%;margin-bottom:0%' class= 'font_big font_color  font_jua' href=login.php>로그인 하기</a>";
      }
      ?>
    </body>
 </html>
