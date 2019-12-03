<?php
  if(isset($_SESSION['userid'])){
    echo "<script>alert('잘못된 접근입니다.'); history.back();</script>";
  }
  else{
  }
?>

<html>
  <head>
    <style>
      * {margin: 0 auto;}
      a {color:#333; text-decoration: none;}
      .find {text-align:center; width:500px; margin-top:30px; }
    </style>
  </head>

  <body>
    <div class="find">
    <form method="post" action="member_find_id.php">
      <h1>회원계정 찾기</h1>

        <fieldset>
          <legend>아이디 찾기</legend>

            <table>
              <tr>
                <td>이름</td>
                <td><input type="text" size="35" name="name" placeholder="이름"></td>
              </tr>
              <tr>
                <td>이메일</td>
                <td><input type="text" name="email">@<select name="emadress"><option value="naver.com">naver.com</option><option value="nate.com">nate.com</option>
                <option value="hanmail.com">hanmail.com</option><option value="gmail.com">gmail.com</option></select></td>
              </tr>
            </table>

          <input type="submit" value="아이디 찾기" />
        </fieldset>
    </form>
    </div>

    <div class="find">
      <form method="post" action="member_find_pw.php">
        <fieldset>
          <legend>비밀번호 찾기</legend>
            <table>
              <tr>
                <td>아이디</td>
                <td><input type="text" size="35" name="userid" placeholder="아이디"></td>
              </tr>
            </table>
          <input type="submit" value="비밀번호 찾기" />
        </fieldset>
      </form>
      <input type="submit" value="뒤로가기"  onClick = "location.href= 'login.php'" />
    </div>
  
  </body>
</html>
