import React from "react";
import {Footer} from "../shared/components/Footer";
import {NavBar} from "../shared/components/NavBar";
export const Jobs = () => (
	<>
		<NavBar/>
<body className="bg-secondary pb-5 ">
	<div className="container text-center">
		<div id="jumbotron"
			  className="jumbotron p-3 mb-2 bg-transparent text-body text-align .bg-transparent">
			<div className="row justify-content-center">
				<h1 className="display-2 font-weight-bold a">Job Postings</h1>
			</div>
		</div>
	</div>
	<section>
		<div className="container bg-dark mb-5 p-5">
			<div className="row justify-content-center my-5">
				<div className="col-lg-9">
					<div className="card text-center">
						<div className="card-header justify-content-left">
							Fullstack Web Developer - RS21
						</div>
						<div className="card-body">
							<h5 className="card-title text-left mt-1">Job Valid Date</h5>
							<p className="card-text">I am web dev, I go code code code. I am web dev, I go code code code. I am
								web
								dev, I go code code code. I am web dev, I go code code code.</p>
							<a href="#" className="btn btn-dark float-right">Expand Profile</a>
						</div>
						<div className="card-footer text-muted">
							Albuquerque, New Mexico
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</body>
		<Footer/>

	</>
);
