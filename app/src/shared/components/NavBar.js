import React from "react";


export const NavBar = () => (
<header>
	<nav className="navbar navbar-expand-lg navbar-dark">
		<small className="d-none d-md-inline-block text-muted mr-auto"><em>An Angularific Demo.</em></small>
				<button className="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
						  aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span className="navbar-toggler-icon"/>
				</button>

				<div className="collapse navbar-collapse" id="navbarSupportedContent">
					<ul className="navbar-nav ml-auto">
						<li className="nav-item dropdown">
							<a className="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button"
								data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

							</a>
							<div className="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
								<a className="dropdown-item" href="#"><i className="fa fa-user"/>&nbsp;&nbsp;My Profile</a>
								<a className="dropdown-item"><i className="fa fa-pencil"/>&nbsp;&nbsp;New
									Post</a>
								<div className="dropdown-divider"/>
								<a className="dropdown-item" href="#"><i className="fa fa-sign-out"/>&nbsp;&nbsp;Sign Out</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>
</header>
)
