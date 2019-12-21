<?php
  include("dbconn.php");
  $reserve_num = $_POST['reserve_num'];
  $seat_info = $_POST['seat_info'];
  $cancel_seat_EA = $_POST['num_ticket']; //취소할 좌석 수
  $match_num = $_POST['match_num'];
?>
<!DOCTYPE html>
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

      .bton{
  background:#617be3;
  color:#fff;
  border:none;
  position:relative;
  text-align:center;
  font-family: 'Jua';
  height:32.5px;
  font-size:1.8em;
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


      p#round_font {font-size : 300%;  font-weight: bold ; font-family: 'Lilita One', cursive;}

      body{
          background-image : url('img/background/img2.jpg');
          background-size : 100% ;
        }

      
</style>
  </head>
  <body>
    <?php
      if ($_SESSION['user_id'] == null) { //로그인 하지 않고 접근했을때 처리 함수 (세션 검사)
          print "<script> alert('로그인 되지 않았습니다.'); location.replace('./first_page.php'); </script>";
      }
    ?>
    
    <!-- 로고 상단 삽입, 예매 페이지로 링크 -->
	  <a href="main_page.php"><img src="img\logo_page\top_logo4.png" width="100" ></a>


    <!-- 아이디와 로그아웃 버튼 표시 -->
    <table align="right" height="5"  style="margin-top:1%">
     <tr>
        <td class=" font_big font_color font_normal font_jua">
          <?php
          echo "아이디: ".$_SESSION['user_id'];
          ?>
        </td>
        <td>
        <button style="margin-right:10px;"  class="font_han font_big" onclick="location.href = 'page_user_info.php'">마이페이지</button>
        <button style="margin-right:10px;"  class="font_han font_big" onclick="location.href = 'logout.php'">로그아웃</button>
                </td>
      </tr>
    </table>

    <?php
    $sql = "SELECT * FROM reserve_info
    JOIN stadium ON reserve_info.reserved_sta_num = stadium.sta_num
    WHERE reserve_num = $reserve_num";

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    if ($seat_info == 'normal') {
        $sql_2 = "SELECT * FROM match_info
        JOIN stadium ON match_info.match_sta_num = stadium.sta_num
        WHERE match_info.match_num = $match_num"; //stadium 테이블 정보 불러오기위해 match_info 테이블과 stadium 테이블 JOIN하여 사용(해당 match_num에 해당하는 정보만)

        $result_2 = mysqli_query($conn, $sql_2);
        $row_2 = mysqli_fetch_array($result_2);

        $tot_ticket_price = $row['tot_ticket_price'];
        $ticket_price = $row_2['price_ticket_normal'];
        $tot_place = $row['tot_ticket_num_or_vip_seat_place'];
        $reserved_num = $row_2['reserved_seat_normal'];
        $stadium_num = $row_2['match_sta_num'];
        $change_reserved_seat = $reserved_num - $cancel_seat_EA;
        $change_place = $tot_place - $cancel_seat_EA;
        $change_price = $tot_ticket_price - $ticket_price * $cancel_seat_EA;

        if ($cancel_seat_EA == $row['tot_ticket_num_or_vip_seat_place']) {
            $delete = mysqli_query($conn, "DELETE FROM reserve_info WHERE reserve_num = '$reserve_num';");
            $update_4 = mysqli_query($conn, "UPDATE stadium set reserved_seat_normal='$change_reserved_seat' where sta_num = '$stadium_num';");
        } else {
            $update = mysqli_query($conn, "UPDATE reserve_info set tot_ticket_num_or_vip_seat_place='$change_place' where reserve_num = '$reserve_num';");
            $update_2 = mysqli_query($conn, "UPDATE reserve_info set tot_ticket_price='$change_price' where reserve_num = '$reserve_num';");
            $update_3 = mysqli_query($conn, "UPDATE stadium set reserved_seat_normal='$change_reserved_seat' where sta_num = '$stadium_num';");
        }

        if ($delete) {
          echo "<center>";
          echo "<br>";
          echo "<br>";
          echo "<br>";
          echo "<br>";
          echo "<br>";
          echo "<br>";


          echo "<div class='font_big font_color font_jua'>예매취소완료.</br></div>";
          echo "<br>";
          echo "<br>";
          echo "<br>";
          echo "<a href=page_user_info.php class='font_big bton font_jua'>뒤로가기</a>";
          echo "</center>";

        }
        if ($update) {
          echo "<center>";
          echo "<br>";
          echo "<br>";
          echo "<br>";
            echo "<div class='font_big font_color font_jua'>예약좌석 변경 완료.</div>";
            echo "<br>";
            echo "<br>";
            echo "<br>";
            
            echo "<a href=page_user_info.php class='font_big bton font_jua'>뒤로가기</a>";
            echo "</center>";
        }
    }
    else if($seat_info == 'vip') {
      $seat_can = $row['tot_ticket_num_or_vip_seat_place'];
      $update_num = --$row['reserved_seat_vip'];
      $reserved_sta_num = $row['reserved_sta_num'];
      $update = mysqli_query($conn, "UPDATE stadium set reserved_seat_vip= '$update_num' WHERE sta_num = '$reserved_sta_num';");
      $delete = mysqli_query($conn, "DELETE FROM reserve_info WHERE reserve_num = '$reserve_num';");

      if ($delete) {
        echo "<center>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";



        echo "<div class='font_big font_color font_jua'>예매취소완료.</div>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        
        echo "<a href=page_user_info.php class='font_big bton font_jua'>뒤로가기</a>";
      }
    }
    ?>
  </body>
</html>
