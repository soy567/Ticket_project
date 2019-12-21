<?php
  include("dbconn.php");
  $match_num = $_POST['match_num'];
?>

<html>
  <head>
  <link href="https://fonts.googleapis.com/css?family=Bangers|Black+Han+Sans|Jua|Staatliches&display=swap" rel="stylesheet">
      <style type="text/css">
	     form {
		     width:300px;
		     margin: 0 auto;
	      }
        .font_big { font-size: 2em; }
        .font_bigger { font-size: 3em; }

        .font_color {color: white;}
        .font_bold { font-weight: bold; }
        .font_center { text-align: center; }
        .font_jua {font-family: 'Jua';}
        .font_han {font-family: 'Black Han Sans';}

        .bton{
  background:#617be3;
  color:#fff;
  border:none;
  position:absolute;
  text-align:center;
  font-family: 'Jua';
  height:32.5px;
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


        p#round_font {font-size : 300%;  font-weight: bold ; font-family: 'Bangers', cursive;}

        body {
          background-image : url('img/background/stadium.jpg');
          background-size : 100% ;
        }
    </style>

    <script language='javascript'>  //팝업창 띄우고 post방식으로 매치번호 seat_choice창에 전송해주는 함수
     function seat_check(){
      var gsWin = window.open('about:blank','match_num','width=900px, height=500px');
      var frm =document.match_num;
      frm.action = "seat_choice.php";
      frm.target ="match_num";
      frm.method ="post";
      frm.submit();
     }
    </script>

  </head>
 <!-- DB에서 데이터 불러오고 반복문 이용해 경기 내용 테이블 출력 (자료 없을때 까지) -->
  <body>
    <?php
     if ($_SESSION['user_id'] == null) { //로그인 하지 않고 접근했을때 처리 함수 (세션 검사)
         print "<script language=javascript> alert('로그인 되지 않았습니다.'); location.replace('./first_page.php'); </script>";
     }

     $sql = "SELECT * FROM match_info WHERE match_num = $match_num";
     $result = mysqli_query($conn, $sql);
     $row = mysqli_fetch_array($result);
     ?>

    <!-- 로고 상단 삽입, 예매 페이지로 링크 -->
	  <a href="main_page.php"><img src="img\logo_page\top_logo4.png" width="100" ></a>

    <!-- 아이디와 로그아웃 버튼 출력-->
    <table align="right" height="5"  style="margin-top:1%">
     <tr>
     <!-- 폰트색상을 흰색과 jua 크기는 크게 설정-->
        <td class="font_color font_big font_normal font_jua">
     <?php
          echo "아이디: ".$_SESSION['user_id']; // 현재 로그인된 아이디 상태를 보여줌.
      ?>
      </td>
      <td>
      <!-- 로그아웃 버튼의 폰트크기는 크게, 폰트는 han, 클릭시 로그아웃 동작이 작동되도록 설정-->
      <button style="margin-right:10px;" class="font_jua font_big" onclick="location.href = 'page_user_info.php'" >마이페이지</button>
      <button style="margin-right:10px;"  class="font_han font_big" onclick="location.href = 'logout.php'">로그아웃</button>
      </td>
      </tr>
     </table>

     <!-- 라인업 출력 -->
     <center>
       <p height="10"   class="font_bigger font_han"> 라인업 </p>
     </center>
       <p style= "text-align: center;">
       <img src="<?php echo $row['match_lineup_home'];?>" width="545"/>
       <img src="<?php echo $row['match_lineup_away'];?>" width="545" style=" margin-left: 70px;  margin-right: auto;"/></p>
    <!-- 좌석선택과 돌아가기 버튼 출력-->

       <form action = ' ' method="post" name="match_num">
       <input type="hidden" name="match_num" value="<?php echo $_POST['match_num']; ?>">
       <!--좌석선택의 폰트는 jua,크기는  크게 클릭시 좌석선택창으로 이동하도록 설정-->
       <button class="font_big font_jua" style="margin-left:30px" onClick="seat_check()">좌석선택</button>
       <!--돌아가기 버튼 작동설정-->
       <a class=" font_jua bton" style="margin-left:20px" onclick="location.href='main_page.php'">돌아가기 </a>

       </form>

    </body>
</html>
