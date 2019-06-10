import React from "react";
import {Footer} from "../shared/components/Footer";
import {NavBar} from "../shared/components/NavBar";
export const Jobs = () => (
	<>
		<NavBar/>
<body>
	<div className="container text-center">
		<h3>Job Postings</h3>
	</div>
	<section>
		<div className="container">
			<div className="row justify-content-center my-5">
				<div className="col-lg-9">
					<div className="card text-center">
						<div className="card-header justify-content-left">
							Fullstack Web Developer - RS21
						</div>
						<div className="card-body">
							<h5 className="card-title mt-1">Job Valid Date</h5>
							<p className="card-text">I am web dev, I go code code code. I am web dev, I go code code code. I am
								web
								dev, I go code code code. I am web dev, I go code code code.</p>
							<a href="#" className="btn btn-dark">Expand Profile</a>
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
