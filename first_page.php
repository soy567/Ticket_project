<html>
 <head>
 <!-- 구글 정식 글꼴타입 하이퍼링크로 따옴-->
 <link href="https://fonts.googleapis.com/css?family=Bangers|Black+Han+Sans|Jua|Staatliches&display=swap" rel="stylesheet">
 <style type="text/css">
	.font_big { font-size: 2em; }
    .font_color {color: white;}
    .font_bold { font-weight: bold; }
    .font_center { text-align: center; }
    .font_jua {font-family: 'Jua';}
    .font_han {font-family: 'Black Han Sans';}

      p#round_font {font-size : 300%;  font-weight: bold ; font-family: 'Bangers', cursive;}

      body {
        background-image : url("img/background/stadium.jpg");
        background-size : 100% ;
      }
    </style>

	<script >
		function not_logined () {   // 예매버튼 눌렀을때 로그인 되지 않은것을 안내해주는 함수
		alert("로그인 후 이용해주세요.");
		}
	</script>

 </head>
  <body>
       <!-- 로고 상단 삽입, 예매 페이지로 링크 -->
 	     <a href="main_page.php"><img src="img/logo_page/top_logo4.png" width="100" ></a>

        <!-- 로그인칸과 회원가입칸 설정 -->
        <table align="right" height="5"  style="margin-top:1%">
         <tr>
           <td>
             <!-- 로그인칸 클릭시 팝업으로 로그인 창으로 이동 -->
             <!-- 폰트는 크게,글꼴은 black han sans-->
 			      <input type="button" value="로그인" style="margin-right:10px;"  class="font_big font_han" onclick="window.open('login.php', 'login', 'width=500px, height=500px')">
             <!-- 회원가입칸 클릭시 팝업으로 회원가입 창으로 이동 -->
 			      <input type="button" value="회원가입"  class="font_big font_han" onclick="window.open('register.php', 'register', 'width=500px, height=500px')">
 			    </td>
         </tr>
 	     </table>
 <?php
 $mysql_host = "localhost";
 $mysql_user = "root";
 $mysql_password = "phpbeta";
 $mysql_db = "project_test";

 $conn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db); // MySQL 데이터베이스 연결

 if (!$conn) { // 연결 오류 발생 시 스크립트 종료
     die("연결 실패: " . mysqli_connect_error());
 }

 $sql = "SELECT * FROM match_info
 		JOIN stadium ON match_info.match_sta_num = stadium.sta_num
 		ORDER BY match_info.match_num";

 $result = mysqli_query($conn, $sql);

  echo  "<p align='center' height='100' id='round_font'  > 27R </p>";

  if (mysqli_num_rows($result) > 0) {
      echo "<table align='center' border='1' height='100'  style='margin-top:5%' >
      <tr>
         <td colspan='2'  class = 'font_big font_center font_color font_jua'>일자</td>
         <td  class = 'font_big font_center font_color font_jua '>시간</td>
         <td  class = 'font_big font_center font_color font_jua ' colspan='2'>경기장</td>
         <td colspan='3'   class = 'font_big font_color font_jua ' style='padding:0 0 0 85px;' >라인업</td>
      </tr>";

      while ($row = mysqli_fetch_array($result)) {
          $strTok = explode(' ', $row['match_date']);  //문자열 나눠주는 함수
          echo "<tr>";
          echo "<td colspan='2'  class = 'font_big font_center font_color font_jua'>".$strTok[0]."</td>";
          echo "<td class = 'font_big font_color font_jua '>".$strTok[1]."</td>";
          echo "<td colspan='2'  class = 'font_big font_center font_color font_jua'>".$row['sta_name']."</td>";
          echo "<td class = 'font_big font_center font_color font_jua '><img src='".$row['team_logo_home']."' width='40'/>".$row['match_team_home']."VS <img src='".$row['team_logo_away']."'width='40'/>".$row['match_team_away']."</td>";
          echo "<td><input type='button' class='font_big font_jua ' value='예매하기' style='margin-right:20px;' onclick='not_logined()'> </td>";
          echo "</tr>";
      }
      echo "</table>";
  } else {
     echo "저장된 데이터가 없습니다.";
 }
 ?>


       </tr>
     </table>
   </body>
 </html>
