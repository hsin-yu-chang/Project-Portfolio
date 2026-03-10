<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Edit Movie</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/checkout/">

    

    <!-- Bootstrap core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<script type="text/javascript"></script>
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
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="css/form-validation.css" rel="stylesheet">
  </head>
  <body class="bg-light">
    
<div class="container">
  <?php
   $conn=require_once("config.php");
   if($_SERVER["REQUEST_METHOD"]=="POST"){

     $movieName="";$directorName = "";  $actorName = "";$showLocationTime = "";  $type = ""; $description = "";
       // 取得表單欄位值
       if ( isset($_POST["movieName"]) )
           $movieName = $_POST["movieName"];
       if ( isset($_POST["directorName"]) )
           $directorName = $_POST["directorName"];
       if ( isset($_POST["actorName"]) )
           $actorName = $_POST["actorName"];
       if ( isset($_POST["showLocationTime"]) )
           $showLocationTime = $_POST["showLocationTime"];
       if ( isset($_POST["type"]) )
           $type = $_POST["type"];
       if ( isset($_POST["description"]) )
           $description = $_POST["description"];
       //檢查電影是否重複
       $check="SELECT * FROM movie WHERE movieName='".$movieName."'";
       if(mysqli_num_rows(mysqli_query($conn,$check))!=0){
           $sql="UPDATE movie SET description='".$description."',type='".$type."',showLocationTime='".$showLocationTime."' WHERE movieName ='".$movieName."';";
           $sql.="UPDATE actor SET actorName='".$actorName."' WHERE movieId = (SELECT movieId FROM movie WHERE movie.movieName='".$movieName."');";
           $sql.="UPDATE director SET directorName='".$directorName."' WHERE movieId = (SELECT movieId FROM movie WHERE movie.movieName='".$movieName."');";
          
           if($conn->multi_query($sql)===true){
              
             echo "更改成功!<br>";
               //echo "<a href='index.php'>未成功跳轉頁面請點擊此</a>";
               header("refresh:1;url=editmovie.php");
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
  <main>
    <div class="py-5 text-center">
      
    </div>

    <div class="row g-5" >
      <div class="col-md-3">
        <img class="d-block mx-auto mb-4"  src="img/1.jpg" alt="" width="180" height="150">
      </div>
      <div class="col-md-7 col-lg-8">
        <h4 class="mb-3">修改電影資訊</h4>
        <form class="needs-validation" action="editmovie.php" method="post">
          
            <div class="col-12">
              <label for="firstName" class="form-label">Movie name</label>
              <input type="text" class="form-control" name="movieName" id="movieName" placeholder="" value="" required>
              <div class="invalid-feedback">
                Movie name is required.
            </div>
            </div>

            
            
            

            <div class="col-12">
              <label for="director" class="form-label">Director</label>
              <div class="input-group has-validation">
               
                <input type="text" class="form-control" name="directorName" id="directorName" placeholder="" required>
              <div class="invalid-feedback">
                Actor is required.
                </div>
              </div>
            </div>
            
            <div class="col-12">
              <label for="actor" class="form-label">Actor</label>
              <input type="text" class="form-control" name="actorName" id="actorName" placeholder="" value="" required>
              <div class="invalid-feedback">
                Movie name is required.
            </div>

            <div class="col-12">
              <label for="showLocationTime" class="form-label">Show location time</label>
              <input type="date" class="form-control" name="showLocationTime" id="showLocationTime" placeholder="" value="" required>
              <div class="invalid-feedback">
                Show location time  is required.
            </div>


            

            <div class="col-md-5">
              <label for="type" class="form-label">Type</label>
              <select type="text" class="form-select" name="type" id="type" required>
                <option value="">Choose...</option>
                <option>動作</option>
                <option>戲劇</option>
                <option>喜劇</option>
                <option>戀愛</option>
                <option>驚悚</option>
                <option>懸疑</option>
              </select>
              <div class="invalid-feedback">
                Please select a valid type.
              </div>
            </div>
            <!--
            <label for="country" class="form-label">Picture</label>
            <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
            
              <input id="upload" type="file" onchange="readURL(this);" class="form-control border-0">
              <label id="upload-label" for="upload" class="font-weight-light text-muted">Choose file</label>
              <div class="input-group-append">
                  <label for="upload" class="btn btn-light m-0 rounded-pill px-4"> <i class="fa fa-cloud-upload mr-2 text-muted"></i><small class="text-uppercase font-weight-bold text-muted">Choose file</small></label>
              </div>
          </div>-->
          
            <div class="col-12">
              <label for="description" class="form-label">Description</label>
              <textarea class="form-control" cols="50" rows="5" name="description" id="discription" placeholder="" value="" required></textarea>
              <div class="invalid-feedback">
                Discription is required.
            </div>
            

            

          <hr class="my-4"> 
          <input type="submit" class="w-100 btn btn-lg btn-primary" value="Edit Movie"/>
          
        </form>
      </div>
    </div>
  </main>

  <footer class="text-muted py-5">
  <div class="container">
    <p class="float-end mb-1">
    <a href="index.php">回首頁</a>
    </p>
  </div>

</div>


    <script src="js/bootstrap.bundle.min.js"></script>

      <script src="js/form-validation.js"></script>
  </body>
</html>
