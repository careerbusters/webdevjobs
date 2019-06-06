import React from "react";
import { FontAwesomeIcon} from "@fortawesome/react-fontawesome";


export const NavBar = () => (
<header>
	<nav className="navbar navbar-light bg-light">
		<a className="navbar-brand"/a>
			<a className="fa-user-circle fa-2x" data-target="Profile Icon">
			</a>


		<ul className="nav justify-content-end">
			<li className="nav-item">
				<a className="nav-link active" href="https://bootcamp-coders.cnm.edu/~eyoung21/webdevjobs/Static-ui/navbar.php"/a>
					<a className="fas fa-home fa-2x text-dark" data-target="Home Page Icon">
					</a>


		<li className="nav-item">
			<a className="nav-link active" href="https://bootcamp-coders.cnm.edu/~eyoung21/webdevjobs/Static-ui/navbar.php"/a>
	<a className="fas fa-users fa-2x text-dark" data-target="Recruiter Job Posting Page Icon">
		</a>


	<li className="nav-item">
		<a className="nav-link active" href="https://bootcamp-coders.cnm.edu/~eyoung21/webdevjobs/Static-ui/navbar.php"/a>
			<a className="fas fa-briefcase fa-2x text-dark" data-target="Saved Job Icon"</a>
	</li>
</ul>
</nav>
</header>
)