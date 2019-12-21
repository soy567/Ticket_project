<html>
  <head>
    <!-- 구글 정식 글꼴타입 하이퍼링크로 따옴-->
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR|Bangers|Black+Han+Sans|Jua|Staatliches&display=swap" rel="stylesheet">
    <style>
      .font_big { font-size: 2em; }
      .font_normal {font-size: 1.5em;}
      .font_color {color: white;}
      .font_bold { font-weight: bold; }
      .font_center { text-align: center; }
      .font_jua {font-family: 'Jua';}
      .font_han {font-family: 'Black Han Sans';}
      .font_noto{font-family: 'Noto Sans KR', sans-serif};


      button{
  background:#393e46;
  color:#fff;
  border:none;
  position:relative;
  text-align:center;
  font-family: 'Jua';
  height:50px;
  font-size:2.1em;
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

    </style>

    <script language="JavaScript">
      function move_page() {
        opener.document.location.href='main_page.php';
        window.close();
      }
    </script>
  </head>

  <body>
    <!-- 로고 중앙 삽입, 예매 페이지로 링크 -->
    <img src="img\logo_page\top_logo2.jpg" style="margin-left: auto; margin-right: auto; display: block"/></a>

    <!--  view2로 post방식으로 입력정보 전달 -->
    <form name="form1" method="post" action="./login_check.php" >
	    <!-- ID 입력 -->
		  <p class= "select_color font_big font_center font_jua">I&nbsp;D : <input type="text" name="id" style="height:40px; width:230px;"></p>
		  <!-- PASSWORD 입력 -->
		  <p class= "select_color font_big font_center font_jua">P&nbsp;W: <input type="password" name="pw" style="height:40px; width:230px;"></p>
      <!-- 로그인칸과 회원가입칸 설정 -->
      <table align="center" height="40" style="margin-top:1%">
       <tr>
         <td>
           <!-- 로그인칸 클릭시 로그인 창으로 이동 -->
           <input type="submit" name="login" value="로그인" style="margin-right:30px; border: none;  background-color:#393e46;"  class="font_big font_color font_han " action="/login_check.php">

           <!-- 회원가입칸 클릭시 회원가입 창으로 이동 -->
           <input type="button" value="회원가입" style=" border: none;  background-color:#393e46;"  class="font_big font_color font_han " onClick = "location.href= 'register.php'">

			   </td>
       </tr>
	   </table>
    </form>

  </body>
</html>
