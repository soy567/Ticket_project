<?php
  include("dbconn.php");
 ?>
<html>
  <head>
    <!-- 구글 정식 글꼴타입 하이퍼링크로 따옴-->
    <link href="https://fonts.googleapis.com/css?family=Black+Han+Sans|Courier+Prime|Jua|Nanum+Gothic|Noto+Sans+KR|Roboto&display=swap" rel="stylesheet">

        <style type="text/css">

      .font_small {font-size: 1em; }
		  .font_big { font-size: 2em; }
      .font_normal {font-size: 1.5em;}
      .font_color {color: white;}
      .font_bold { font-weight: bold; }
      .font_center { text-align: center; }
      .font_jua {font-family: 'Jua';}
      .font_han {font-family: 'Black Han Sans';}
      .font_noto{font-family: 'Noto Sans KR', sans-serif;}
      p#round_font {font-size : 300%;  font-weight: bold ; font-family: 'Bangers', cursive;}

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



      #btn1{ border-top-left-radius: 5px; border-bottom-left-radius: 5px; border-top-right-radius: 5px; border-bottom-right-radius: 5px; margin-right:-4px; }

#btn_set button{ border: 1px solid white; font-family: 'Noto Sans KR'; font-size:1em; background-color: rgba(0,0,0,0); color: white; padding: 5px; }
#btn_set button:hover{ color:black; background-color: skyblue; }


      body {
        background-image : url("img/background/12.png");
        background-size : 100% ;
      }

      * {margin: 0 auto;}
      a {color:#333; text-decoration: none;}
      .find {text-align:center; width:500px; margin-top:30px; }
    </style>

    <script>  //팝업창 띄우고 post방식으로 매치번호 seat_choice창에 전송해주는 함수
      function move_update_page () {
        var gsWin = window.open('about:blank', 'reserve_num', 'width=900px,height=500px');
        var form = document.reserve_num;
        form.action ="update_reserve_info.php";
        form.target ="reserve_num";
        form.method ="post";
        form.submit();
      }
    </script>

 </head>

 <body>
   <?php
    if ($_SESSION['user_id'] == null) { //로그인 하지 않고 접근했을때 처리 함수 (세션 검사)
        print "<script> alert('로그인 되지 않았습니다.'); location.replace('./first_page.php'); </script>";
    }
    ?>
      <!-- 로고 상단 삽입, 예매 페이지로 링크 -->
      <a href="main_page.php"><img src="img/logo_page/top_logo4.png" width="100" ></a>

      <table align="right" height="5"  style="margin-top:1%">
       <tr>
          <td class=" font_big font_color  font_normal font_jua">
            <?php
              echo "아이디: ".$_SESSION['user_id'];
            ?>
          </td>
          <td  >
          <button style="margin-right:10px;"  class="font_han font_big" onclick="location.href = 'logout.php'">로그아웃</button>

          </td>
        </tr>
      </table>

        <!-- 폰트는 크게,글꼴은 jua, 색깔은 흰색-->
      <?php
        $sql = "SELECT * FROM user";
              $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) { //로그인한 유저 아이디의 정보를 가져와 이름과 이메일을 출력
                    while ($row = mysqli_fetch_array($result)) {
                        if ($_SESSION['user_id'] == $row['user_id']) {
                            $name = $row['user_name'];
                            $email = $row['user_email'];
                            $user_id = $row['user_id'];
                        }
                    }
                }

                echo "<div class='find font_color font_noto'>
                <form method='post' action='page_change_pw.php'>
                  <h1 >마이페이지</h1>
                  <fieldset>
                    <legend>개인정보 </legend>
                    <table>
                      <tr>
                        <td class='font_color'>이메일: $email</td>
                      </tr>
                      <tr> 이름: $name</tr>
                    </table>
                    <input type='hidden' name='name' value='$name' />
                    <input type='hidden' name='email' value='$email' />
                    <input type='hidden' name='user_id' value='$user_id'/>
                    <div id='btn_set'>
                    <button id='btn1' onclick=''>비밀번호 변경</button></div>

                  </fieldset>
                </form>
              </div>;"
         ?>
       <?php
             $sql = "SELECT * FROM reserve_info
 				         JOIN stadium ON reserve_info.reserved_sta_num = stadium.sta_num
				         JOIN user ON reserve_info.reserved_user = user.user_id
                 WHERE reserve_info.reserved_user = '$user_id'
                 ORDER BY reserve_info.reserve_num";
             $result = mysqli_query($conn, $sql);

           if (mysqli_num_rows($result) > 0) {

                      echo "<table align='center' border='3' height='100' class='font_color  font_center font_noto ' style='margin-top:5%' >
  		                 <tr>
			                 <td>예약번호</td>
			                 <td>좌석위치(VIP석) | 티켓 수(일반석)</td>
			                 <td>총 예매가격</td>
			                 <td>경기장 이름</td>
                       <td>변경</td>
		                 </tr>";

               while ($row = mysqli_fetch_array($result)) {
                   if ($_SESSION['user_id'] == $row['user_id']) {
                       echo "<tr>";
                       echo "<td>" .$row['reserve_num']. "</td>";
                       echo "<td>" .$row['tot_ticket_num_or_vip_seat_place']. "</td>";
                       echo "<td>" .number_format($row['tot_ticket_price']). "</td>"; //가격 표시위해 number_format함수 사용
                       echo "<td>" .$row['sta_name']. "</td>";
                       echo "<td>";
                       ?>
                        <form name = "reserve_num" method="post" action="update_reserve_info.php">
                          <input type="hidden" name="reserve_num" value="<?php echo $row["reserve_num"]; ?>">
                          <div id='btn_set'>
                          <button id='btn1' onclick="">예매변경</button></div>

                          </form>
                        <?php
                       echo "</td>";
                       echo "</tr>";
                   }
               }
               echo "</table>";
           }
           else {
             echo"<center>";
             echo"<br>";
             echo"<br>";
             echo "<div class='font_color font_big font_jua'>예매한 티켓이 없습니다.</div>";
             echo"<br>";
             echo"</center>";


           }
      ?>
  </body>
 </html>
