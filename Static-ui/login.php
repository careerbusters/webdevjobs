<!DOCTYPE html>
<html lang="en">

	<!--Login Form & Jumbotron-->
	<body>
		<section>
			<div id="home" class="col-lg-offset-4">
				<div class="container py-2 d-flex justify-content-center">
					<div id="jumbotron" class="jumbotron p-3 mb-2 bg-transparent text-body .bg-transparent">
						<h2 class="display-1">WebDevCareerBusters Login</h2>
					</div>
				</div>
			</div>
		</section>
		<section>
			<form>
				<div class="form-group">
					<label for="exampleInputEmail1">Email address</label>
					<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
							 placeholder="Enter email">
					<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
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
			</form>
		</section>

	</body>