import React, {useState} from 'react';
import {httpConfig} from "../../misc/http-config";
import * as Yup from "yup";
import {Formik} from "formik";

import {SignUpFormContent} from "./SignUpFormContent";

export const SignUpForm = () => {
	const signUp = {
		profileUsername: "",
		profileEmail: "",
		profileLocation: "",
		roleId: "",
		profilePassword: "",
		profilePasswordConfirm: "",
		profileBio: "",
	};

	const [status, setStatus] = useState(null);
	const validator = Yup.object().shape({
		profileUsername: Yup.string()
			.required("user name required")
			.min(8, "user name required to be at least 8 characters"),
		profileEmail: Yup.string()
			.email("email must be a valid email")
			.required('email is required'),
		profileLocation: Yup.string()
			.required("picking a location is required"),
		roleId: Yup.string()
			.required("you must pick a role"),
		profilePassword: Yup.string()
			.required("Password is required")
			.min(8, "Password must be at least 8 characters"),
		profilePasswordConfirm: Yup.string()
			.required("Password Confirm is required")
			.min(8, "Password must be at least 8 characters"),
		profileBio: Yup.string()
			.min(8, "content must be at least 8 characters")
			.max(30000, "content must not exceed 30,000 characters")
	});

	const submitSignUp = (values, {resetForm, setStatus}) => {
		httpConfig.post("/apis/signup/", values)
			.then(reply => {
					let {message, type} = reply;
					setStatus({message, type});
					if(reply.status === 200) {
						resetForm();
					}
				}
			);
	};


	return (

		<Formik
			initialValues={signUp}
			onSubmit={submitSignUp}
			validationSchema={validator}
		>
			{SignUpFormContent}
		</Formik>

	)
};