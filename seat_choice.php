<!-- form으로 매치 번호 불러와 해당 좌석예매 페이지 뜨도록 페이지 작성 -->
<?php $match_num = $_POST['match_num']; ?>
<html>
  <head>
    <link href="https://fonts.googleapis.com/css?family=Bangers|Black+Han+Sans|Jua|Staatliches&display=swap" rel="stylesheet">
    <style type="text/css">
	     form {
		   width:300px;
		   margin: 0 auto; }

      .font_small {font-size: 1em; }
      .font_big { font-size: 2em; }
      .font_bigger { font-size: 3em; }

      .font_color {color: white;}
      .font_bold { font-weight: bold; }
      .font_center { text-align: center; }
      .font_jua {font-family: 'Jua';}
      .font_han {font-family: 'Black Han Sans';}

      p#round_font {font-size : 300%;  font-weight: bold ; font-family: 'Bangers', cursive;}

      body{
        background-image : url('img/background/background10.jpg');
        background-size : cover;
      }
    </style>

    <script language="JavaScript"> //돌아가기 버튼 눌렀을 경우 현재 팝업창 닫고 메인페이지로 이동하는 함수
      function move_page() {
        opener.document.location.href='main_page.php';
        window.close();
      }
    </script>

    <script type="text/javascript"> //좌석정보 확인하여 해당 좌석예매 페이지로 이동시키는 함수 (post방식으로 match_num 전달)
      function move_purchase() {
      var target = document.getElementById("seat"); //
      seat = target.options[target.selectedIndex].value;
      var gsWin = window.open('about:blank','match_num');
      var frm = document.match_num;

      if(seat == 'vip') {
        frm.action = "purchase_vip.php";
        frm.target = "match_num";
        frm.method = "post";
      }

      else {
          frm.action = "purchase_normal.php";
          frm.target = "match_num";
          frm.method = "post";
        }
      }
    </script>
  </head>

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

     $sql = "SELECT * FROM match_info
         JOIN stadium ON match_info.match_sta_num = stadium.sta_num
         WHERE match_info.match_num = $match_num"; //stadium 테이블 정보 불러오기위해 match_info 테이블과 stadium 테이블 JOIN하여 사용
     $result = mysqli_query($conn, $sql);
     $row = mysqli_fetch_array($result);
     ?>

     <p class="font_small font_han font_color">TICKET CLUB 티켓팅</p>
     <p class="font_small font_color"><?php echo $row['match_team_home'] ?> vs <?php echo $row['match_team_away']?>  <?php echo $row['match_date']?> | <?php echo $row['sta_name']?> </p>

    <img src="img\stadium\stadium3.png" width="500px" style=" margin-top: 20px; margin-left: -10px;  margin-right: auto;"/>

      <!--
       먼저 VIP or 일반석 선택받고 그 조건문 이용 일반석 이면 남은 자릿수와 매수선택, 가격, 예매표시
       VIP 석은 20석 한정으로 좌석표시 버튼(누르면 팝업으로 좌석 표 보여줌), 매수선택, 가격, 예매표시
       -->
       <form name="match_num" method="post">
       <label class="font_big font_jua">좌석종류 선택</label>
         <select id='seat' class="font_big font_jua" onchange="SetSelectBox();">
           <option value="vip"> VIP석</option>
           <option value="normal"> 일반석</option>
         </select>

         <input type="button" name="return" value="돌아가기" class="font_big font_jua" onClick= "move_page()">
         <input type="hidden" name="match_num" value="<?php echo $match_num ?>" class="font_big font_jua">
         <input type="submit" name="reservation" value="예매하기" class="font_big font_jua" onClick= "move_purchase()">
       </form>

    </body>
</html>
