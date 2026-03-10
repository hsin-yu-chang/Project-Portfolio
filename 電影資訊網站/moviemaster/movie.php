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
          <form method="post">
            <input type="text" class="form-control" height="20"; placeholder="search" aria-label="search" name="keyword"><span class="input-group-text"><button type="submit"><img src="img/2.png" width="20" height="20"  class="button" ></button></span>
            
          </form>
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
          <!--<th scope="col">Information</th>-->
        </tr>
      </thead>
      <tbody>
      
      <?php
        session_start();
        $select_db = require_once("config.php");
        
        
        
        if (isset($_POST['movieId'])){
            session_start();
            $movieId = get_post($select_db, 'movieId');
            updateSession($movieId);
            header("Location: information.php");
        }
        if (isset($_POST['keyword'])){
          //輸入查詢關鍵字
          $keyword   = get_post($select_db, 'keyword');
          $sql_query = "SELECT movie.movieId,movie.movieName,director.directorName,movie.type,CAST(AVG(comment.score) AS decimal(10,1)) FROM movie
                      LEFT OUTER JOIN comment ON movie.movieId = comment.movieId
                      JOIN director ON movie.movieId = director.movieId
                      WHERE movie.movieName LIKE '%$keyword%'
                      GROUP BY movie.movieId;";

          $result = mysqli_query($select_db, $sql_query);
          show_result($result);
        }
        else{
          //沒有關鍵字則顯示全部電影
          $sql_query = "SELECT movie.movieId,movie.movieName,director.directorName,movie.type,CAST(AVG(comment.score) AS decimal(10,1)) FROM movie
                      LEFT OUTER JOIN comment ON movie.movieId = comment.movieId
                      JOIN director ON movie.movieId = director.movieId
                      GROUP BY movie.movieId;";

          $result = mysqli_query($select_db, $sql_query);
          show_result($result);
        }


        mysqli_close($select_db);
        function updateSession($movieId){
          $_SESSION["movieId"] = $movieId;
      }
      function get_post($conn, $var)
      {
          return $conn->real_escape_string($_POST[$var]);
      }
      function show_result($result){
        //顯示電影資訊
        while($row=mysqli_fetch_array($result)) {
          $movieId=$row['movieId'];
          $movieName=$row['movieName'];
          //$_SESSION['movieId']=$movieId;
          $directorName=$row['directorName'];
          $type=$row['type'];
          $score=$row[4];
          if($score=="") $score = "無";
          echo "<tr>";
          
              echo "<td>$movieId</td>";
              echo '<td><a style="color:black; text-decoration:none;" href="information.php?id='.$movieId.'" >'.$movieName.'</a></td>';
              echo "<td>$directorName</td>";
              echo "<td> $type</td>";
              echo "<td>$score</td>";
          
          //echo "<form method='post'><input type='hidden' name='movieId' value=$row[4]>";
          //echo "<td><button type='submit' value='Info'>Info</button></td></form>";
          echo "</tr>";
        }

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
