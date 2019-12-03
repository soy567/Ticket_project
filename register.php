<html>
<head>
	<title>Post</title>
	<!-- 구글 정식 글꼴타입 하이퍼링크로 따옴-->
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR|Bangers|Black+Han+Sans|Jua|Staatliches&display=swap" rel="stylesheet">
	<style>
	form{
		width:175px;
		margin: 0 auto;
	}

		  .font_big { font-size: 2em; }
      .font_normal {font-size: 1.5em;}
      .font_color {color: white;}
      .font_bold { font-weight: bold; }
      .font_center { text-align: center; }
      .font_jua {font-family: 'Jua';}
      .font_han {font-family: 'Black Han Sans';}
      .font_noto{font-family: 'Noto Sans KR', sans-serif};
      p#round_font {font-size : 300%;  font-weight: bold ; font-family: 'Bangers', cursive;}

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
	<img src="img\logo_page\top_logo2.jpg" style="margin-left: auto; margin-right: auto; display: block"/></a>
	<!-- 회원가입 완료시 회원가입완료 창으로 이동 -->
	<div id="reg_info">
	<!-- signup.php로 정보 넘겨서 처리-->
	<form action="./signup.php" method="post">
	<!-- 회원가입 내역 칸 설정 -->
		<div class="font_noto"><label for="name">이름 :</label></div>
		<div class="font_noto"><input id="name" type="text" name="name"></div>
		<div class="font_noto"><label for="id">아이디 : </label></div>
		<div class="font_noto"><input id="id" type="text" name="id"></div>
		<div class="font_noto"><label for="pw1">비밀번호 : </label></div>
		<div class="font_noto"><input id="pw1" type="password" name="pw1"></div>
		<div class="font_noto"><label for="pw_2">비밀번호&nbsp;확인 :</label></div>
		<div class="font_noto"><input id="pw_2" type="password" name="pw_2"></div>
		<div class="font_noto"><label for="Email">이메일 주소: </label></div>
    <div class="font_noto"><input  id="Email" type="email"  name="Email"></div>
    <div class="font_noto">성별:
		<input id="gender" type="checkbox" checked="checked" name="gender" class="font_noto" value="남성">
		<label for="gender">남성</label>
    <input id="gender" type="checkbox" name="gender" class="font_noto" value="여성">
		<label for="gender">여성</label></div>
		<div><input type="submit" value="회원가입" class="font_noto" style="margin-right:20px;">
			<!--  로그인 페이지로 이동 -->
		<input type="button" name="return" value="돌아가기"  class="font_noto" onClick="location.href='login.php'"></div>
	</form>
	</div>
</body>
</html>
