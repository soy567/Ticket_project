<!-- form으로 매치 번호 불러와 해당 좌석예매 페이지 뜨도록 페이지 작성 -->
<?php
  include("dbconn.php");
  $match_num = $_POST['match_num'];
?>
<html>
  <head>
  <link href="https://fonts.googleapis.com/css?family=Black+Han+Sans|Jua|Lilita+One|Nanum+Gothic|Noto+Sans+KR|Oswald&display=swap" rel="stylesheet">
    <style type="text/css">
	     form {
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
      .font_oswald{font-family: 'Oswald', sans-serif;}
      .font_lilita{font-family: 'Lilita One', cursive;}

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

      if(seat == 'vip') {                 // vip좌석 선택시 vip결제페이지로 넘어가도록 설정
        frm.action = "purchase_vip.php";
        frm.target = "match_num";
        frm.method = "post";
      }

      else {                               // 일반좌석 선택시 일반좌석 졀제 페이지로 넘어가도록 설정
          frm.action = "purchase_normal.php";
          frm.target = "match_num";
          frm.method = "post";
        }
      }
    </script>
  </head>

  <body>
    <?php
    
     $sql = "SELECT * FROM match_info
         JOIN stadium ON match_info.match_sta_num = stadium.sta_num
         WHERE match_info.match_num = $match_num"; //stadium 테이블 정보 불러오기위해 match_info 테이블과 stadium 테이블 JOIN하여 사용
     $result = mysqli_query($conn, $sql);
     $row = mysqli_fetch_array($result);
     ?>
         <!-- 폰트는 han, 색상은 흰색, div클래스 바탕색 설정-->
     <div class="font_normal div_set font_han font_color ">TICKET CLUB 티켓팅</div>
     <div class="font_small div_set  font_color "><?php echo $row['match_team_home'] ?> vs <?php echo $row['match_team_away']?>  <?php echo $row['match_date']?> | <?php echo $row['sta_name']?> </div>
     <center>
     <!--좌석 사진 설정-->
    <img src="img\stadium\stadium3.png" width="500px" style=" margin-top: 20px; margin-left: -10px;  margin-right: auto;"/>
    </center>
      <!--
       먼저 VIP or 일반석 선택받고 그 조건문 이용 일반석 이면 남은 자릿수와 매수선택, 가격, 예매표시
       VIP 석은 20석 한정으로 좌석표시 버튼(누르면 팝업으로 좌석 표 보여줌), 매수선택, 가격, 예매표시
       -->
       <center>
       <form name="match_num" method="post">
       <label class="font_big font_jua">좌석종류 선택</label>
         <select id='seat' class="font_big font_jua" onchange="SetSelectBox();">
           <option value="vip"> VIP석</option>
           <option value="normal"> 일반석</option>
         </select>

        <!-- 돌아가기 버튼 설정-->
         <button class="font_big font_jua"  href="#" onclick="window.close()"> 돌아가기</button>
         <input type="hidden"  name="match_num" value="<?php echo $match_num ?>" class="font_big font_jua">


        <!-- 예매하기 버튼 설정-->

         <button onClick=  "move_purchase()"> 예매하기</button>

       </form>
       </center>

    </body>
</html>
