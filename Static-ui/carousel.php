<?php require_once("head-utils.php"); ?>
<?php require_once ("background.php");?>
<?php require_once ("login-navbar.php");?>
<?php require_once ("Ui-footer.php");?>

<!--Jumbotron-->
<section>
	<div id="home" class="col-lg-offset-4">
		<div class="container d-flex justify-content-center text-content-center">
			<div id="jumbotron" class="jumbotron p-3 mb-2 bg-transparent text-body text-align .bg-transparent">
				<div class="row">
					<h1 class="display-2">Web Dev Jobs</h1>
				</div>
			</div>
		</div>
	</div>
</section>

<!--Welcome Page Carousel-->
<body>
	<div class="bd-example">
		<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
			<ol class="carousel-indicators">
				<li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
				<li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
				<li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
			</ol>
			<div class="carousel-inner">
				<div class="carousel-item active">
					<img src="example-job-description-career-busters1.jpg" height="500" width="300" class="d-block w-100" alt="Example Job Description 1">
					<div class="carousel-caption d-none d-md-block">
						<h3 class="text-dark">Join Now for more details</h3>
					</div>
				</div>
				<div class="carousel-item">
					<img src="example-job-description-career-busters2.jpg" height="500" width="300" class="d-block w-100" alt="Example Job Description 2">
					<div class="carousel-caption d-none d-md-block">
						<h3 class="text-dark">Join Now for more details</h3>
					</div>
				</div>
				<div class="carousel-item">
					<img src="example-job-description-career-busters3.jpg" height="500" width="300" class="d-block w-100" alt="Example Job Description 3">
					<div class="carousel-caption d-none d-md-block">
						<h3 class="text-dark">Join Now for more details</h3>
					</div>
				</div>
			</div>
			<a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
	</div>
	<!--<div id="carousel" class="carousel slide" data-ride="carousel">
			<div class="carousel-inner border-primary">
				<div class="carousel-item active">
					<img src="example-job-description-career-busters1.jpg" height="500" width="400" class="d-block w-100"
						  alt="Example Job Description 1">
				</div>
				<div class="carousel-item">
					<img src="example-job-description-career-busters2.jpg" height="500" width="400"
						  class="d-block w-100" alt="Example Job Description 2">
				</div>
				<div class="carousel-item">
					<img src="example-job-description-career-busters3.jpg" height="500" width="400"
						  class="d-block w-100" alt="Example Job Description 3">
				</div>
			</div>
			<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
	</div>-->

		<!--CSS Break-->
		<section id="break"></section>

			<!--Welcome Page Text-->
		<br>
		<br>
		<br>
			<blockquote class="blockquote text-center">
				<p class="mb-0"><em>Welcome to Your Professional Web Dev Jobs Platform</em></p>
			</blockquote>
		<br>
		<br>
	<!--Welcome Page Text-->
	<blockquote class="blockquote text-center">
		<p class="mb-0"><em>If opportunity doesn't come knocking, build a website!</em></p>
		<footer class="blockquote-footer text-secondary">Unknown</footer>
	</blockquote>

	<!--Sign Up Button-->
	<div id="signup" class="container fluid justify-content-end">
		<div class="row justify-content-center">
	<button id="button" type="button" class="btn btn-primary btn-lgr">Sign Up</button>
	</div>
	</div>

</body>

