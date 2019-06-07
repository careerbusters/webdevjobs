<?php require_once("head-utils.php"); ?>
<?php require_once("Ui-footer.php"); ?>
<?php require_once ("background.php");?>
<?php require_once ("login-navbar.php");?>

<!--Jumbotron-->
<body>
	<section>
		<div id="home" class="col-lg-offset-4">
			<div class="container py-2 d-flex justify-content-center text-content-center">
				<div id="jumbotron" class="jumbotron p-3 mb-2 bg-transparent text-body text-align .bg-transparent">
					<div class="row">
						<h1 class="display-2">Web Dev Jobs Login</h1>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!--Image Card-->

		<div id="card" class="container justify-content-center">
			<div class="card w-30">
				<img class="img mx-auto d-block my-3 rounded-circle" src="login-pic.jpg" width="300" height="400" class="card-img-top"
					  alt="Jane Hill">
				<div class="card-body">
					<p class="card-text text-center">Jane Hill</p>

					<!--Login Form-->

					<form>
						<div class="form-group">
							<label for="exampleInputEmail1">Email address</label>
							<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
									 placeholder="Enter email">
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Password</label>
							<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
						</div>
						<div class="form-group form-check">
							<input type="checkbox" class="form-check-input" id="exampleCheck1">
							<label class="form-check-label" for="exampleCheck1">Remember Me</label>
						</div>
						<button type="submit" class="btn btn-primary btn-lg btn-block">Login</button>
				</div>
			</div>
			</form>
		</div>

</body>
