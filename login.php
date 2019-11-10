<html>
  <head>
    <style>
      .select_color { color: blue;}
		  .font_big { font-size: 2em; }
      .font_Arial { font-family: Arial; }
      .font_bold { font-weight: bold; }
      .font_center { text-align: center; }
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
    <a href="main_page.php"><img src="img\logo_page\top_logo2.jpg" style="margin-left: auto; margin-right: auto; display: block"/></a>
    <!--  view2로 post방식으로 입력정보 전달 -->
    <form name="form1" method="post" action="post_login.php" >
	    <!-- ID 입력 -->
		  <p class= "select_color font_big font_center font_Arial">I&nbsp;D : <input type="text" name="id" style="height:40px; width:230px;"></p>
		  <!-- PASSWORD 입력 -->
		  <p class= "select_color font_big font_center font_Arial">PW: <input type="password" name="pass" style="height:40px; width:230px;"></p>
      <!-- 로그인칸과 회원가입칸 설정 -->
      <table align="center" height="40" style="margin-top:1%">
       <tr>
         <td>
           <!-- 로그인칸 클릭시 로그인 창으로 이동 -->
			     <input type="submit" name="login" value="로그인" style="margin-right:30px;"  class="font_big select_color" onclick = "move_page()">
           <!-- 회원가입칸 클릭시 회원가입 창으로 이동 -->
			     <input type="button" value="회원가입"  class="font_big select_color" onClick = "location.href= 'register.php'">
			   </td>
       </tr>
	</table>
</form>

</body>



</html>
