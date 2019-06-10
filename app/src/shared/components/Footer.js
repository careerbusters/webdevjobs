import React from "react";

export const Footer = () => (
	<footer className="container-fluid footer text-center fixed-bottom bg-dark">
		 {/*Copyright */}
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
				integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay"
				crossOrigin="anonymous"/>
		<div className="justify-content-center text-white py-2">© 2019 copyright by Erik Young, Natasha Lovato, Trystan
			Gray
			<a href="https://github.com/careerbusters/webdevjobs" className="github">
				<i className="fab fa-github-square text-white mx-3 fa-2x"> </i></a>
		</div>
	</footer>
);