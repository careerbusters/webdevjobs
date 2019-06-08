import React from "react";
import { Route } from 'react-router';

export const LoginNavBar = () => (
	<Route render = { ({history}) => (
		<header>
			<nav className="navbar navbar-dark bg-info fluid d-flex justify-content-end">
				<form className="form-inline">
					<button type="button" className="btn btn-outline-link" onClick={()=> {history.push("signup/")}}>Join Now</button>
					<button type="button" className="btn btn-outline-link mx-2" onClick={()=> {history.push("login/")}}>Login</button>
				</form>
			</nav>
		</header>
	)}/>
);

