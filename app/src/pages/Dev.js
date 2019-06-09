import React from "react";
import {NavBar} from "../shared/components/NavBar";
import {Footer} from "../shared/components/Footer";

export const DevPage = () => (
	<>
		<NavBar/>
	<body>
		{/*Dev Page Header*/}
		<div className="container text-center">
			<h2>Developer Hub</h2>
		</div>

		{/*User Cards*/}
		<div id="dev" className="container justify-content-center">
			<div className="row justify-content-center">
				<div className="card  border-primary">
					<img src="/imgs/morganCaptain.jpg" height="500" width="500" className="card-img-top"
						  alt="Profile Example 1"/>
						<h5 className="text-center">Will Iam</h5>
						<p className="text-center">Seasoned Coder. Full-Stack Web Developer. I wear many hats. Making
							things and building teams!!</p>
						<a href="#" className="stretched-link text-right">Read More...</a>
				</div>
			</div>
		</div>
	</body>
		<Footer/>
	</>
);