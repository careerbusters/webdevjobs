import React from "react";
import { Route } from 'react-router';

export const LoginNavBar = () => (
	<Route render = { ({history}) => (
<header>
	<ul className="nav justify-content-end">
		<li className="nav-item">
			<a className="nav-link active" onClick={()=> {history.push("signup/")}}>Join Now</a>
		</li>
		<li className="nav-item">
			<a className="nav-link" onClick={()=> {history.push("login/")}}>Login</a>
		</li>
	</ul>
</header>
	)}/>
);