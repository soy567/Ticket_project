<!-- form으로 매치 번호 받아와 매치번호 이용 경기장번호 알아낸 후 경기장 번호로 경기장 접근하여 총 좌석수 알아냄-->
<?php
  include("dbconn.php");
  $match_num = $_POST['match_num'];
?>

<html>
  <head>
    <title>일반석 결제 페이지</title>
    <link href="https://fonts.googleapis.com/css?family=Bangers|Black+Han+Sans|Jua|Staatliches&display=swap" rel="stylesheet">
    <style type="text/css">
      form  {
        width:300px;
        margin: 0 auto; }

        .font_small {font-size: 1em; }
        .font_normal {font-size: 1.5em; }
        .font_big { font-size: 2em; }
        .font_bigger { font-size: 3em; }

        .font_color {color: white;}
        .font_bold { font-weight: bold; }
        .font_center { text-align: center; }
        .font_jua {font-family: 'Jua';}
        .font_han {font-family: 'Black Han Sans';}
        .font_noto{font-family: 'Noto Sans KR', sans-serif;}
        .div_set { background-color:black; padding:5px; }

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

        body{
          background-image : url('img/background/img2.jpg');
          background-size : 100% ;
        }


    </style>
  </head>

  <body>
    <?php
      if ($_SESSION['user_id'] == null) { //로그인 하지 않고 접근했을때 처리 함수 (세션 검사), 로그인 되었으면 서버 접속
        print "<script> alert('로그인 되지 않았습니다.'); location.replace('./first_page.php'); </script>";
      }

      $sql = "SELECT * FROM match_info
      JOIN stadium ON match_info.match_sta_num = stadium.sta_num
      WHERE match_info.match_num = $match_num"; //stadium 테이블 정보 불러오기위해 match_info 테이블과 stadium 테이블 JOIN하여 사용(해당 match_num에 해당하는 정보만)
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_array($result);
    ?>

    <div class="div_set font_small font_han font_color">TICKET CLUB 티켓팅</div>
    <div class="div_set font_small font_color"><?php echo $row['match_team_home'] ?> vs <?php echo $row['match_team_away']?>  <?php echo $row['match_date']?> | <?php echo $row['sta_name']?> </div>

    <?php
      $tot_seat_num = $row['total_seat_normal']; //총 좌석 수
      $reserved_num = $row['reserved_seat_normal']; //예약된 좌석수
      $Remaining_seat = $tot_seat_num - $reserved_num; //남은 좌석
      $ticket_price = $row['price_ticket_normal']; // 티켓 가격

      echo "<br>";
      echo "<br>";
      echo "<br>";
      echo "<center>";
      echo "<div class= 'font_normal font_color font_jua'>총 좌석 수: $tot_seat_num <br></div>";
      echo "<div class= 'font_normal font_color font_jua'>남은 좌석 수: $Remaining_seat <br></div>";
      echo "<div class= 'font_normal font_color font_jua'>좌석가격:";
      echo number_format($ticket_price);
      echo "원 <br></div>";
      echo "</center>";

      ?>

<center>
    <form action="./purchase_upload_check.php" method="post">
      <div class= "font_normal font_color font_jua"><label for="ticket_num">인원수: </label>
        <input id="ticket_num" type="text" name="ticket_num" class="font_jua">
      </div>

      <input type="hidden" name="match_num" value="<?php echo $_POST['match_num']; ?>">
      <input type="hidden" name="seat_info" value="normal">

      <br>


       <div>
        <button  class= "font_normal font_jua">예매하기</button>
        <button  class= "font_normal font_jua" style="margin-left:20px"  onClick="window.close()">취소</button>

      </div>
    </form>
    </center>
  </body>
</html>
