import React, {useEffect} from 'react';
import {LoginNavBar} from "../shared/components/Login-NavBar";
import "../index.css";
import {Footer} from "../shared/components/Footer";
import {getXSRF} from "../shared/actions";
import {httpConfig} from "../shared/misc/http-config";


const HomeComponent = () => {
	useEffect(() => {
		httpConfig("/apis/earl-grey/");
		},
		[]
	);
	return (
		<>
			<LoginNavBar>
			</LoginNavBar>
			<div id="home" className="col-lg-offset-4 bg-secondary">
				<div className="container d-flex justify-content-center text-content-center">
					<div id="jumbotron"
						  className="jumbotron p-5 mb-2 bg-transparent text-body text-align .bg-transparent">
						<div className="row">
							<h1 className="display-2 font-weight-bold">Web Dev Jobs</h1>
						</div>
					</div>
				</div>

			</div>
			<div className="container-fluid bg-secondary pb-5" id="1">
				<div className="row justify-content-center">
					<div className="col-sm-10 justify-content-center">
						<div id="carousel" className=" carousel slide justify-content-center center-content  height=500 width=900" data-ride="carousel">
							<div className="justify-content-center center-content carousel-inner height=500 width=900">
								<div className="justify-content-center center-content carousel-item active">
									<div className="card text-center">
										<div className="card-header justify-content-left">
											Fullstack Web Developer - RS21
										</div>
										<div className="card-body">
											<h5 className="card-title text-left mt-1">Job Valid Date</h5>
											<p className="card-text">I am web dev, I go code code code. I am web dev, I go code code code. I am
												web
												dev, I go code code code. I am web dev, I go code code code.</p>
										</div>
										<div className="card-footer text-muted">
											Albuquerque, New Mexico
										</div>
									</div>
								</div>
								<div className=" justify-content-center center-content  carousel-item">
									<div className="card text-center">
										<div className="card-header justify-content-left">
											Fullstack Web Developer - RS21
										</div>
										<div className="card-body">
											<h5 className="card-title text-left mt-1">Job Valid Date</h5>
											<p className="card-text">I am web dev, I go code code code. I am web dev, I go code code code. I am
												web
												dev, I go code code code. I am web dev, I go code code code.</p>
										</div>
										<div className="card-footer text-muted">
											Albuquerque, New Mexico
										</div>
									</div>
								</div>
								<div className=" justify-content-center center-content carousel-item">
									<div className="card text-center">
										<div className="card-header justify-content-left">
											Fullstack Web Developer - RS21
										</div>
										<div className="card-body">
											<h5 className="card-title text-left mt-1">Job Valid Date</h5>
											<p className="card-text">I am web dev, I go code code code. I am web dev, I go code code code. I am
												web
												dev, I go code code code. I am web dev, I go code code code.</p>
										</div>
										<div className="card-footer text-muted">
											Albuquerque, New Mexico
										</div>
									</div>
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

			<div className="container-fluid pt-5 pb-5 bg-secondary">
			<blockquote className="blockquote text-center">
				<p className="mb-0"><em>Welcome to Your Professional Web Dev Jobs Platform!</em></p>
			</blockquote>
			{/*Welcome Page Text*/}
			<blockquote className="blockquote text-center">
				<p className="mb-0"><em>If opportunity doesn't come knocking, build a website!</em></p>
			</blockquote>
			</div>
			<Footer/>
		</>
	)
};
export const Home = (HomeComponent);