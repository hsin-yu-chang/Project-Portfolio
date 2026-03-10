<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.88.1">
  <title>Login</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">



  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <script type="text/javascript" src="js/loginjs.js"></script>
  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>


  <!-- Custom styles for this template -->
  <link href="css/signin.css" rel="stylesheet">
</head>

<body class="text-center">
  <?php
  session_start();  // 啟用交談期
  $name = "";
  $password = "";
  // 取得表單欄位值
  if (isset($_POST["ID"]))
    $name = $_POST["ID"];
  if (isset($_POST["password"]))
    $password = $_POST["password"];
  // 檢查是否輸入使用者名稱和密碼
  if ($name != "" && $password != "") {
    // 建立MySQL的資料庫連接 
    $link = require_once("config.php");
    //送出UTF8編碼的MySQL指令
    mysqli_query($link, 'SET NAMES utf8');

    $sql = "SELECT * FROM manager WHERE password='";
    $sql .= $password . "' AND managerName='" . $name . "'";
    $result = mysqli_query($link, $sql);
    $total_records = mysqli_num_rows($result);
    if ($total_records > 0) {
      // 成功登入, 指定Session變數
      $_SESSION["ismanager"] = true;
      $_SESSION["login_session"] = true;
      header("Location: index.php");
    } else {
      $_SESSION["ismanager"] = false;
      // 建立SQL指令字串
      $sql = "SELECT * FROM member WHERE password='";
      $sql .= $password . "' AND memberName='" . $name . "'";

      // 執行SQL查詢
      $result = mysqli_query($link, $sql);
      $total_records = mysqli_num_rows($result);
      // 是否有查詢到使用者記錄
      if ($total_records > 0) {
        // 成功登入, 指定Session變數
        $sql = "SELECT * FROM member WHERE memberName='" . $name . "'";
        $result = mysqli_query($link, $sql);
        $member = mysqli_fetch_row($result);
        $_SESSION["login_session"] = true;
        $_SESSION["memberId"] = $member[0];
        $_SESSION["memberName"] = $member[1];
        header("Location: index.php");
      } else {  // 登入失敗
        $message = "使用者名稱或密碼錯誤!";
        echo "<script type='text/javascript'>alert('$message');</script>";
        $_SESSION["login_session"] = false;
      }
    }


    mysqli_close($link);  // 關閉資料庫連接  
  }
  ?>

  <main class="form-signin">
    <form action="login.php" method="post">
      <img class="mb-4" src="img/1.jpg" alt="" width="150" height="120">
      <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

      <div class="form-floating">
        <input type="text" class="form-control" name="ID" id="ID" required autofocus />
        <label for="ID" style="color:gray;">Username</label>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" name="password" id="password" required />
        <label for="password" style="color:gray;">Password</label>
      </div>
      <input type="submit" class="w-100 btn btn-lg btn-primary" value="Sign in" />


      <a href="register.php">Register</a>
      <p class="mt-5 mb-3 text-muted">&copy; 2021–2022</p>
    </form>
  </main>

</body>

</html>