<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Movie</title>

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
    
    <header>
      
      <div class="navbar navbar-dark bg-dark shadow-sm">
        <div>
          <button type="button" class="btn btn-outline-light me-2" onclick="location.href='index.php'">Top9Movie</button> 
          <button type="button" class="btn btn-outline-light me-2" style="background-color:  white; color: black;" onclick="location.href='movie.php'">Movie電影</button> 
          <button type="button" class="btn btn-outline-light me-2" onclick="location.href='like.php'">收藏</button>   
        </div>
        <div class="input-group-text">
          <input type="text" class="form-control"name="movieName" id="movieName" height="20" placeholder="search" aria-label="search"  >
          
         
          <span class="input-group-text"><button type="button" onclick="location.href='search.php'" require><img src="img/2.jpg" width="20" height="20"  class="button" ></button></span>
          <div class="invalid-feedback">
                Movie name is required.
            </div>
        </div>
      </div>
    </header>
    
<main>
  <div class="table-responsive">
    <table class="table table-striped table-sm" >
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Director</th>
          <th scope="col">Type</th>
          <th scope="col">Score</th>
        </tr>
      </thead>
      <tbody>
      
      <?php
      
      $conn=require_once("config.php");
      if($_SERVER["REQUEST_METHOD"]=="POST"){
  
        $movieName="";
          // 取得表單欄位值
          if ( isset($_POST["movieName"]) )
              $movieName = $_POST["movieName"];
          //檢查電影是否重複
          $check="SELECT * FROM movie WHERE movieName='".$movieName."'";
          if(mysqli_num_rows(mysqli_query($conn,$check))==0){
            $sql= "SELECT movie.movieId,movie.movieName,director.directorName,movie.type,comment.score FROM movie 
            NATURAL JOIN director 
            NATURAL JOIN comment 
            WHERE movieName='".$movieName."'"; 
            if($conn->multi_query($sql)===true){
                $result = mysqli_query($conn, $sql);
                while($row=mysqli_fetch_row($result)) {
                    echo "<tr>";
                    for($j=0; $j<mysqli_num_fields($result); $j++) {
                        echo "<td>$row[$j]</td>";
                    }
                    echo "</tr>";
                }
                //echo "更改成功!<br>";
                  //echo "<a href='index.php'>未成功跳轉頁面請點擊此</a>";
                  //header("refresh:1;url=editmovie.php");
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
              header("refresh:1;url=editmovie.php",true);
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
      </tbody>
    </table>
  </div>
 
</main>

<footer class="text-muted py-5">
  <div class="container">
    <p class="float-end mb-1">
      <a href="#">Back to top</a>
    </p>
  </div>
</footer>


   <script src="bootstrap.bundle.min.js"></script>

      
  </body>
</html>



        </html>