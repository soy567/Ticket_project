<html>
 <head>

 <!-- 구글 정식 글꼴타입 하이퍼링크로 따옴-->
 <link href="https://fonts.googleapis.com/css?family=Bangers|Black+Han+Sans|Jua|Staatliches&display=swap" rel="stylesheet">
 <style type="text/css">


		  .font_big { font-size: 2em; }
      .font_color {color: white;}
      .font_bold { font-weight: bold; }
      .font_center { text-align: center; }
      .font_jua {font-family: 'Jua';}
      .font_han {font-family: 'Black Han Sans';}

      p#round_font {font-size : 300%;  font-weight: bold ; font-family: 'Bangers', cursive;}

      body {
        background-image : url("img/background/stadium.jpg");
        background-size : 100% ;
      }
    </style>
 </head>

 <body>
      <!-- 로고 상단 삽입, 예매 페이지로 링크 -->
	     <a href="main_page.php"><img src="img/logo_page/top_logo4.png" width="100" ></a>

       <!-- 로그인칸과 회원가입칸 설정 -->
       <table align="right" height="5"  style="margin-top:1%">
        <tr>
          <td>
            <!-- 로그인칸 클릭시 팝업으로 로그인 창으로 이동 -->
            <!-- 폰트는 크게,글꼴은 black han sans-->
			      <input type="button" value="로그인" style="margin-right:10px;"  class="font_big font_han" onclick="window.open('login.php', 'login', 'width=500px, height=500px')">
            <!-- 회원가입칸 클릭시 팝업으로 회원가입 창으로 이동 -->
			      <input type="button" value="회원가입"  class="font_big font_han" onclick="window.open('register.php', 'register', 'width=500px, height=500px')">
			    </td>
        </tr>
	     </table>

       <p align="center" height="10" id="round_font"  > 27R </p>

      <!-- K리그 27라운드 매치업 정리 -->
      <table align="center" border="1" height="100"  style="margin-top:5%" >

      <!-- 폰트는 크게,글꼴은 jua, 색깔은 흰색-->
      <tr>
        <td colspan="2"  class = "font_big font_center font_color font_jua">일자</td>
        <td  class = "font_big font_center font_color font_jua ">시간</td>
        <td  class = "font_big font_center font_color font_jua " colspan="2">경기장</td>
        <td colspan="3"   class = "font_big font_color font_jua " style="padding:0 0 0 85px;" >라인업</td>
      </tr>

      <tr>
        <!-- 8.23일자 경기 경남VS수원 이미지삽입및 행열정리-->
        <!-- 폰트는 크게,글꼴은 jua, 색깔은 흰색-->
        <td colspan="2"  class = "font_big font_center font_color font_jua">8.23 (금)</td>
        <td class = "font_big font_color font_jua ">19:30</td>
        <td colspan="2"  class = "font_big font_center font_color font_jua">창원축구센터</td>
        <td class = "font_big font_center font_color font_jua"> <img src="img\logo_team\normal\KLEAGUE1\GYEONGNAM.PNG" width="40" />경남  VS <img src="img\logo_team\normal\KLEAGUE1\SUWON.PNG" width="40" />수원</td>

        <td><input type="button" class="font_big font_jua " value="예매하기" onclick="location.href='reservation_1.php'"></td>
      </tr>

      <tr>
        <!-- 8.24일자 울산VS상주 경기 이미지삽입및 행열정리-->
        <!-- 폰트는 크게,글꼴은 jua, 색깔은 흰색-->
        <td colspan="2" rowspan="3"  class = "font_big font_center font_color font_jua " ><br>8.24 (토)<br><br></td>
        <td  class = "font_big font_color font_jua ">19:00</td>
        <td colspan="2"  class = "font_big font_center font_color font_jua ">울산 종합</td>
        <td  class = "font_big font_center font_color font_jua "><img src="img\logo_team\normal\KLEAGUE1\ULSAN.PNG" width="40" />울산 VS <img src="img\logo_team\normal\KLEAGUE1\SANGJOO.PNG" width="40" />상주</td>

        <td><input type="button" class="font_big font_jua "  value="예매하기" style="margin-right:20px;" onclick="location.href='reservation_2.php'"</td>
      </tr>

      <tr>
        <!-- 8.24일자 전북VS성남 경기 이미지삽입및 행열정리-->
        <!-- 폰트는 크게,글꼴은 jua, 색깔은 흰색-->
        <td  class = "font_big font_color font_jua ">19:00</td>
        <td colspan="2"  class = "font_big font_center font_color font_jua ">전주 월드컵</td>
        <td  class = "font_big font_center font_color font_jua"><img src="img\logo_team\normal\KLEAGUE1\JEONBUK.PNG" width="40" />전북 VS <img src="img\logo_team\normal\KLEAGUE1\SEONGNAM.PNG" width="40" />성남</td>

        <td><input type="button" class="font_big font_jua " value="예매하기" style="margin-right:20px;" onclick="location.href='post_login.php'"></td>
      </tr>
      <tr>
        <!-- 8.24일자 대구VS강원 경기 이미지삽입및 행열정리-->
        <!-- 폰트는 크게,글꼴은 jua, 색깔은 흰색-->
        <td class = "font_big font_center font_color font_jua ">19:30</td>
        <td colspan="2"  class = "font_big font_center font_color font_jua ">DGB대구은행파크</td>
        <td class = "font_big font_center font_color font_jua "><img src="img\logo_team\normal\KLEAGUE1\DAEGU.PNG" width="40" />대구 VS <img src="img\logo_team\normal\KLEAGUE1\GANGWON.PNG" width="40" />강원</td>

        <td><input type="button" class="font_big font_jua " value="예매하기" style="margin-right:20px;" onclick="location.href='post_login.php'"></td>
      </tr>

      <tr>
        <!-- 8.25일자 포항VS인천 경기 이미지삽입및 행열정리-->
        <!-- 폰트는 크게,글꼴은 jua, 색깔은 흰색-->
        <td colspan="2" rowspan="2"  class = "font_big font_center font_color font_jua ">8.25 (일)</td>
        <td  class = "font_big font_center font_color font_jua ">19:00</td>
        <td colspan="2"  class = "font_big font_center font_color font_jua ">포항 스틸야드</td>
        <td  class = "font_big font_center font_color font_jua "><img src="img\logo_team\normal\KLEAGUE1\POHANG.PNG" width="40" />포항 VS <img src="img\logo_team\normal\KLEAGUE1\INCHEON.PNG" width="40" />인천</td>

        <td><input type="button" class="font_big font_jua " value="예매하기" style="margin-right:20px;" onclick="location.href='post_login.php'"></td>
      </tr>
      <tr>
        <!-- 8.25일자 제주VS서울 경기 이미지삽입및 행열정리-->
        <!-- 폰트는 크게,글꼴은 jua, 색깔은 흰색-->
        <td class = "font_big font_center font_color font_jua ">19:00</td>
        <td colspan="2"  class = "font_big font_center font_color font_jua ">제주 월드컵</td>
        <td class = "font_big font_center font_color font_jua "><img src="img\logo_team\normal\KLEAGUE1\JEJU.PNG" width="40" />제주 VS <img src="img\logo_team\normal\KLEAGUE1\SEOUL.PNG" width="40" />서울</td>

        <td><input type="button" class="font_big font_jua " value="예매하기" style="margin-right:20px;" onclick="location.href='post_login.php'"> </td>
      </tr>
    </table>
  </body>
 </html>
