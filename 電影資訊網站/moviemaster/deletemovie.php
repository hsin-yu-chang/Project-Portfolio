<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Delete Movie</title>

   <!-- <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/album/"> -->

    

    <!-- Bootstrap core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="loginjs.js"></script>
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
      button{
        border: none;
        margin: 0;
        padding:0;
      }
    </style>

    
  </head>
  <body>
    
    <!--<header>
      
      <div class="navbar navbar-dark bg-dark shadow-sm">
        <div>
          <button type="button" class="btn btn-outline-light me-2" onclick="location.href='index.php'">Top9Movie</button> 
          <button type="button" class="btn btn-outline-light me-2" style="background-color:  white; color: black;" onclick="location.href='movie.php'">Movie電影</button> 
          <button type="button" class="btn btn-outline-light me-2" onclick="location.href='like.php'">收藏</button>   
        </div>
        <div class="input-group-text">
          <input type="text" class="form-control" height="20"; placeholder="search" aria-label="search" >
          <span class="input-group-text"><button type="button" onclick="search();"><img src="img/2.jpg" width="20" height="20"  class="button" ></button></span>
        </div>
      </div>
    </header>-->
    
<main>
  <div class="table-responsive">
    
      
      <?php
      $conn=require_once("config.php");
      if($_SERVER["REQUEST_METHOD"]=="POST"){
  
        $movieName="";$directorName = "";  $actorName = "";$showLocationTime = "";  $type = ""; $description = "";
          // 取得表單欄位值
          if ( isset($_POST["movieName"]) )
              $movieName = $_POST["movieName"];
          
          //檢查電影是否重複
          $check="SELECT * FROM movie WHERE movieName='".$movieName."'";
          if(mysqli_num_rows(mysqli_query($conn,$check))!=0){
              $sql="DELETE FROM director WHERE movieId = (SELECT movieId FROM movie WHERE movie.movieName='".$movieName."');";
              $sql.="DELETE FROM actor WHERE movieId = (SELECT movieId FROM movie WHERE movie.movieName='".$movieName."');";
              $sql.="DELETE FROM movie WHERE movieName ='".$movieName."'";
              if($conn->multi_query($sql)===true){
                echo "刪除成功!<br>";
                  //echo "<a href='index.php'>未成功跳轉頁面請點擊此</a>";
                  header("refresh:1;url=deletemovie.php");
                  exit;
              }else{
                  echo "Error creating table: " . mysqli_error($conn);
              }
          }
          else{
            
              //echo $_POST["movieName"];
              
              echo "該電影不存在!<br>";
              //echo "<a href='register.html'>未成功跳轉頁面請點擊此</a>";
              //header('HTTP/1.0 302 Found');
              header("refresh:1;url=deletemovie.php",true);
              exit;
          }
      }
  
  
      mysqli_close($conn);
  
      function function_alert($message) { 
          
           //Display the alert box  
          echo "<script>alert('$message');
          window.location.href='index.php';
          </script>";    
          return false;
      }
        ?>
      
    
  </div>
  <form class="needs-validation" action="deletemovie.php" method="post">
  <div class="col-md-3">
              <label for="movieName" class="form-label">Movie name</label>
              <input type="text" class="form-control" name="movieName" id="movieName" placeholder="" value="" required>
              <input type="submit" class="w-100 btn btn-lg btn-primary" value="Delete Movie"/>
  </div>
  </form>
   
</main>

<footer class="text-muted py-5">
  <div class="container">
    <p class="float-end mb-1">
    <a href="index.php">回首頁</a>
    </p>
  </div>



   <script src="bootstrap.bundle.min.js"></script>

      
  </body>
</html>
