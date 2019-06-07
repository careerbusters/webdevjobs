import React from "react";

export const SignUp = () => (
<div className="container">
	<form>
	<form id="contact-form" method="post" action="../php/">
		<div className="form-row">
			<div className="form-group col-md-6">
<<<<<<< HEAD

				<label for="name">Name</label>
=======
				 {/*user name*/}
				<label htmlFor="name">Name</label>
>>>>>>> develop
				<div className="input-group">
					<div className="input-group-prepend">
					</div>
					<input className="form-control" type="text" name="name" id="profileName" placeholder="Your name"/>
				</div>
			</div>
		</div>
<<<<<<< HEAD

=======
		{/*user email address*/}
>>>>>>> develop
		<div className="form-row">
			<div className="form-group col-md-6">
				<label htmlFor="Address">Email Address</label>
				<div className="input-group">
					<div className="input-group-prepend">

					</div>
					<input className="form-control" type="text" name="Address" id="profileEmailAddress" placeholder="Email Address"/>
				</div>
			</div>
		</div>
<<<<<<< HEAD

=======
		{/*user password */}
>>>>>>> develop
		<div className="form-row">
			<div className="form-group col-md-6">
				<label htmlFor="Zip Code">Password</label>
				<div className="input-group">
					<div className="input-group-prepend">

					</div>
					<input type="text" className="form-control" id="profilePassword" placeholder="confirm password"/>
				</div>
			</div>
		</div>
<<<<<<< HEAD

=======
		{/*user password confirmed */}
>>>>>>> develop
		<div className="form-row">
			<div className="form-group col-md-6">
				<label htmlFor="email">Confirm Password again</label>
				<div className="input-group">
					<div className="input-group-prepend">

					</div>
					<input className="form-control" type="text" name="confirm password again" id="profileConfirmPassword" placeholder="confirm password again"/>
				</div>
			</div>
		</div>
<<<<<<< HEAD

=======
		{/*user role */}
>>>>>>> develop
		<div className="form-row">
			<div className="form-group col-md-6">
				<label htmlFor="phone number">Role</label>
				<div className="input-group">
					<div className="input-group-prepend">

					</div>
					<input className="form-control" type="text" name="role" id="ProfileRole" placeholder="please choose a role"/>
				</div>
			</div>
		</div>
		 {/*user profile image */}
		<div className="form-row">
			<div className="form-group col-md-6">
				<label htmlFor="Subject">Profile Image</label>
				<div className="input-group">
					<div className="input-group-prepend">

					</div>
					<input className="form-control" type="text" name="Profile Image" id="profileImage" placeholder="Profile Image"/>
				</div>
			</div>
		</div>
		 {/*user bio */}
		<div className="form-row">
			<div className="form-group col-md-6">
				<label htmlFor="Message">Profile Bio</label>
				<div className="input-group">
					<div className="input-group-prepend">

					</div>
					<textarea id="bio" "form-control" rows="5" name="Bio"
								 placeholder="(2000 characters max)"></textarea>
				</div>
			</div>
		</div>


		<button className="button1 btn btn-primary" type="submit">Sign Up!</button>

		<div id="output-area"></div>
	</form>
</div>

);

