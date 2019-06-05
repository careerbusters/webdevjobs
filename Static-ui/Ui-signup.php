<?php require_once("head-utils.php"); ?>
<?php require_once("navbar.php"); ?>
<?php require_once("Ui-footer.php"); ?>


		<div class="container">
			<form id="contact-form" method="post" action="../php/">
				<div class="form-row">
				<div class="form-group col-md-6">
					<!-- user name -->
					<label for="name">Name</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-user"></i></span>
						</div>
						<input class="form-control" type="text" name="name" id="name" placeholder="Your name">
					</div>
				</div>
				</div>
				<!--user email address -->
				<div class="form-row">
					<div class="form-group col-md-6">
					<label for="Address">Email Address</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-envelope"></i></span>
							</div>
					<input class="form-control" type="text" name="Address" id="Email Address" placeholder="Email Address">
				</div>
					</div>
				</div>
				<!--user password -->
				<div class="form-row">
				<div class="form-group col-md-6">
					<label for="Zip Code">Password</label>
						<div class="input-group">
						<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-lock"></i></span>
					</div>
							<input type="text" class="form-control" id="confirm password" placeholder="confirm password">
				</div>
				</div>
				</div>
<!--user password confirmed -->
				<div class="form-row">
				<div class="form-group col-md-6">
					<label for="email">Confirm Password again</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-lock"></i></span>
						</div>
						<input class="form-control" type="text" name="confirm password again" id="confirm password again" placeholder="confirm password again">
					</div>
				</div>
				</div>
				<!--user role -->
				<div class="form-row">
				<div class="form-group col-md-6">
					<label for="phone number">Role</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-glasses"></i></span>
						</div>
						<input class="form-control" type="text" name="role" id="role" placeholder="please choose a role">
					</div>
				</div>
				</div>
				<!-- user profile image -->
				<div class="form-row">
				<div class="form-group col-md-6">
					<label for="Subject">Profile Image</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-image"></i></span>
						</div>
						<input class="form-control" type="text" name="Profile Image" id="Profile Image" placeholder="Profile Image">
					</div>
				</div>
				</div>
				<!-- user bio -->
				<div class="form-row">
				<div class="form-group col-md-6">
					<label for="Message">Profile Bio</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-book-reader"></i></span>
						</div>
						<textarea class="form-control" rows="5" id="Bio" name="Bio"
									 placeholder="(2000 characters max)"></textarea>
					</div>
				</div>
				</div>


				<button class="button1 btn btn-primary" type="submit">Sign Up!</button>

<div id="output-area"></div>
			</form>
		</div>
	<div>
	</div>
	</div>