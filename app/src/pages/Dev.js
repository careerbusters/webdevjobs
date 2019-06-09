import React from "react";
import {NavBar} from "../shared/components/NavBar";
import {Footer} from "../shared/components/Footer";

export const DevPage = () => (
	<>
		<NavBar/>
		<body>
			{/*Dev Page Header*/}
			<div className="container text-center mt-3 mb-2">
				<h2>Developer Hub</h2>
			</div>

			{/*User Cards*/}
			<div className="container justify-content-center p-3 mb-5">
				<div className="row justify-content-center">
					<div className="col-sm-10 justify-content-center">
						<div id="dev">
								<div className="card  border-primary">
									<img src="/imgs/morganCaptain.jpg" height="auto" width="auto" className="card-img-top p-1"
										  alt="Profile Example 1"/>
									<h5 className="text-center p-3">Will Iam</h5>
									<p className="text-center mx-3">Seasoned Coder. Full-Stack Web Developer. I wear many hats.
										Making
										things and building teams!!</p>
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