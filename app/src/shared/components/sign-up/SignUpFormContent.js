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
	return (

			<form onSubmit={handleSubmit}>
				<div className="form-group">
					<label htmlFor="profileUserName">User Name</label>
					<div className="input-group">
						<div className="input-group-prepend">
							<div className="input-group-text">
								<FontAwesomeIcon icon="User Name"/>
							</div>
						</div>
						<input
							className="form-control"
							id="profileHandle"
							type="text"
							value={values.profileUserName}
							placeholder="User Name"
							onChange={handleChange}
							onBlur={handleBlur}
						/>
					</div>
					{errors.profileUserName && touched.profileUserName && (
							<div className="alert alert-danger">
								{errors.profileUserName}
							</div>
						)
					}
				</div>

					<div className="form-group">
						<label htmlFor="ProfileRole">Role</label>
						<div className="input-group">
							<div className="input-group-prepend">
								<div className="input-group-text">
									<FontAwesomeIcon icon="Role"/>
								</div>
							</div>
							<input
								className="form-control"
								id="profileRole"
								type="text"
								value={values.profileRole}
								placeholder="profile role"
								onChange={handleChange}
								onBlur={handleBlur}
							/>
						</div>
						{errors.profileRole && touched.profileRole && (
								<div className="alert alert-danger">
									{errors.profileRole}
								</div>
							)
						}
					</div>
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
								<FontAwesomeIcon icon="key"/>
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
								<FontAwesomeIcon icon="key"/>
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
							id="profilePhone"
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
									<FontAwesomeIcon icon="Bio"/>
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

				<div className="form-group">
					<button className="btn btn-primary mb-2" type="submit">Submit</button>
					<button
						className="btn btn-danger mb-2"
						onClick={handleReset}
						disabled={!dirty || isSubmitting}
					>Reset
					</button>
				</div>


				<FormDebugger {...props}/>
			</form>

			{console.log(submitStatus)}
			{
				submitStatus && (<div className={submitStatus.type}>{submitStatus.message}</div>)
			}

	)
};