import React from "react";
import {NavBar} from "../shared/components/NavBar";
import {Footer} from "../shared/components/Footer";

export const DevPage = () => (
	<>
		<NavBar/>
		<body className="bg-secondary p-2">
			{/*Dev Page Header*/}
			<div className="container d-flex justify-content-center text-content-center">
				<div id="jumbotron"
					  className="jumbotron p-3 mb-2 bg-transparent text-body text-align .bg-transparent">
					<div className="row">
						<h1 className="display-2 font-weight-bold">Developer Hub</h1>
					</div>
				</div>
			</div>
			{/*User Cards*/}
			<div className="container bg-dark justify-content-center p-3 mb-5">
				<div className="row justify-content-center">
					<div className="col-sm-8 justify-content-center">
						<div id="dev">
								<div className="card bg-light border-primary">
									<img src="/imgs/morganCaptain.jpg" height="auto" width="auto" className="card-img-top p-1"
										  alt="Profile Example 1"/>
									<h5 className="text-center p-3">Marty Bonacci</h5>
									<p className="text-center mx-3">Seasoned Coder. Full time DAD! Full-Stack Web Developer. I wear many hats.
										Making things and building teams!!</p>
									<a href="#" className="stretched-link text-right mb-2 mx-3">Read More...</a>
								</div>
							</div>
						</div>
					</div>
				</div>
		</body>
		<br/>
		<br/>
		<Footer/>
	</>
);
