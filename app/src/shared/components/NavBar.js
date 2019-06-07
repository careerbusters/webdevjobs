import React from "react";
import {faUser, faSignOutAlt, faPencilAlt} from '@fortawesome/free-solid-svg-icons'


export const NavBar = () => (
<header>
	<nav className="navbar navbar-light bg-light">
		<a className="navbar-brand"/>
			<a className="faUser-circle fa-2x" data-target="Profile Icon">
			</a>


		<ul className="nav justify-content-end"/>
			<li className="nav-item">
				<a className="nav-link active" href="https://bootcamp-coders.cnm.edu/~eyoung21/webdevjobs/Static-ui/navbar.php"/>
					<a className="faHome fa-2x text-dark" data-target="Home Page Icon">
					</a>
			</li>

		<li className="nav-item">
			<a className="nav-link active" href="https://bootcamp-coders.cnm.edu/~eyoung21/webdevjobs/Static-ui/navbar.php"/>
	<a className="fas fa-users fa-2x text-dark" data-target="Recruiter Job Posting Page Icon">
		</a>
		</li>


	<li className="nav-item">
		<a className="nav-link active" href="https://bootcamp-coders.cnm.edu/~eyoung21/webdevjobs/Static-ui/navbar.php"/>
			<a className="fas fa-briefcase fa-2x text-dark" data-target="Saved Job Icon"/>
		</li>
</nav>
</header>
)
