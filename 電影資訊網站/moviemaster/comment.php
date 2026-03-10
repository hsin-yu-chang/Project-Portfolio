<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex">
  <title>Comment</title>

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

    button {
      border: none;
      margin: 0;
      padding: 0;
    }

    .hiddenBtn {
      display: none;
    }

    td {
      vertical-align: middle;
    }

    .avatorimg {
      width: 50px;
      height: 50px;
    }

    .BOX {
      position: absolute;
      left: 50%;
      top: 50%;
      margin-left: -350px
    }

    .avator {
      left: 50%;
      top: 50%;
      align: center;
      text-align: center;
      vertical-align: middle;
    }
  </style>


</head>

<body>
  <header>
    <div class="navbar navbar-dark bg-dark shadow-sm">
      <div>
        <button type="button" class="btn btn-outline-light me-2" onclick="location.href='index.php'">Top9Movie</button>
        <button type="button" class="btn btn-outline-light me-2" onclick="location.href='movie.php'">Movie電影</button>
        <button type="button" class="btn btn-outline-light me-2" onclick="location.href='like.php'">收藏</button>
      </div>
    </div>
  </header>
  <main>
    <section class="py-5 text-center container">
      <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
          <h1 class="fw-light">留言板</h1>
          <p class="lead text-muted">留下你對電影的感想吧</p>
        </div>
      </div>
    </section>


    <div class="BOX">
      <!-- class="table-responsive" -->
      <table text-align="center" width="700px">
        <!-- class="table table-striped table-sm"  -->
        <thead>
          <tr>
            <th scope="col">Name</th>
            <th scope="col">ID與評論</th>
            <th scope="col">評分</th>
          </tr>
        </thead>
        <tbody>
          <?php
          session_start();  // 啟用交談期
          $memberId = "";
          $memberName = "";
          if ($_SESSION["ismanager"] != true) {
            $memberId = $_SESSION["memberId"];
            $memberName = $_SESSION["memberName"];
          }
          $select_db = require_once("config.php");
          $movieId = $_SESSION["movieId"];
          $hadComment = false;
          $hiddenDelete = true;
          //顯示該電影所有評論
          $sql_query = "SELECT memberId,memberName,comment,score FROM comment WHERE movieId = '" . $movieId . "'";
          $result = mysqli_query($select_db, $sql_query);
          while ($row = mysqli_fetch_row($result)) {
            if ($row[0] == $memberId) {
              //若是自己的留言則底部為深藍色
              echo "<tr style='background-color:#bcd4e6'>";
              //儲存自己的留言
              $myComment = $row;
              $hadComment = true;
              $hiddenDelete = false;
            } else {
              echo "<tr style='background-color:#d6e2e9'>";
            }
            //顯示個圖片 下面放memberName
            echo "<td width='60px' align='center'><img class='avatorimg' src='img/head.png' alt=''>";
            echo "$row[1]</td>";

            for ($j = 0; $j < mysqli_num_fields($result); $j++) {
              if ($j == 0) {
                //顯示 memberId : comment
                echo "<td align='left'>$row[0]: $row[2]</font></td>";
              } else if ($j != 1 && $j != 2) {
                //memberName comment顯示過了
                echo "<td width='50px' ><font size='10'>$row[$j]</font></td>";
              }
            }
            echo "</tr>";
          }
          echo "</tbody></table>";

          //新增 修改Comment
          if (isset($_POST['comment']) && isset($_POST['score']) && !isset($_POST['delete'])) {
            if ($_SESSION["ismanager"] != true) {
              $comment   = get_post($select_db, 'comment');
              $score     = get_post($select_db, 'score');

              if (!$hadComment) {
                //新增
                $sql_query  = "INSERT INTO comment VALUES" .
                  "('$memberId', '$movieId', '$memberName', '$comment', '$score')";
                $result = mysqli_query($select_db, $sql_query);
                if (!$result) {
                  echo "再輸入一次<br><br>";
                  $hadComment = false;
                } else {
                  $hadComment = true;
                  header("Location:comment.php");
                }
              } else {
                //修改
                $sql_query = "UPDATE comment SET comment='$comment', score='$score' WHERE memberId='$memberId' AND movieId='$movieId'";
                $result = mysqli_query($select_db, $sql_query);

                if (!$result) {
                  echo "再輸入一次<br><br>";
                } else {
                  header("Location:comment.php");
                }
              }
            } else {
              echo "<script>alert('您無權使用此功能!');</script>";
            }
          }
          if (isset($_POST['comment']) && isset($_POST['score']) && isset($_POST['delete'])) {
            //刪除
            $sql_query  = "DELETE FROM comment WHERE memberId='$memberId' AND movieId='$movieId'";
            $result = mysqli_query($select_db, $sql_query);

            if (!$result) {
              echo "刪除失敗<br><br>";
            } else {
              header("Location:comment.php");
            }
          }

          //如果沒留言過則顯示空白的form
          //若留言過則form顯示之前的留言
          if ($hadComment) {
            $myOldComment = $myComment[2];
            $myOldScore = $myComment[3];
            $hiddenDelete = false;
            $btnText = "修改";
          } else {
            $myOldComment = "";
            $myOldScore = "";
            $hiddenDelete = true;
            $btnText = "新增";
          }
          if ($_SESSION["ismanager"] != true) {
            echo <<<_END
              <br>
              <form action="comment.php" method="post" width='700px'><pre>
              <label class="form-label">留言</label><input type="text" class="form-control" name="comment" value = $myOldComment>
              <label class="form-label">評分</label><input type="int" class="form-control" name="score" value= $myOldScore>
              <input class='btn btn-primary my-2' type="submit" value= $btnText>
              _END;
          }

          if (!$hiddenDelete) {
            //顯示刪除按鈕
            echo "   <input type='submit' class='btn btn-primary my-2' name='delete' value='刪除'>";
          }

          echo  "</form>";

          mysqli_close($select_db);
          function get_post($conn, $var)
          {
            return $conn->real_escape_string($_POST[$var]);
          }
          echo "<br><br><a href='information.php?id=$movieId'>回上一頁</a>"
          ?>


    </div>

  </main>
  <script src="bootstrap.bundle.min.js"></script>


</body>

</html>