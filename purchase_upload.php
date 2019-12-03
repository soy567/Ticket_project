<?php
$seat_info = $_POST['seat_info'];
$match_num = $_POST['match_num'];
?>

<html>
  <head>
    <meta charset="utf-8">
    <title>업로드 처리 페이지</title>
    <link href="https://fonts.googleapis.com/css?family=Bangers|Black+Han+Sans|Jua|Staatliches&display=swap" rel="stylesheet">
    <style type="text/css">
      form  {
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
          background-size : 100% ;
        }
    </style>
  </head>
  <body>

    <?php
      session_start();
      if ($_SESSION['user_id'] == null) { //로그인 하지 않고 접근했을때 처리 함수 (세션 검사), 로그인 되었으면 서버 접속
          print "<script> alert('로그인 되지 않았습니다.'); location.replace('./first_page.php'); </script>";
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
        WHERE match_info.match_num = $match_num"; //stadium 테이블 정보 불러오기위해 match_info 테이블과 stadium 테이블 JOIN하여 사용(해당 match_num에 해당하는 정보만)

      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_array($result);

      echo "<p class='font_small font_han font_color'>TICKET CLUB 티켓팅</p>";
      echo "<p class='font_small font_color'>".$row['match_team_home']." vs ".$row['match_team_away']." ".$row['match_date']." | ".$row['sta_name']."</p>";

      if ($seat_info == "normal") {    // 일반석 예매인 경우 서버업로드 처리부분
        $user_id = $_SESSION['user_id']; // 예약유저 아이디
        $ticket_price = $row['price_ticket_normal']; //티켓 가격
        $stadium_num = $row['sta_num']; // 예약경기장 번호
        $reserved_num = $row['reserved_seat_normal'];//예약된 좌석수
        $ticket_num = $_POST['ticket_num']; //예약인원
        //$seat_info = $_POST['seat_info']; // 좌석 정보
        $total_price = $ticket_num * $ticket_price; //총 가격
        $update_reserved_num = $reserved_num + $ticket_num; // 기존 예약된 좌석수 + 예약인원을 더해서 DB에 올릴 값

        $upload = mysqli_query($conn, "INSERT INTO reserve_info (tot_ticket_num_or_vip_seat_place, seat_info,reserved_user, tot_ticket_price,reserved_sta_num, reserved_match_num)
        VALUES ('$ticket_num','$seat_info','$user_id','$total_price','$stadium_num','$match_num')");
        //확인 된 변수들을 DB에 저장
        $update = mysqli_query($conn, "UPDATE stadium set reserved_seat_normal='$update_reserved_num' where sta_num = '$stadium_num';");
        //스타디움 번호를 통해 예약된 좌석수 업데이트
        if ($upload) {
            echo "예약완료.</br>";
            echo "<input type='button' value='나가기' onClick=window.close()>";
        }
    }

    elseif ($seat_info == "vip") {     // vip석 예매인 경우 서버업로드 처리부분
      $user_id = $_SESSION['user_id']; // 예약유저 아이디
      $received_str =  $_POST['select_seat']; //예약좌석 위치정보
      $arr_sel_seat = explode( ',', $received_str); //예약좌석 위치 배열로 변환
      $ticket_price = $row['price_ticket_vip']; // vip 티켓 가격
      $stadium_num = $row['match_sta_num']; // 예약경기장 번호
      $reserved_num = $row['reserved_seat_vip'];//예약된 좌석수
      $ticket_num = count($arr_sel_seat); //예약인원
      $seat_info = $_POST['seat_info']; // 좌석 정보
      $total_price = $ticket_num * $ticket_price; //총 가격
      $update_reserved_num = $reserved_num + $ticket_num; // 기존 예약된 좌석수 + 예약인원을 더해서 DB에 올릴 값

      for($i = 0; $i < $ticket_num; $i++) { //반복문 이용하여 여러개의 좌석 선택시 하나의 레코드씩 예약정보 서버에 업로드
        $upload = mysqli_query($conn, "INSERT INTO reserve_info (tot_ticket_num_or_vip_seat_place, seat_info,reserved_user, tot_ticket_price, reserved_sta_num, reserved_match_num)
        VALUES ('$arr_sel_seat[$i]','$seat_info','$user_id','$ticket_price','$stadium_num','$match_num')");
        //확인 된 변수들을 DB에 저장
        $update = mysqli_query($conn, "UPDATE stadium set reserved_seat_vip='$update_reserved_num' where sta_num = '$stadium_num';");
        //스타디움 번호를 통해 예약된 좌석수 업데이트
        if ($upload && $update) {
          echo "예약완료.($arr_sel_seat[$i])</br>";
        }
      }
      echo "<input type='button' value='나가기' onClick=window.close()>";
    }
    ?>

  </body>
</html>
