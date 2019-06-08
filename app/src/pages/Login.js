import React from "react";

export const Login = () => (
	<>
		<section>
			<div id="home" className="col-lg-offset-4">
				<div className="container d-flex justify-content-center text-content-center">
					<div id="jumbotron" className="jumbotron p-3 mb-2 bg-transparent text-body text-align .bg-transparent">
						<div className="row">
							<h1 className="display-2">Web Dev Career Busters Login</h1>
						</div>
					</div>
				</div>
			</div>
		</section>

		{/*Image Card*/}

		<section>
			<div className="container d-flex justify-content-center mb-2">
				<div className="card" style={{width: "18rem"}}>
					<div className="card-body">
						<p className="card-text"></p>

						{/*Login Form*/}

						<form>
							<div className="form-group">
								<label htmlFor="exampleInputEmail1">Email address</label>
								<input type="email" className="form-control" id="exampleInputEmail1"
										 aria-describedby="emailHelp"
										 placeholder="Enter email"/>
							</div>
							<div className="form-group">
								<label htmlFor="exampleInputPassword1">Password</label>
								<input type="password" className="form-control" id="exampleInputPassword1"
										 placeholder="Password"/>
							</div>
							<div className="form-group form-check">
								<input type="checkbox" className="form-check-input" id="exampleCheck1"/>
								<label className="form-check-label" htmlFor="exampleCheck1">Remember Me</label>
							</div>
							<button type="submit" className="btn btn-primary btn-lg btn-block">Login</button>
						</form>
					</div>
				</div>
			</div>
		</section>
	</>


);