import React from "react";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";


export const NavBar = () => (
<header>
	<nav className="navbar navbar-light bg-light">
		<a className="navbar-brand"/>
			<FontAwesomeIcon icon="User-circle-2x" />


		<ul className="nav justify-content-end"/>
			<li className="nav-item">
				<a className="nav-link active" href="https://bootcamp-coders.cnm.edu/~eyoung21/webdevjobs/Static-ui/navbar.php"/>
				<FontAwesomeIcon icon="Home-2x" />
			</li>

		<li className="nav-item">
			<a className="nav-link active" href="https://bootcamp-coders.cnm.edu/~eyoung21/webdevjobs/Static-ui/navbar.php"/>
			<FontAwesomeIcon icon="User-2x" />
		</li>


	<li className="nav-item">
		<a className="nav-link active" href="https://bootcamp-coders.cnm.edu/~eyoung21/webdevjobs/Static-ui/navbar.php"/>
		<FontAwesomeIcon icon="Briefcase-2x" />
	</li>
</nav>
</header>
);
