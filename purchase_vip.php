<!-- form으로 매치 번호 받아와 매치번호 이용 경기장번호 알아낸 후 경기장 번호로 경기장 접근하여 총 좌석수 알아냄-->
<?php
$match_num = $_POST['match_num'];
?>

<html>
  <head>
    <title>VIP석 결제 페이지</title>
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

    <script type="text/javascript"> //좌석 클릭시 처리하는 함수
      var arr_select_seat = new Array();
      function chk(obj){
        if (obj.style.background == 'grey'){
          color = 'red';
          obj.style.background = 'red';
          arr_select_seat.push(obj.id);
        }
        else {
          color = "grey";
          obj.style.background = 'grey';
          arr_select_seat.splice(arr_select_seat.indexOf(obj.id),1); //splice 메서드에는 세 개의 인수를 전달한다. 반드시 입력해야 하는 첫번째 인수는 잘라낼 시작 위치이다. 나머지 두개의 인수는 생략할 수 있는데, 두번째 인수는 제거할 원소의 개수이고, 세번째 인수는 치환할 내용이다.
        }
      alert("선택한 좌석: "+obj.id+"석");
      }

      function move_page() { //자바스크립트를 이용하여 post 방식으로 좌석정보와 예매좌석 위치, 매치번호를 form으로 전달
        var form = document.createElement("form");
        form.setAttribute("method", "post");
        form.setAttribute("action", "purchase_upload_check.php"); // purchase_upload.php로 form정보 전달
        var hiddenField = document.createElement("input");
        hiddenField.setAttribute("type", "hidden");
        hiddenField.setAttribute("name", "select_seat");
        hiddenField.setAttribute("value", arr_select_seat);
        form.appendChild(hiddenField);

        var hiddenField2 = document.createElement("input");
        hiddenField2.setAttribute("type", "hidden");
        hiddenField2.setAttribute("name", "seat_info");
        hiddenField2.setAttribute("value", "vip");
        form.appendChild(hiddenField2);

        var hiddenField3 = document.createElement("input");
        hiddenField3.setAttribute("type", "hidden");
        hiddenField3.setAttribute("name", "match_num");
        hiddenField3.setAttribute("value", "<?php echo $match_num; ?>");
        form.appendChild(hiddenField3);

        document.body.appendChild(form);
        form.submit();
      }
    </script>

  </head>

  <body>
    <?php //데이터 베이스 연결부분
      session_start();
      if ($_SESSION['user_id'] == null) { //로그인 하지 않고 접근했을때 처리 함수 (세션 검사), 로그인 되어있으면 서버 접속
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

      $sql = "SELECT * FROM match_info /*stadium 테이블 정보 불러오기위해 match_info 테이블과 stadium 테이블 JOIN하여 사용(해당 match_num에 해당하는 정보만)*/
        JOIN stadium ON match_info.match_sta_num = stadium.sta_num
        WHERE match_info.match_num = $match_num";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_array($result);

      echo "<p class='font_small font_han font_color'>TICKET CLUB 티켓팅</p>";
      echo "<p class='font_small font_color'>".$row['match_team_home']." vs ".$row['match_team_away']." ".$row['match_date']." | ".$row['sta_name']."</p>";

      $sql = "SELECT * FROM match_info /*match_info, stadium, reserve_info 테이블을 기본키와 외래키를 이용하여 한번에 불러옴*/
        JOIN stadium ON match_info.match_sta_num = stadium.sta_num
        JOIN reserve_info ON match_info.match_num = reserve_info.reserved_match_num
        WHERE match_info.match_num = $match_num AND reserve_info.reserved_match_num = $match_num AND reserve_info.seat_info = 'vip'
        ORDER BY reserve_info.tot_ticket_num_or_vip_seat_place";
      $result = mysqli_query($conn, $sql);

      echo "<table id='seat_t' border='1' cellpadding='0' cellspacing='0'>";
      if (mysqli_num_rows($result) > 0) {  //예약된 좌석이 있을경우 예약된 좌석은 선택할 수 없도록 좌석 출력

        $reserved_seat = array();  //예약된 좌석 정보 저장할 배열 변수 선언
        while ($row = mysqli_fetch_array($result)) {
          $reserved_seat[] = $row['tot_ticket_num_or_vip_seat_place'];
        }

        echo "경기장<br>";
        for ($i='A', $k=0; $i<'C'; $i++) {
            echo "<tr>";
            for ($j='A'; $j<'I'; $j++) {
              if ($reserved_seat[$k] == "$i$j") {
                echo "<td id='$i$j' style='background:green'> - </td>";
                if ($k < count($reserved_seat) - 1) {
                  $k++;
                }
                continue;
              }
            echo "<td id='$i$j' style='background:grey' onClick='chk(this)'> $i$j </td>";
            }
          echo "</tr>";
          }
        }
      else {  // 예약된 좌석이 없을경우 좌석정보 출력
        echo "경기장";
        for ($i='A'; $i<'C'; $i++) {
          echo "<tr>";
          for ($j='A'; $j<'I'; $j++) {
            echo "<td id='$i$j' style='background:grey' onClick='chk(this)'> $i$j </td>";
          }
          echo "</tr>";
        }
      }
      echo "</table>";
    ?>
    <input type='button' name='upload' value="예매하기" onclick="move_page()">
    <input type="button" name="exit" value="나가기" onclick="window.close()">
  </body>
</html>
