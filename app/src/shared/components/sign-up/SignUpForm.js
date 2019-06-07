import React, {useState} from 'react';
import {httpConfig} from "../../../misc/http-config";
import * as Yup from "yup";
import {Formik} from "formik";

import {SignUpFormContent} from "./SignUpFormContent";

export const SignUpForm = () => {
	const signUp = {
		profileName: "",
		profileEmail: "",
		profileRole: "",
		profilePassword: "",
		profilePasswordConfirm: "",
		profileImage: "",
		profileBio: "",
	};

	const [status, setStatus] = useState(null);
	const validator = Yup.object().shape({
		profileUserName: Yup.string()
			.required("user name is required"),
		profileEmail: Yup.string()
			.email("email must be a valid email")
			.required('email is required'),
		profileLocation: Yup.string()
			.required("location must be Albuquerque"),
		profileRole: Yup.string()
			.required("role must be Developer, Freelancer, Recruiters, Employers, Entrepreneurs"),
		profilePassword: Yup.string()
			.required("Password is required")
			.min(8, "Password must be at least eight characters"),
		profilePasswordConfirm: Yup.string()
			.required("Password Confirm is required")
			.min(8, "Password must be at least eight characters"),
		profileImage: Yup.string()
			.required("")
			.min(8, "Password must be at least eight characters"),
		profileBio: Yup.string()
			.min(8, "content must be at least 8 characters")
			.max(30000, "content must not exceed 30,000 characters")
	});

	const submitSignUp = (values, {resetForm}) => {
		httpConfig.post("/apis/sign-up/", values)
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