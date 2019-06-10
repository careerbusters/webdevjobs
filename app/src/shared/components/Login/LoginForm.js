import React from 'react';
import {httpConfig} from "../../misc/http-config.js";
import {Formik} from "formik/dist/index";
import * as Yup from "yup";
import {Login} from "../../../pages/Login";
import {LoginFormContent} from "./LoginContent";
import {Redirect} from "react-router";



export const LoginForm = ({history}) => {
	const validator = Yup.object().shape({
		profileEmail: Yup.string()
			.email("email must be a valid email")
			.required('email is required'),
		profilePassword: Yup.string()
			.required("Password is required")
			.min(3, "Password must be at least eight characters")
	});


	//the initial values object defines what the request payload is.
	const Login = {
		profileEmail: "",
		profilePassword: ""
	};

	const submitLogin = (values, {resetForm, setStatus}) => {
		httpConfig.post("/apis/login/", values)
			.then(reply => {
				let {message, type} = reply;
				setStatus({message, type});
				if(reply.status === 200 && reply.headers["x-jwt-token"]) {
					window.localStorage.removeItem("jwt-token");
					window.localStorage.setItem("jwt-token", reply.headers["x-jwt-token"]);
					history.push('/devpage/');
				}
			});
	};

	return (
		<>
			<Formik
				initialValues={Login}
				onSubmit={submitLogin}
				validationSchema={validator}
			>
				{LoginFormContent}
			</Formik>
		</>
	)
};



