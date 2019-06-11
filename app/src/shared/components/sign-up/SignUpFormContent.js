import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {FormDebugger} from "../FormDebugger";
import React from "react";

export const SignUpFormContent = (props) => {
	const {
		submitStatus,
		values,
		errors,
		touched,
		dirty,
		isSubmitting,
		handleChange,
		handleBlur,
		handleSubmit,
		handleReset
	} = props;
	console.log (props);
	return (

<>

	<div className="bg-info py-2 mt-0">
		<div className="container d-flex justify-content-center text-content-center">
			<div id="jumbotron"
				  className="jumbotron p-3 mb-2 bg-transparent text-body text-align .bg-transparent">
				<div className="row">
					<h1 className="display-2 font-weight-bold">Web Dev Sign Up</h1>
				</div>
			</div>
		</div>
	<div className="container bg-secondary border border-dark p-2 mb-5">
		<div className="row justify-content-center">
			<div className="col-lg-8 justify-content-center">
		<form onSubmit={handleSubmit}>
				<div className="form-group">
					<label htmlFor="profileUsername">Username</label>
					<div className="input-group">
						<div className="input-group-prepend">
							<div className="input-group-text">
								<FontAwesomeIcon icon="user"/>
							</div>
						</div>
						<input
							className="form-control"
							id="profileUsername"
							type="text"
							value={values.profileUsername}
							placeholder="Username"
							onChange={handleChange}
							onBlur={handleBlur}
						/>
					</div>
					{errors.profileUsername && touched.profileUsername && (
							<div className="alert alert-danger">
								{errors.profileUsername}
							</div>
						)
					}
				</div>
			{/*location must be in Albuquerque*/}
			<div className="form-group">
				<label htmlFor="profileLocation">Location</label>
				<div className="input-group">
					<div className="input-group-prepend">
						<div className="input-group-text">
							<FontAwesomeIcon icon="location"/>
						</div>
					</div>
					<select 		id="profileLocation"
									 className="form-control"
									 placeholder="Location"
									 value={values.profileLocation}
									 onChange={handleChange}

					>
						<option>Select</option>
						<option>Albuquerque</option>
					{/*<input*/}
					{/*	id="profileLocation"*/}
					{/*	className="form-control"*/}
					{/*	placeholder="Location"*/}
					{/*	value={values.profileLocation}*/}
					{/*	onChange={handleChange}*/}
					{/*	onBlur={handleBlur}*/}
					{/*/>*/}
					</select>
				</div>
			</div>


			<div className="form-group">
				<label htmlFor="profileRole">Role</label>
				<div className="input-group">
					<div className="input-group-prepend">
						<div className="input-group-text">
							<FontAwesomeIcon icon="glasses"/>
						</div>
					</div>
				<select className="form-control"
						  id="profileRole"
						  // type="select"
						  value={values.profileRole}
						  onChange={handleChange}
					// value={props.values.profileRole} className="form-control" id="profileRole"
>
					<option>Select</option>
					<option value="">Developer</option>
					<option>Freelancer</option>
					<option value="">Recruiters</option>
					<option>Entrepreneurs</option>
					<option>Other tech field</option>

					{/*<input*/}
					{/*	className="form-control"*/}
					{/*	id="profileRole"*/}
					{/*	type="select"*/}
					{/*	value={values.profileRole}*/}
					{/*	onChange={handleChange}*/}
					{/*	onBlur={handleBlur}*/}
					{/*/>*/}
				</select>
				</div>
			</div>

					{/*<div className="form-group">*/}
						{/*<label htmlFor="ProfileRole">Role</label>*/}
						{/*<div className="input-group">*/}
							{/*<div className="input-group-prepend">*/}
								{/*<div className="input-group-text">*/}
									{/*<FontAwesomeIcon icon="Role"/>*/}
								{/*</div>*/}
							{/*</div>*/}
							{/*<input*/}
								{/*className="form-control"*/}
								{/*id="profileRole"*/}
								{/*type="text"*/}
								{/*value={values.profileRole}*/}
								{/*placeholder="profile role"*/}
								{/*onChange={handleChange}*/}
								{/*onBlur={handleBlur}*/}
							{/*/>*/}
						{/*</div>*/}
						{/*{errors.profileRole && touched.profileRole && (*/}
								{/*<div className="alert alert-danger">*/}
									{/*{errors.profileRole}*/}
								{/*</div>*/}
							{/*)*/}
						{/*}*/}
					{/*</div>*/}
				{/*controlId must match what is passed to the initialValues prop*/}
				<div className="form-group">
					<label htmlFor="profileEmail">Email Address</label>
					<div className="input-group">
						<div className="input-group-prepend">
							<div className="input-group-text">
								<FontAwesomeIcon icon="envelope"/>
							</div>
						</div>
						<input
							className="form-control"
							id="profileEmail"
							type="email"
							value={values.profileEmail}
							placeholder="Enter email"
							onChange={handleChange}
							onBlur={handleBlur}

						/>
					</div>
					{
						errors.profileEmail && touched.profileEmail && (
							<div className="alert alert-danger">
								{errors.profileEmail}
							</div>
						)

					}
				</div>
				{/*controlId must match what is defined by the initialValues object*/}
				<div className="form-group">
					<label htmlFor="profilePassword">Password</label>
					<div className="input-group">
						<div className="input-group-prepend">
							<div className="input-group-text">
								<FontAwesomeIcon icon="lock"/>
							</div>
						</div>
						<input
							id="profilePassword"
							className="form-control"
							type="password"
							placeholder="Password"
							value={values.profilePassword}
							onChange={handleChange}
							onBlur={handleBlur}
						/>
					</div>
					{errors.profilePassword && touched.profilePassword && (
						<div className="alert alert-danger">{errors.profilePassword}
						</div>
					)}
				</div>

				<div className="form-group">
					<label htmlFor="profilePasswordConfirm">Confirm Your Password</label>
					<div className="input-group">
						<div className="input-group-prepend">
							<div className="input-group-text">
								<FontAwesomeIcon icon="lock"/>
							</div>
						</div>
						<input

							className="form-control"
							type="password"
							id="profilePasswordConfirm"
							placeholder="Password Confirm"
							value={values.profilePasswordConfirm}
							onChange={handleChange}
							onBlur={handleBlur}
						/>
					</div>
					{errors.profilePasswordConfirm && touched.profilePasswordConfirm && (
						<div className="alert alert-danger">{errors.profilePasswordConfirm}
						</div>
					)}
				</div>



				<div className="form-group">
					<label htmlFor="profileImage">Profile Image</label>
					<div className="input-group">
						<div className="input-group-prepend">
							<div className="input-group-text">
								<FontAwesomeIcon icon="image"/>
							</div>
						</div>
						<input
							className="form-control"
							id="profileImage"
							type="text"
							value={values.profileImage}
							placeholder="Enter image"
							onChange={handleChange}
							onBlur={handleBlur}
						/>
					</div>
					{errors.profileImage && touched.profileImage && (
						<div className="alert alert-danger">{errors.profileImage}
						</div>
					)}
				</div>


				<div className="form-group">
						<label htmlFor="profileBio">Profile Bio</label>
						<div className="input-group">
							<div className="input-group-prepend">
								<div className="input-group-text">
									<FontAwesomeIcon icon="book-reader"/>
								</div>
							</div>
							<input
								className="form-control"
								id="profileBio"
								type="text"
								value={values.profileBio}
								placeholder="Enter bio"
								onChange={handleChange}
								onBlur={handleBlur}
							/>
						</div>
					{errors.profileBio && touched.profileBio && (
						<div className="alert alert-danger">{errors.profileBio}
						</div>
					)}
				</div>

				<div className="form-group mb-2 ">
					<button className="btn btn-primary mx-2 mb-2" type="submit">Submit</button>
					<button
						className="btn btn-danger mb-2"
						onClick={handleReset}
						disabled={!dirty || isSubmitting}
					>Reset
					</button>
				</div>


				<FormDebugger {...props}/>

			</form>
			</div>

			{console.log(submitStatus)}
			{
				submitStatus && (<div className={submitStatus.type}>{submitStatus.message}</div>)
			}
			</div>
		</div>
</div>
</>
	)
};