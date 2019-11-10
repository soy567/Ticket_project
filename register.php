<html>
<head>
	<title>Post</title>
	<style>
	form{
		width:175px;
		margin: 0 auto;
	}
	</style>

	<script language="JavaScript">
		function move_page(URL) {
			opener.document.location.href = URL;
			window.close();
		}
		</script>

</head>
<body>
	<!-- 로고 중앙 삽입, 예매 페이지로 링크 -->
	<a href="main_page.php"><img src="img\logo_page\top_logo2.jpg" style="margin-left: auto; margin-right: auto; display: block"/></a>
	<!-- 회원가입 완료시 회원가입완료 창으로 이동 -->
	<div id="reg_info">
	<form action="./post_regist.php" method="post">
	<!-- 회원가입 내역 칸 설정 -->
		<div><label for="name">이름 :</label></div>
		<div><input id="name" type="text" name="name"></div>

		<div><label for="id">아이디 : </label></div>
		<div><input id="id" type="text" name="id"></div>
		<div><label for="pw1">비밀번호 : </label></div>
		<div><input id="pw" type="password" name="pw"></div>
		<div><label for="pw_2">비밀번호&nbsp;확인 :</label></div>
		<div><input id="pw_2" type="password" name="pw_2"></div>
		<div>성별:
		<input id="남성" type="radio" name="gender" value="남성">
		<label for="남성">남성</label>
    <input id="여성" type="radio" name="gender" value="여성">
		<label for="여성">여성</label></div>
		<!--
		pw1, pw2 확인 후 같아야 post_register로 이동
		-->
		<div><input type="submit" value="회원가입" style="margin-right:20px;">
		<input type="button" name="return" value="돌아가기"  class="font_big select_color" onClick="location.href='login.php'"></div>
	</form>
	</div>
</body>
</html>
