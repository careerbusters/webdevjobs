import React from "react";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";


export const NavBar = () => (
<header>
	<nav className="navbar navbar-light bg-light">
		<a className="navbar-brand" href="#"/>
			<FontAwesomeIcon icon="User-circle-2x" />


		<ul className="nav justify-content-end"/>
			<li className="nav-item">
				<a className="nav-link active" href="#"/>
				<FontAwesomeIcon icon="Home-2x" />
			</li>

		<li className="nav-item">
			<a className="nav-link active" href="#"/>
			<FontAwesomeIcon icon="User-2x" />
		</li>


	<li className="nav-item">
		<a className="nav-link active" href="#"/>
		<FontAwesomeIcon icon="Briefcase-2x" />
	</li>
</nav>
</header>
);
