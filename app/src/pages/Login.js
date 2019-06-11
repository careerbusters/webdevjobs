import React from "react";
import {Footer} from "../shared/components/Footer";
import {LoginForm} from "../shared/components/Login/LoginForm";

export const Login = ({history}) => (


	<>

		<section>
			<div id="home" className="col-lg-offset-4">
				<div className="container-fluid bg-info pb-5 d-flex justify-content-center text-content-center">
					<div id="jumbotron" className="jumbotron p-3 mb-2 bg-transparent text-body text-align .bg-transparent">
						<div className="row">
							<div className="container d-flex justify-content-center text-content-center">
								<div id="jumbotron"
									  className="jumbotron p-3 mb-2 bg-transparent text-body text-align .bg-transparent">
									<div className="row">
										<h1 className="display-2 font-weight-bold">Web Dev Login</h1>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		{/*Image Card*/}

		<section>
			<div className="container bg-dark d-flex justify-content-center py-5 my-5">
				<div className="card" style={{width: "18rem"}}>
					<div className="card-body">

						{/*Login Form*/}
<LoginForm history={history}/>
						{/*<form>*/}
							{/*<div className="form-group">*/}
								{/*<label htmlFor="exampleInputEmail1">Email address</label>*/}
								{/*<input type="email" className="form-control" id="exampleInputEmail1"*/}
										 {/*aria-describedby="emailHelp"*/}
										 {/*placeholder="Enter email"/>*/}
							{/*</div>*/}
							{/*<div className="form-group">*/}
								{/*<label htmlFor="exampleInputPassword1">Password</label>*/}
								{/*<input type="password" className="form-control" id="exampleInputPassword1"*/}
										 {/*placeholder="Password"/>*/}
							{/*</div>*/}
							{/*<div className="form-group form-check">*/}
								{/*<input type="checkbox" className="form-check-input" id="exampleCheck1"/>*/}
								{/*<label className="form-check-label" htmlFor="exampleCheck1">Remember Me</label>*/}
							{/*</div>*/}
							{/*<button type="submit" className="btn btn-primary btn-lg btn-block">Login</button>*/}
						{/*</form>*/}
					</div>
				</div>
			</div>
			<Footer/>
		</section>
	</>


);