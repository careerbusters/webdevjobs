import React from "react";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";


export const NavBar = () => (
<header>
	<nav className="navbar navbar-light bg-light">
		<a className="navbar-brand justify-content-start" href="#">
			<FontAwesomeIcon icon="user" />
		</a>

		<div>
			<a className=" nav-item justify-content-end mx-3"  href="/devpage/">
				<FontAwesomeIcon icon="home" />
			</a>



			<a className="nav-item justify-content-end mx-3" href="/jobs/">
			<FontAwesomeIcon icon="user-alt" />
			</a>



		<a className="nav-item justify-content-end mx-3" href="/app/src/pages/Saved.js">
		<FontAwesomeIcon icon="briefcase" />
		</a>
		</div>
</nav>
</header>
);
