<html>
  <head>
    <link href="https://fonts.googleapis.com/css?family=Bangers|Black+Han+Sans|Jua|Staatliches&display=swap" rel="stylesheet">
    <style type="text/css">
	   form {
		     width:300px;
		     margin: 0 auto;
	   }
     .font_big { font-size: 2em; }
     .font_color {color: white;}
     .font_bold { font-weight: bold; }
     .font_center { text-align: center; }
     .font_jua {font-family: 'Jua';}
     .font_han {font-family: 'Black Han Sans';}

      p#round_font {font-size : 300%;  font-weight: bold ; font-family: 'Bangers', cursive;}

      body {
        background-image : url('img/background/stadium.jpg');
        background-size : 100% ;
      }
    </style>

    <script type="text/javascript">
    function SetSelectBox() {
      var seat = $("#seat option:selected").text(); //select에서 좌석정보 받기

    }
    </script>
  </head>

  <body>
    <!-- 로고 상단 삽입, 예매 페이지로 링크 -->
	<a href="main_page.php"><img src="img\logo_page\top_logo4.png" width="100" ></a>
    <!-- 로그인칸과 회원가입칸 설정 -->
    <table align="right" height="5"  style="margin-top:1%">
       <tr>
         <td>
           <!-- 로그인칸 클릭시 로그인 창으로 이동 -->
           <!-- 폰트는 크게,글꼴은 black han sans-->
           <input type="button" name="login" value="로그인" style="margin-right:10px;"  class="font_big font_han" onClick= "location.href= 'login.php'" >
           <!-- 회원가입칸 클릭시 회원가입 창으로 이동 -->
           <input type="button" value="회원가입"  class="font_big font_han" onClick= "location.href= 'register.php'">
          </td>
        </tr>
       </table>

       <p height="10" style="margin-left:680px;" id="round_font">라인업</p>
       <p style= "text-align: center;">
       <img src="img\lineup\SUWON_LINEUP.png" width="500"   />
       <img src="img\lineup\GYEONGNAM_LINEUP2.png" width="545" style=" margin-left: 50px;  margin-right: auto;"/></p>

       <!--
       먼저 VIP or 일반석 선택받고 그 조건문 이용 일반석 이면 남은 자릿수와 매수선택, 가격, 예매표시
       VIP 석은 20석 한정으로 좌석표시 버튼(누르면 팝업으로 좌석 표 보여줌), 매수선택, 가격, 예매표시
       -->
       <form>
       <label id='seat'>좌석종류 선택</label>
         <select id='seat' onchange="SetSelectBox();">
           <option>VIP석</option>
           <option>일반석</option>
         </select>
         
         <p id="demo"></p>
         <script>
          document.getElementById("demo").innerHTML = seat;
         </script>

         <input type="button" name="return" value="돌아가기"   class="font_big font_jua" onClick= "location.href='main_page.php'">
       </form>
    </body>
</html>
