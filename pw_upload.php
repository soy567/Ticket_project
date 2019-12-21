<!DOCTYPE html>
<?php
  include('dbconn.php');
  $name = $_POST['name'];
  $user_id = $_POST['user_id'];
  $email = $_POST['email'];
  echo "$id";
 ?>

<html lang="ko">
  <head>
    <meta charset="utf-8">
    <title>비밀번호 변경 페이지</title>
    <!-- 구글 정식 글꼴타입 하이퍼링크로 따옴-->
    <link href="https://fonts.googleapis.com/css?family=Black+Han+Sans|Courier+Prime|Jua|Nanum+Gothic|Noto+Sans+KR|Roboto&display=swap" rel="stylesheet">

        <style type="text/css">

      .font_small {font-size: 1em; }
		  .font_big { font-size: 2em; }
      .font_normal {font-size: 1.5em;}
      .font_color {color: white;}
      .font_bold { font-weight: bold; }
      .font_center { text-align: center; }
      .font_jua {font-family: 'Jua';}
      .font_han {font-family: 'Black Han Sans';}
      .font_noto{font-family: 'Noto Sans KR', sans-serif;}
      p#round_font {font-size : 300%;  font-weight: bold ; font-family: 'Bangers', cursive;}



      .bton{
  background:#617be3;
  color:#fff;
  border:none;
  position:absolute;
  text-align:center;
  font-family: 'Jua';
  height:50px;
  font-size:1.8em;
  padding:0.3em;
  cursor:pointer;
  transition:800ms ease all;
  outline:none;
}
.bton:hover{
  background:#fff;
  color:#617be3;
}
.bton:before,.bton:after{
  content:'';
  position:absolute;
  top:0;
  right:0;
  height:2px;
  width:0;
  background: #617be3;
  transition:400ms ease all;
}
.bton:after{
  right:inherit;
  top:inherit;
  left:0;
  bottom:0;
}
.bton:hover:before,.bton:hover:after{
  width:100%;
  transition:800ms ease all;
}





      button{
  background:#617be3;
  color:#fff;
  border:none;
  position:relative;
  text-align:center;
  font-family: 'Jua';
  height:50px;
  font-size:2.1em;
  padding:0.3em;
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



      #btn1{ border-top-left-radius: 5px; border-bottom-left-radius: 5px; border-top-right-radius: 5px; border-bottom-right-radius: 5px; margin-right:-4px; }

#btn_set button{ border: 1px solid white; font-family: 'Noto Sans KR'; font-size:1em; background-color: rgba(0,0,0,0); color: white; padding: 5px; }
#btn_set button:hover{ color:black; background-color: skyblue; }


body {
        background-image : url("img/background/12.png");
        background-size : 100% ;
      }


      * {margin: 0 auto;}
      a {color:#333; text-decoration: none;}
      .find {text-align:center; width:500px; margin-top:30px; }



</style>
  </head>
  <body>
  <?php
    if ($_SESSION['user_id'] == null) { //로그인 하지 않고 접근했을때 처리 함수 (세션 검사)
        print "<script> alert('로그인 되지 않았습니다.'); location.replace('./first_page.php'); </script>";
    }
    ?>

  <a href="main_page.php"><img src="img/logo_page/top_logo4.png" width="100" ></a>

<table align="right" height="5"  style="margin-top:1%">
 <tr>
    <td class=" font_big font_color  font_normal font_jua">
      <?php
        echo "아이디: ".$_SESSION['user_id'];
      ?>
    </td>
    <td  >
    <button style="margin-right:10px;"  class="font_han font_big" onclick="location.href = 'logout.php'">로그아웃</button>

    </td>
  </tr>
</table>

<?php
  include('dbconn.php');
  $user_id = $_POST['user_id'];
  $pw_1 = $_POST['pw1'];
  $pw_2 = $_POST['pw_2'];

  if($pw_1 != $pw_2) {
    echo"<center>";
    echo"<br>";
    echo"<br>";
    echo"<br>";
    echo"<br>";
    echo"<br>";
    echo"<br>";
    echo"<br>";

    echo "<div class='font_big font_color font_jua'>비밀번호와 비밀번호 확인이 다릅니다.</div>";
    echo"</center>";

  }
  else if($pw_1==NULL || $pw_2==NULL) {
    echo"<center>";
    echo"<br>";
    echo"<br>";
    echo"<br>";
    echo"<br>";
    echo"<br>";
    echo"<br>";
    echo"<br>";
    echo"<br>";

    echo "<div class='font_big font_color font_jua'>비밀번호 변경의 공백이 있습니다.</div>";
    echo"</center>";

  }
 else{
  $update = mysqli_query($conn, "UPDATE user set user_pw='$pw_1' where user_id = '$user_id';");
}

if($update){
  echo"<center>";
  echo"<br>";
  echo"<br>";
  echo"<br>";
  echo"<br>";
  echo"<br>";
  echo"<br>";
  echo"<br>";
  echo"<br>";
  echo"<br>";
  echo"<br>";

  echo "<div class='font_big font_color font_jua'>비밀번호 변경완료.</div>";
  echo"</center>";

}


  ?>
  <br>
  <br>
  <center>
     <button class="font_big font_jua" onclick="location.href='page_user_info.php'">마이페이지로 이동</button></center>
  </body>
</html>
