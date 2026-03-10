<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>

<head>
	<title>Cinema A Entertainment Category Flat Bootstarp Resposive Website Template | Home :: w3layouts</title>
	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
	<!-- Custom Theme files -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<!-- Custom Theme files -->
	<script src="js/jquery.min.js"></script>
	<!-- Custom Theme files -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Cinema Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
	<script type="application/x-javascript">
		addEventListener("load", function() {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!--webfont-->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

</head>

<body>
	<!-- header-section-starts -->
	<?php
	$select_db = require_once("config.php");
	session_start();
	$_SESSION['movieId'] = $_GET["id"];
	//echo "movieId='".$_SESSION['movieId']."'";
	if (isset($_POST['showComment'])) {
		$movieId   = $_SESSION['movieId'];
		header("Location: comment.php");
	} else if (isset($_POST['like'])) {
		if ($_SESSION["ismanager"] != true) {
			$movieId   = $_SESSION['movieId'];
			$check = "SELECT movieId,memberId FROM memberlikelist WHERE movieId='" . $movieId . "' AND memberId = '" . $_SESSION['memberId'] . "';";
			if (mysqli_num_rows(mysqli_query($select_db, $check)) == 0) {
				$sql_string = "INSERT INTO memberlikelist (movieId,memberId) VALUES ('" . $movieId . "','" . $_SESSION['memberId'] . "');";
				mysqli_query($select_db, $sql_string);
				echo "<script>alert('已加入收藏!');</script>";
			} else {
				echo "<script>alert('此電影已在收藏清單!');</script>";
			}
		} else {
			echo "<script>alert('您無權使用此功能!');</script>";
		}
	}
	?>
	<div class="full">
		<div class="menu">
			<ul>
				<li><button type="button" class="btn btn-outline-light me-2" onclick="location.href='index.php'">Top9Movie</button></li>
				<br>
				<li><button type="button" class="btn btn-outline-light me-2" onclick="location.href='movie.php'">Movie電影</button></li>
				<br>
				<li><button type="button" class="btn btn-outline-light me-2" onclick="location.href='like.php'">收藏</button></li>
			</ul>
		</div>

		<div class="main">
			<div class="header">
				<div class="top-header">
					<div class="logo">
						<a href="index.html"><img src="images/logo.png" alt="" /></a>
						<p>Movie Theater</p>
					</div>
					<div class="search">
						<form>
							<input type="text" value="Search.." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search..';}" />
							<input type="submit" value="">
						</form>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="header-info">
					<?php
					//$movieId = $_GET["id"]; 
					$movieId = $_SESSION['movieId'];
					//echo "movieId=$movieId";
					$sql = "SELECT movie.movieId,movie.movieName,movie.description,director.directorName,movie.type,movie.showLocationTime,actor.actorName FROM movie 
							NATURAL JOIN director
							NATURAL JOIN actor 
							WHERE movieId='" . $movieId . "'";
					$result = mysqli_query($select_db, $sql);
					$countRow = 0;
					$movieId = "";
					$movieName = "";
					$directorName = "";
					$actorName = "";
					$type = "";
					$description = "";
					$showLocationTime = "";
					while ($row = mysqli_fetch_array($result)) {
						if ($countRow == 0) {
							$movieId = $row['movieId'];
							$movieName = $row['movieName'];
							$directorName = $row['directorName'];
							$actorName = $row['actorName'];
							$type = $row['type'];
							$description = $row['description'];
							$showLocationTime = $row['showLocationTime'];
						} else {
							$actorName = $actorName . ',' . $row['actorName'];
						}
						$countRow++;
						//echo "";
					}
					echo "<h1 >$movieName</h1>";
					echo "<p class='age'>Director	$directorName</p>";
					echo "<p class='age'>Actor	$actorName</p>";
					//echo "<p class='review'>Score	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;  $score</p>";
					echo "<p class='review reviewgo'>Genre	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp; $type</p>";
					echo "<p class='review'>Show Location time &nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp; $showLocationTime</p>";
					echo "<p class='special'>$description</p>";

					?>

					<form action="information.php?id=<?= $_SESSION['movieId'] ?>" method="post">
						<input type="submit" class="btn btn-outline-light me-2" name="like" value="like" />
						<input type="submit" class="btn btn-outline-light me-2" value="showComment" name="showComment" />
					</form>
				</div>
			</div>


			<!-- <div class="news">
				<div class="col-md-6 news-left-grid">
					<h3>Don’t be late,</h3>
					<h2>Book your ticket now!</h2>
					<h4>Easy, simple & fast.</h4>
					<a href="#"><i class="book"></i>BOOK TICKET</a>
					<p>Get Discount up to <strong>10%</strong> if you are a member!</p>
				</div>
				<div class="col-md-6 news-right-grid">
					<h3>News</h3>
					<div class="news-grid">
						<h5>Lorem Ipsum Dolor Sit Amet</h5>
						<label>Nov 11 2014</label>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo.</p>
					</div>
					<div class="news-grid">
						<h5>Lorem Ipsum Dolor Sit Amet</h5>
						<label>Nov 11 2014</label>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo.</p>
					</div>
					<a class="more" href="#">MORE</a>
				</div>
				<div class="clearfix"></div>
			</div> -->
			<!-- <div class="more-reviews">
				<ul id="flexiselDemo2">
					<li><img src="images/m1.jpg" alt="" /></li>
					<li><img src="images/m2.jpg" alt="" /></li>
					<li><img src="images/m3.jpg" alt="" /></li>
					<li><img src="images/m4.jpg" alt="" /></li>
				</ul>
				<script type="text/javascript">
					$(window).load(function() {

						$("#flexiselDemo2").flexisel({
							visibleItems: 4,
							animationSpeed: 1000,
							autoPlay: true,
							autoPlaySpeed: 3000,
							pauseOnHover: false,
							enableResponsiveBreakpoints: true,
							responsiveBreakpoints: {
								portrait: {
									changePoint: 480,
									visibleItems: 2
								},
								landscape: {
									changePoint: 640,
									visibleItems: 3
								},
								tablet: {
									changePoint: 768,
									visibleItems: 3
								}
							}
						});
					});
				</script>
				<script type="text/javascript" src="js/jquery.flexisel.js"></script>
			</div> -->

		</div>
	</div>

	<div class="clearfix"></div>

</body>

</html>