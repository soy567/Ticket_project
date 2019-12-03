<html>
  <head>

  <!-- 구글 정식 글꼴타입 하이퍼링크로 따옴-->
  <link href="https://fonts.googleapis.com/css?family=Bangers|Black+Han+Sans|Jua|Staatliches&display=swap" rel="stylesheet">
  <style type="text/css">

 		  .font_big { font-size: 2em; }
       .font_normal {font-size: 1.5em;}
       .font_color {color: white;}
       .font_bold { font-weight: bold; }
       .font_center { text-align: center; }
       .font_jua {font-family: 'Jua';}
       .font_han {font-family: 'Black Han Sans';}

       p#round_font {font-size : 300%;  font-weight: bold ; font-family: 'Bangers', cursive;}
    </style>

  <script language="JavaScript">
    function move_page() {
    opener.document.location.href='main_page.php';
    window.close();
  }
  </script>
<body>
  <?php
    session_start();
    $id = $_POST['id'];
    $pw = $_POST['pw'];
    $conn = mysqli_connect('localhost', 'root', 'phpbeta', 'project_test');

    if (!$conn) {
        die("연결 실패: " . mysqli_connect_error());
    }

   $check = "SELECT * FROM user WHERE user_id='$id'";
   $result = $conn->query($check);
   /*
    if($id == NULL || $pw == NULL){
    echo "아이디나 패스워드가 입력되지 않았습니다.</br>";
  } */
  if ($result->num_rows == 1) {
      $row = $result->fetch_array(MYSQLI_ASSOC); //하나의 열을 배열로 가져오기
  if ($row['user_pw'] == $pw) { //MYSQLI_ASSOC 필드명으로 첨자 가능
      $_SESSION['user_id'] = $id; //로그인 성공시 세션 변수 만들기
      if (isset($_SESSION['user_id'])) { // 세션 변수가 정의되어 있을때
        echo("<script language='javascript'>move_page();</script>"); //로그인 성공시 메인 페이지로 이동
      } else {
          echo "세션 저장 실패";
      }
  } else {
      echo "아이디나 패스워드가 틀렸습니다.";
  }
  } else {
      echo "아이디나 패스워드가 틀렸습니다.";
  }
  ?>
  <input type='button'  value='뒤로가기' class='font_big font_jua'  style='background-color:white; margin-left:auto; margin-right:auto;display:block;margin-top:22%;margin-bottom:0%' onclick= "location.href='login.php'" >
  </body>
</html>
