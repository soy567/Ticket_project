<?php
  include("dbconn.php");
  $match_num = $_POST['match_num']; // 매치 번호
  $seat_info = $_POST['seat_info']; // 좌석 정보
 ?>
<html>
<head>
    <!-- 구글 정식 글꼴타입 하이퍼링크로 따옴-->
    <link href="https://fonts.googleapis.com/css?family=Black+Han+Sans|Jua|Lilita+One|Nanum+Gothic|Noto+Sans+KR|Oswald&display=swap" rel="stylesheet">
        <style type="text/css">
      .font_big { font-size: 2em; }
      .font_normal {font-size: 1.5em;}
      .font_color {color: white;}
      .font_bold { font-weight: bold; }
      .font_center { text-align: center; }
      .font_jua {font-family: 'Jua';}
      .font_han {font-family: 'Black Han Sans';}
      .font_noto{font-family: 'Noto Sans KR', sans-serif;}
      .font_oswald{font-family: 'Oswald', sans-serif;}
      .font_lilita{font-family: 'Lilita One', cursive;}
      .div_set { background-color:black; padding:5px; }


      .bton{
background:#617be3;
color:#fff;
border:none;
position:absolute;
text-align:center;
font-family: 'Jua';
height:32px;
font-size:2em;
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
  margin-left: -70px;
  position:relative;
  text-align:center;
  font-family: 'Jua';
  height:50px;
  font-size:2em;
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


      p#round_font {font-size : 300%;  font-weight: bold ; font-family: 'Lilita One', cursive;}

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

      echo "<div class='font_normal div_set font_han font_color'>TICKET CLUB 티켓팅</div>";
      echo "<div class='font_small div_set font_color'>".$row['match_team_home']." vs ".$row['match_team_away']." ".$row['match_date']." | ".$row['sta_name']."</div>";


      if($seat_info == "normal") {
        $id = $_SESSION['user_id']; // 예약유저 아이디
        $tot_seat_num = $row['total_seat_normal']; //총 좌석 수
        $reserved_num = $row['reserved_seat_normal']; //예약된 좌석수
        $Remaining_seat = $tot_seat_num - $reserved_num; //남은 좌석
        $ticket_price = $row['price_ticket_normal']; //티켓 가격
        $stadium = $row['sta_name']; // 예약경기장 이름
        $ticket_num = $_POST['ticket_num']; //예약인원

        if ($Remaining_seat < $ticket_num ){         // 남은 좌석보다 예약인원이 많다면
          echo"<center>";
          echo"<br>";
          echo"<br>";

          echo "<div class='font_big font_color font_jua'>남은 여석이 부족합니다 예매할 수 없습니다. <br></div>";
          echo "<button class='font_big font_color font_jua' onClick=window.close()>나가기</button> ";
          echo"</center>";

          exit();
        }

        if($ticket_num==NULL || $ticket_num <= 0) {   // 예약인원이 음수,0 또는 공백일 경우
          echo"<center>";
          echo"<br>";
          echo"<br>";

          echo "<div class='font_big font_color font_jua'>인원수를 정확히 입력해 주십시오.<br></div>";
          echo"<br>";
          echo"<br>";
          echo"<br>";

          echo "<button class='font_big font_color font_jua onClick=window.close()>나가기</button>";
          echo"</center>";

          exit();
        }

        $total_price = $ticket_num * $ticket_price ;

        echo "<center>";
        echo"<br>";
        echo"<br>";
        echo"<br>";
        echo"<br>";


        echo"<div class='font_normal font_color font_jua'>";

        echo "예약유저: {$id} <br>";
        echo "경기장: {$stadium} <br>";
        echo "좌석등급: {$seat_info} <br>";
        echo "인원수: {$ticket_num}명 <br>";
        echo "좌석가격:";
        echo number_format($ticket_price);
        echo "원 <br>";
        echo "총 티켓 가격:";
        echo number_format($total_price);
        echo "원 <br>";
        echo "위 정보가 맞습니까?<br>";
        echo"<br>";
        echo "</div>";
        echo"</center>";

        echo "<form action='./purchase_upload.php' method='post'>
                <input type='hidden' name='ticket_num' value='$ticket_num'>
                <input type='hidden' name='match_num' value='$match_num'>
                <input type='hidden' name='seat_info' value='$seat_info'>
                <center>
                <div >
                <button>확인</button>
                <a class='font_normal bton font_jua' style='margin-left:20px' onClick='window.close()' >취소</a></div>
                </center>

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
          echo "<center>";
          echo"<br>";
          echo"<br>";
          echo"<br>";
          echo"<br>";
          echo"<br>";
          echo"<br>";
          echo"<br>";
          echo"<br>";
          echo"<br>";


          echo "<div class='font_big font_color font_han'>좌석을 선택하지 않아 예매를 진행할 수 없습니다.<br></div>";
          echo"<br>";
          echo"<br>";
          echo"<br>";

          echo"<button onClick=window.close() class='font_big font_jua'>나가기</button>";
          echo "</center>";

          exit();
        }

        echo "<center>";
        echo"<br>";
        echo"<br>";
        echo"<br>";
        echo"<br>";

        echo"<div class='font_normal font_color font_jua'>";

        echo "예약유저: {$id} <br>";
        echo "경기장: {$stadium} <br>";
        echo "좌석등급: {$seat_info} <br>";
        echo "좌석위치: {$received_str} <br>";
        echo "인원수: {$ticket_num}명 <br>";
        echo "좌석가격:";
        echo number_format($ticket_price);
        echo "원 <br>";
        echo "총 티켓 가격:";
        echo number_format($total_price);
        echo "원 <br>";

        echo "위 정보가 맞습니까?<br>";
        echo "</div>";
        echo"<br>";
        echo "</center>";

        echo "<form action='./purchase_upload.php' method='post'>
                <input type='hidden' name='select_seat' value='$received_str'>
                <input type='hidden' name='match_num' value='$match_num'>
                <input type='hidden' name='seat_info' value='$seat_info'>
                <center>
                <div>
                <button>확인</button>
                <a class='font_normal bton font_jua' style='margin-left:20px' onClick='window.close()' >취소</a>

                </div>
                </center>

              </form>";

      }
    ?>

  </body>
</html>
