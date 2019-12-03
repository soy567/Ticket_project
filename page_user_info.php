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

      body {
        background-image : url("img/background/.jpg");
        background-size : 100% ;
      }

      * {margin: 0 auto;}
      a {color:#333; text-decoration: none;}
      .find {text-align:center; width:500px; margin-top:30px; }
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
      <a href="main_page.php"><img src="img/logo_page/top_logo3.jpg" width="100" ></a>

      <table align="right" height="5"  style="margin-top:1%">
       <tr>
          <td class=" font_big font_normal font_jua">
            <?php
              echo "아이디: ".$_SESSION['user_id'];
            ?>
          </td>
          <td>
            <input type="button" style="margin-right:10px;"  class="font_han font_big"  name="logout" onclick="location.href = 'logout.php'" value="로그아웃">
          </td>
        </tr>
      </table>

        <!-- 폰트는 크게,글꼴은 jua, 색깔은 흰색-->
      <?php
        $mysql_host = "localhost";
        $mysql_user = "root";
        $mysql_password = "phpbeta";
        $mysql_db = "project_test";

        $conn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db); // MySQL 데이터베이스 연결

        if (!$conn) { // 연결 오류 발생 시 스크립트 종료
            die("연결 실패: " . mysqli_connect_error());
        }

        $sql = "SELECT * FROM user";
              $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) { //로그인한 유저 아이디의 정보를 가져와 이름과 이메일을 출력
                    while ($row = mysqli_fetch_array($result)) {
                        if ($_SESSION['user_id'] == $row['user_id']) {
                            $name = $row['user_name'];
                            $email = $row['user_email'];
                        }
                    }
                }

        echo "<div class='find'>
                <form method='post' action='member_find_id.php'>
                  <h1>마이페이지</h1>
                  <fieldset>
                    <legend>개인정보 </legend>
                    <table>
                      <tr>
                        <td>이메일: $email</td>
                      </tr>
                      <tr> 이름: $name</tr>
                    </table>
                    <input type='submit' value='개인정보 변경' onclick= />
                  </fieldset>
                </form>
              </div>;"
         ?>
       <?php
             $sql = "SELECT * FROM reserve_info
 				         JOIN stadium ON reserve_info.reserved_sta_num = stadium.sta_num
				         JOIN user ON reserve_info.reserved_user = user.user_id
 				         ORDER BY reserve_info.reserve_num";
             $result = mysqli_query($conn, $sql);

           if (mysqli_num_rows($result) > 0) {
               echo "<table align='center' border='1' height='100'  style='margin-top:5%' >
		                 <tr>
			                 <td>예약번호</td>
			                 <td>VIP : 좌석위치, 일반석 : 좌석갯수</td>
			                 <td>총 예매가격</td>
			                 <td>경기장 이름</td>
		                 </tr>";

               while ($row = mysqli_fetch_array($result)) {
                   if ($_SESSION['user_id'] == $row['user_id']) {
                       echo "<tr>";
                       echo "<td>" .$row['reserve_num']. "</td>";
                       echo "<td>" .$row['tot_ticket_num_or_vip_seat_place']. "</td>";
                       echo "<td>" .$row['tot_ticket_price']. "</td>";
                       echo "<td>" .$row['sta_name']. "</td>";
                       echo "<td><input type='submit' value='예매변경' onclick= /></td>";
                       echo "</tr>";
                   }
               }
               echo "</table>";
           } else {
               echo "저장된 데이터가 없습니다.";
           }
      ?>
  </body>
 </html>
