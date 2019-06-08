import React from "react";
import {LoginNavBar} from "../shared/components/Login-NavBar";
import "../index.css";


const HomeComponent = () => {
	return (
		<>
			<LoginNavBar>
			</LoginNavBar>
			<div id="home" className="col-lg-offset-4">
				<div className="container d-flex justify-content-center text-content-center">
					<div id="jumbotron"
						  className="jumbotron p-3 mb-2 bg-transparent text-body text-align .bg-transparent">
						<div className="row">
							<h1 className="display-2">Web Dev Jobs</h1>
						</div>
					</div>
				</div>

			</div>
			<div className="container" id="1">
				<div className="row justify-content-center">
					<div className="col-sm-10 justify-content-center">
						<div id="carousel" className="carousel slide  height=500 width=900" data-ride="carousel">
							<div className="carousel-inner height=500 width=900">
								<div className="carousel-item active">
									<img src="imgs/example-job-description-career-busters3.jpg" height="500" width="auto"
										  alt="Example Job Description 1"/>
								</div>
								<div className="carousel-item">
									<img src="imgs/example-job-description-career-busters1.jpg" height="500" width="auto"
										   alt="Example Job Description 2"/>
								</div>
								<div className="carousel-item">
									<img src="imgs/example-job-description-career-busters2.jpg" height="500" width="auto"
										  alt="Example Job Description 3"/>
								</div>
							</div>
							<a className="carousel-control-prev" href="#carouselExampleControls" role="button"
								data-slide="prev">
								<span className="carousel-control-prev-icon" aria-hidden="true"></span>
								<span className="sr-only">Previous</span>
							</a>
							<a className="carousel-control-next" href="#carouselExampleControls" role="button"
								data-slide="next">
								<span className="carousel-control-next-icon" aria-hidden="true"></span>
								<span className="sr-only">Next</span>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div id="break"></div>
			<br/>
			<br/>
			<br/>
			<blockquote className="blockquote text-center">
				<p className="mb-0"><em>Welcome to Your Professional Web Dev Jobs Platform!</em></p>
			</blockquote>
			<br/>
			{/*Welcome Page Text*/}
			<blockquote className="blockquote text-center">
				<p className="mb-0"><em>If opportunity doesn't come knocking, build a website!</em></p>
			</blockquote>

			{/*Sign Up Button*/}
			<div id="signup" className="container fluid justify-content-end">
				<div className="row justify-content-center">
					<button id="button" type="button" className="btn btn-primary my-2 btn-lgr">Sign Up</button>
				</div>
			</div>
		</>
	)
};
export const Home = (HomeComponent);