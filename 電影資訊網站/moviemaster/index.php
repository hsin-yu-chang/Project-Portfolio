<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.88.1">
  <title>Top 9</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/album/">


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

    button {
      border: none;
      margin: 0;
      padding: 0;
      outline: none;
    }
  </style>


</head>

<body>
  <?php
  session_start();  // 啟用交談期
  // 檢查Session變數是否存在, 表示是否已成功登入
  if ($_SESSION["login_session"] != true) {
    header("Location: login.php");
  }

  ?>
  <header>

    <div class="navbar navbar-dark bg-dark shadow-sm">
      <div>
        <button type="button" class="btn btn-outline-light me-2" style="background-color:  white; color: black;" onclick="location.href='index.php'">Top9Movie</button>
        <button type="button" class="btn btn-outline-light me-2" onclick="location.href='movie.php'">Movie電影</button>
        <button type="button" class="btn btn-outline-light me-2" onclick="location.href='like.php'">收藏</button>

      </div>
  

    </div>
  </header>


  <main>

    <section class="py-5 text-center container">
      <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
          <h1 class="fw-light">Top 9 Movie</h1>
          <p class="lead text-muted">本電影院電影熱門程度，最多人看的電影，你不能錯過的9部電影</p>
          <p>
            <?php
            // 檢查Session變數是否存在, 表示是否已成功登入
            if ($_SESSION["ismanager"] == true) {
              echo "<input type='button' class='btn btn-primary my-2' onclick=\"location.href='addmovie.php'\" value='新增'>";
              echo str_repeat('&nbsp;', 2);
              echo "<input type='button' class='btn btn-primary my-2' onclick=\"location.href='editmovie.php'\" value='修改'>";
              echo str_repeat('&nbsp;', 2);
              echo "<input type='button' class='btn btn-primary my-2' onclick=\"location.href='deletemovie.php'\" value='刪除'>";
            }

            ?>

          </p>
        </div>
      </div>
    </section>

    <div class="album py-5 bg-light">
      <div class="container">

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
          <?php
          // ----------------------------- top 9 movies ----------------------------- //
          $conn = require_once("config.php");
          $sql_string = "SELECT movieName,description,CAST(AVG(comment.score) AS decimal(10,1)),movie.movieId FROM movie
          JOIN comment ON movie.movieId = comment.movieId
            GROUP BY movie.movieId
            ORDER BY comment.score LIMIT 9 ;";
          //$result = mysqli_query($select_db, $sql_string);
          $result = mysqli_query($conn, $sql_string);
          $order = 1;
          while ($row = mysqli_fetch_row($result)) {
            echo '<a style="color:black; text-decoration:none;" href="information.php?id=' . $row[3] . '">';
            echo "<div class=\"col\">";
            echo "<div class=\"card shadow-sm\">";
            echo "<svg class=\"bd-placeholder-img card-img-top\" width=\"100%\" height=\"225\" xmlns=\"http://www.w3.org/2000/svg\" role=\"img\" aria-label=\"Placeholder: Thumbnail\" preserveAspectRatio=\"xMidYMid slice\" focusable=\"false\">";
            echo "<title>Placeholder</title>";
            echo "<rect width=\"100%\" height=\"100%\" fill=\"#55595c\" /><text x=\"50%\" y=\"50%\" fill=\"#eceeef\" dy=\".3em\">第 " . $order . " 名</text>";
            echo "</svg>";
            echo "<div class=\"card-body\">";
            echo "<h5 class=\"card-title\">" . $row[0] . "</h5>";
            echo "<p class=\"card-text\">" . $row[1] . "</p>";
            echo "<div class=\"d-flex justify-content-between align-items-center\">";
            echo "<div class=\"btn-group\">";
            // if ($_SESSION["ismamager"]) {
            //   echo "<button type=\"submit\" class=\"btn btn-sm btn-outline-secondary\">View</button>";
            //   echo "<button type=\"submit\" class=\"btn btn-sm btn-outline-secondary\">Edit</button>";
            // } else {
            //   echo "<button type=\"button\" class=\"btn btn-sm btn-outline-secondary\">like</button>";
            //   echo "<button type=\"button\" class=\"btn btn-sm btn-outline-secondary\">comment</button>";
            // }
            echo "</div>";
            echo "<small class=\"text-muted\">" . $row[2] . " 分</small>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</a>";
            $order++;
          }
          ?>


        </div>
      </div>
    </div>

  </main>

  <footer class="text-muted py-5">
    <div class="container">
      <p class="float-end mb-1">
        <a href="#">Back to top</a>
        <br>
        <a href="logout.php">Logout</a>
      </p>
    </div>
  </footer>


  <script src="js/bootstrap.bundle.min.js"></script>

</body>

</html>