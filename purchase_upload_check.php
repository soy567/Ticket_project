<?php
  $match_num = $_POST['match_num']; // 매치 번호
  $seat_info = $_POST['seat_info']; // 좌석 정보
 ?>
<html>
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

      if($seat_info == "normal") {
        $id = $_SESSION['user_id']; // 예약유저 아이디
        $tot_seat_num = $row['total_seat_normal']; //총 좌석 수
        $reserved_num = $row['reserved_seat_normal']; //예약된 좌석수
        $Remaining_seat = $tot_seat_num - $reserved_num; //남은 좌석
        $ticket_price = $row['price_ticket_normal']; //티켓 가격
        $stadium = $row['sta_name']; // 예약경기장 이름
        $ticket_num = $_POST['ticket_num']; //예약인원

        if ($Remaining_seat < $ticket_num ){         // 남은 좌석보다 예약인원이 많다면
          echo "남은 여석이 부족합니다 예매할 수 없습니다. <br>";
          echo "<input type='button' value='나가기' onClick=window.close()>";
          exit();
        }

        if($ticket_num==NULL || $ticket_num <= 0) {   // 예약인원이 음수,0 또는 공백일 경우
          echo "인원수를 정확히 입력해 주십시오.</br>";
          echo "<input type='button' value='나가기' onClick=window.close()>";
          exit();
        }

        $total_price = $ticket_num * $ticket_price ;

        echo "예약유저: {$id} <br>";
        echo "경기장: {$stadium} <br>";
        echo "좌석등급: {$seat_info} <br>";
        echo "인원수: {$ticket_num}명 <br>";
        echo "좌석가격: {$ticket_price}원 <br>";
        echo "총 티켓 가격: {$total_price}원 <br>";
        echo "위 정보가 맞습니까?<br>";

        echo "<form action='./purchase_upload.php' method='post'>
                <input type='hidden' name='ticket_num' value='$ticket_num'>
                <input type='hidden' name='match_num' value='$match_num'>
                <input type='hidden' name='seat_info' value='$seat_info'>
                <div>
                  <input type='submit' value='확인'>
                  <input type='button' value='취소' onClick='window.close()'>
                </div>
              </form>";
      }

      else if ($seat_info == "vip") {
        $id = $_SESSION['user_id']; // 예약유저 아이디
        $tot_seat_num = $row['total_seat_vip']; //총 좌석 수
        $reserved_num = $row['reserved_seat_vip']; //예약된 좌석수
        $Remaining_seat = $tot_seat_num - $reserved_num; //남은 좌석
        $received_str =  $_POST['select_seat']; //예약좌석 위치정보
        $arr_sel_seat = explode( ',', $received_str); //예약좌석 위치 배열로 변환
        $ticket_price = $row['price_ticket_vip']; //티켓 가격
        $stadium = $row['sta_name']; // 예약경기장 이름
        $ticket_num = count($arr_sel_seat); //예약 티켓 개수

        $total_price = $ticket_num * $ticket_price ;

        if($received_str == NULL) {
          echo "좌석을 선택하지 않아 예매를 진행할 수 없습니다.</br>";
          echo "<input type='button' value='나가기' onClick=window.close()>";
          exit();
        }

        echo "예약유저: {$id} <br>";
        echo "경기장: {$stadium} <br>";
        echo "좌석등급: {$seat_info} <br>";
        echo "좌석위치: {$received_str} <br>";
        echo "인원수: {$ticket_num}명 <br>";
        echo "좌석가격: {$ticket_price}원 <br>";
        echo "총 티켓 가격: {$total_price}원 <br>";
        echo "위 정보가 맞습니까?<br>";

        echo "<form action='./purchase_upload.php' method='post'>
                <input type='hidden' name='select_seat' value='$received_str'>
                <input type='hidden' name='match_num' value='$match_num'>
                <input type='hidden' name='seat_info' value='$seat_info'>
                <div>
                  <input type='submit' value='확인'>
                  <input type='button' value='취소' onClick='window.close()'>
                </div>
              </form>";
      }
    ?>

  </body>
</html>
