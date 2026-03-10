<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Register</title>

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
    $conn=require_once("config.php");

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $username = "";  $password = "";
        // 取得表單欄位值
        if ( isset($_POST["ID"]) )
            $username = $_POST["ID"];
        if ( isset($_POST["password"]) )
            $password = $_POST["password"];
        //檢查帳號是否重複
        $check="SELECT * FROM member WHERE memberName='".$username."'";
        if(mysqli_num_rows(mysqli_query($conn,$check))==0){
            $sql="INSERT INTO member (memberID,memberName, password) 
                VALUES('','".$username."','".$password."')";
            
            if(mysqli_query($conn, $sql)){
                echo "註冊成功!3秒後將自動跳轉頁面<br>";
                echo "<a href='index.php'>未成功跳轉頁面請點擊此</a>";
                header("refresh:1;url=login.php");
                exit;
            }else{
                echo "Error creating table: " . mysqli_error($conn);
            }
        }
        else{
            echo $_POST["ID"];
            echo $_POST["password"];
            echo "該帳號已有人使用!<br>3秒後將自動跳轉頁面<br>";
            echo "<a href='register.html'>未成功跳轉頁面請點擊此</a>";
            header('HTTP/1.0 302 Found');
            header("refresh:1;url=register.php",true);
            exit;
        }
    }


    mysqli_close($conn);

    function function_alert($message) { 
        
        // Display the alert box  
        echo "<script>alert('$message');
        window.location.href='index.php';
        </script>"; 
        
        return false;
    } 
  ?>
    
<main class="form-signin">
  <form action="register.php" method="post">
    <img class="mb-4" src="img/1.jpg" alt="" width="150" height="120">
    

    <div class="form-floating">
      <input type="text" class="form-control"  name="ID" id="ID" >
      <label for="ID" style="color:gray;">please input your Username</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control"  name="password" id="password" >
      <label for="password" style="color:gray;">please input your Password</label>
    </div>
    <div class="form-floating">
        <input type="password" class="form-control" name="password2" id="password2" >
        <label for="password" style="color:gray;">please confirm your Password</label>
      </div>

      <input type="submit" class="w-100 btn btn-lg btn-primary" value="Register"/>
    <a href="login.php">sign in</a>
    <p class="mt-5 mb-3 text-muted">&copy; 2021–2022</p>
  </form>
</main>


    
  </body>
</html>

