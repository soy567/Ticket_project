<?php
  include("dbconn.php");
  $reserve_num = $_POST['reserve_num'];
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>예매 변경 페이지</title>

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
     <a href="main_page.php"><img src="img/logo_page/top_logo4.png" width="100" ></a>
     <!-- 아이디와 로그아웃 버튼 표시 -->
     <table align="right" height="5"  style="margin-top:1%">
      <tr>
         <td class="font_color font_normal font_jua">
           <?php
           echo "아이디: ".$_SESSION['user_id'];
           ?>
         </td>
         <td>
         <button  style="margin-right:10px;"  class="font_han font_big" onclick="location.href = 'page_user_info.php'">마이페이지 </button>
         <button  style="margin-right:10px;"  class="font_han font_big" onclick="location.href = 'logout.php'">로그아웃</button>

         </td>
       </tr>
     </table>

     <?php
     $sql = "SELECT * FROM reserve_info
     JOIN stadium ON reserve_info.reserved_sta_num = stadium.sta_num
     WHERE reserve_num = $reserve_num";
     $result = mysqli_query($conn, $sql);

     if (mysqli_num_rows($result) == 0) {
      echo "<center>";
      echo "<br>";
      echo "<br>";
      echo "<br>";
       echo "<br>";
      echo "<br>";
      echo "<br>";


      echo "<div class='font_normal font_color font_jua'>해당하는 예약정보가 없습니다.</div>";
      echo "<br>";
      echo "<br>";


      echo "</center>";

      //버튼으로 마이페이지로 이동.

    }

     else {
       $reserved_seat = array();  //예약된 좌석 정보 저장할 배열 변수 선언
       $row = mysqli_fetch_array($result);

       if($row['seat_info'] == 'normal') { //좌석이 일반석일 경우
         $match_num = $row['reserved_match_num'];
         echo "<center>";
         echo "<br>";
         echo "<br>";
         echo "<br>";
         echo "<br>";

         echo "<div class='font_normal font_color font_jua'>현재 예약된 정보</div>";
         echo "<div class='font_normal font_color font_jua'>티켓 매수: ".$row['tot_ticket_num_or_vip_seat_place']." | 좌석정보: ".$row['seat_info']."</div>";
         echo "<form name = 'num_ticket' action='fix_reserve_info.php' method='post'>";
         echo "<select class='font_normal  font_jua' name = 'num_ticket'>";

         for($i=0; $i <= $row['tot_ticket_num_or_vip_seat_place']; $i++) {
          echo "<option class='font_normal  font_jua' value = $i> {$i}매 </option>";

        }
         echo "</select>";
         echo "<input type='hidden' name='match_num' value='$match_num'>";
         echo "<input type='hidden' name='seat_info' value='normal'>";
         echo "<input type='hidden' name='reserve_num' value='$reserve_num'>";
         echo "<button class='font_normal font_color font_jua' style='margin-left:15px'>취소하기</button>";
         echo "</form>";
         echo "</center>";

       }

       else if ($row['seat_info'] == 'vip'){
         $reserved_seat[] = $row['tot_ticket_num_or_vip_seat_place'];
         echo "<center>";
         echo "<br>";
         echo "<br>";
         echo "<br>";
         echo "<br>";
         echo "<br>";

         echo "<br><div class='font_big font_color font_jua'>현재 예약된 정보</div><br>";

         echo "<div class='font_normal font_color font_jua'>좌석위치: ".$row['tot_ticket_num_or_vip_seat_place']." | 좌석정보: ".$row['seat_info']."<br></div>";
         echo "<div class='font_normal font_color font_jua'>좌석위치<br></div>";
         echo "<div class='font_normal font_color font_jua'>경기장<br></div>";
         echo "<br>";

         echo "<table border='1' cellpadding='0' cellspacing='0' class='font_big font_color font_lilita'>";

         for ($i='A', $k=0; $i<'C'; $i++) {
             echo "<tr>";
             for ($j='A'; $j<'I'; $j++) {
               if ($reserved_seat[$k] == "$i$j") {
                 echo "<td id='$i$j' style='background:red'>&nbsp-&nbsp</td>";
                 if ($k < count($reserved_seat) - 1) {
                   $k++;
                 }
                 continue;
               }
             echo "<td id='$i$j' style='background:grey'> $i$j </td>";
             }
           echo "</tr>";
           }
           echo "</table>";
           echo "</center>";


         echo "<br>";
         echo "<br>";
       echo "<center>";



         echo "<form name = 'num_ticket' action='fix_reserve_info.php' method='post'>";
         echo "<input type='hidden' name='match_num' value='$match_num'>";
         echo "<input type='hidden' name='reserve_num' value='$reserve_num'>";
         echo "<input type='hidden' name='seat_info' value='vip'>";
 echo "<button class='font_big font_jua'>취소하기</button>";
echo"</center>";


 echo "</form>";
    }
  }
  ?>
  </body>
</html>
