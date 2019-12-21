<?php
  include("dbconn.php");  //db연결파일 포함
?>

<html>
 <head>
 <!-- 구글 정식 글꼴타입 하이퍼링크로 따옴-->
 <link href="https://fonts.googleapis.com/css?family=Black+Han+Sans|Jua|Lilita+One|Nanum+Gothic|Noto+Sans+KR|Oswald&display=swap" rel="stylesheet">
  <style type="text/css">
  	 .font_big { font-size: 2em; }
      .font_bigger { font-size: 3em; }
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
  background:#393e46;
  color:#fff;
  border:none;
  position:relative;
  text-align:center;
  font-family: 'Jua';
  height:50px;
  font-size:2.3em;
  padding:0em;
  cursor:pointer;
  transition:800ms ease all;
  outline:none;
}
button:hover{
  background:#fff;
  color:#393e46;
}
button:before,button:after{
  content:'';
  position:absolute;
  top:0;
  right:0;
  height:2px;
  width:0;
  background: #393e46;
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



      #btn_group button{ border: 2px solid white; font-family: 'Jua'; font-size:2.3em; background-color: rgba(0,0,0,0); color: white; padding: 6px; }
      #btn_group button:hover{ color:black; background-color: skyblue; }



      p#round_font {font-size : 300%;  font-weight: bold ; font-family: 'Bangers', cursive;}

      body {
        background-image : url("img/background/stadium.jpg");
        background-size : 100% ;
      }
    </style>

	<script >
		function not_logined () {   // 예매버튼 눌렀을때 로그인 되지 않은것을 안내해주는 함수
		alert("로그인 후 이용해주세요.");
		}
	</script>

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
             <button style="margin-right:10px;" class="font_han font_big" onclick="window.open('login.php', 'login', 'width=500px, height=500px')" >로그인</button>

             <!-- 회원가입칸 클릭시 팝업으로 회원가입 창으로 이동 -->
             <button style="margin-right:10px;" class="font_han font_big" onclick="window.open('register.php', 'register', 'width=500px, height=500px')" >회원가입</button>

 			    </td>
         </tr>
 	     </table>
 <?php
 $sql = "SELECT * FROM match_info
 		JOIN stadium ON match_info.match_sta_num = stadium.sta_num
 		ORDER BY match_info.match_num";

 $result = mysqli_query($conn, $sql);

  echo  "<p align='center' height='100' class='font_lilita font_bigger'  > 27R </p>";

  if (mysqli_num_rows($result) > 0) {
      echo "<table align='center' border='1' height='100'  style='margin-top:5%' >
      <tr>
         <td colspan='2'  class = 'font_big font_center font_color font_jua'>일자</td>
         <td  class = 'font_big font_center font_color font_jua '>시간</td>
         <td  class = 'font_big font_center font_color font_jua ' colspan='2'>경기장</td>
         <td colspan='3'   class = 'font_big font_color font_jua ' style='padding:0 0 0 85px;' >라인업</td>
      </tr>";

      while ($row = mysqli_fetch_array($result)) {
          $strTok = explode(' ', $row['match_date']);  //문자열 나눠주는 함수
          echo "<tr>";
          echo "<td colspan='2'  class = 'font_big font_center font_color font_jua'>".$strTok[0]."</td>";
          echo "<td class = 'font_big font_color font_jua '>".$strTok[1]."</td>";
          echo "<td colspan='2'  class = 'font_big font_center font_color font_jua'>".$row['sta_name']."</td>";
          echo "<td class = 'font_big font_center font_color font_jua '><img src='".$row['team_logo_home']."' width='40'/>".$row['match_team_home']."VS <img src='".$row['team_logo_away']."'width='40'/>".$row['match_team_away']."</td>";
          echo "<td><form action = './reservation.php' method = 'post'>
          <input type = 'hidden' name = 'match_num' value = '".$row['match_num']."'>
          <div id='btn_group'>
          <button > 예매하기</button> </div>

          </form></td>";
          echo "</tr>";
      }
      echo "</table>";
  } else {
     echo "저장된 데이터가 없습니다.";
 }
 ?>


       </tr>
     </table>
   </body>
 </html>
