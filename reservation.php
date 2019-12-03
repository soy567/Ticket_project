<?php
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
     session_start();
     if ($_SESSION['user_id'] == null) { //로그인 하지 않고 접근했을때 처리 함수 (세션 검사)
         print "<script language=javascript> alert('로그인 되지 않았습니다.'); location.replace('./first_page.php'); </script>";
     }

     $mysql_host = "localhost";
     $mysql_user = "root";
     $mysql_password = "phpbeta";
     $mysql_db = "project_test";

     $conn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);

     if (!$conn) {
         die("연결 실패: " . mysqli_connect_error);
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
        <td class="font_color font_big font_normal font_jua">
     <?php
          echo "아이디: ".$_SESSION['user_id'];
      ?>
      </td>
      <td>
      <input type="button" style="margin-right:10px;"  class="font_han font_big"  name="logout" onclick="location.href = 'logout.php'" value="로그아웃">
      </td>
      </tr>
     </table>

     <!-- 라인업 출력 -->
       <p height="10" style="margin-left:700px;"  class="font_bigger font_han"> 라인업 </p>
       <p style= "text-align: center;">
       <img src="<?php echo $row['match_lineup_home'];?>" width="545"/>
       <img src="<?php echo $row['match_lineup_away'];?>" width="545" style=" margin-left: 70px;  margin-right: auto;"/></p>
    <!-- 좌석선택과 돌아가기 버튼 출력-->
       <form action = ' ' method="post" name="match_num">
         <input type="button" name="return" value="돌아가기"    class="font_big font_jua" onClick="location.href='main_page.php'">
         <input type="hidden" name="match_num" value="<?php echo $_POST['match_num']; ?>">
         <input type="submit" value="좌석선택" style="margin-left:20px;"  class="font_big font_jua" onClick="seat_check()">
       </form>
    </body>
</html>
