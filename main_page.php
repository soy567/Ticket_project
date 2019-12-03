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
      .font_noto{font-family: 'Noto Sans KR', sans-serif;}

      p#round_font {font-size : 300%;  font-weight: bold ; font-family: 'Bangers', cursive;}

      body {
        background-image : url("img/background/stadium.jpg");
        background-size : 100% ;
      }
    </style>
  </head>

  <body>
    <?php
      session_start();
      if ($_SESSION['user_id'] == null) { //로그인 하지 않고 접근했을때 처리 함수 (세션 검사)
        print "<script> alert('로그인 되지 않았습니다.'); location.replace('./first_page.php'); </script>";
      }
    ?>
      <!-- 로고 상단 삽입, 예매 페이지로 링크 -->
	     <a href="main_page.php"><img src="img/logo_page/top_logo4.png" width="100" ></a>
       <!-- 아이디와 로그아웃 버튼 표시 -->
       <table align="right" height="5"  style="margin-top:1%">
        <tr>
           <td class="font_color font_big font_normal font_jua">
             <?php
             echo "아이디: ".$_SESSION['user_id'];
             ?>
           </td>
           <td>
             <input type="button" style="margin-right:10px;"  class="font_han font_big"  name="logout" onclick="location.href = 'page_user_info.php'" value="마이페이지">
             <input type="button" style="margin-right:10px;"  class="font_han font_big"  name="logout" onclick="location.href = 'logout.php'" value="로그아웃">
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
        		ORDER BY match_info.match_num"; //stadium 테이블 정보 불러오기위해 match_info 테이블과 stadium 테이블 JOIN하여 사용

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
                 echo "<td>
                          <form action = './reservation.php' method = 'post'>
                          <input type = 'hidden' name = 'match_num' value = '".$row['match_num']."'>
                          <input type = 'submit' class='font_big font_jua ' value='예매하기' style='margin-right:20px'></form></td>";
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
