import React, {useEffect} from "react";
import {NavBar} from "../shared/components/NavBar";
import {Footer} from "../shared/components/Footer";
import {DevCard} from "../shared/components/dev/DevCard";
import {getProfileByProfileRoleId} from "../shared/actions";

import {connect} from "react-redux";

const DevComponent = (props) => {
	const {match, profiles, getProfileByProfileRoleId} = props;

	useEffect(() => {
		getProfileByProfileRoleId(match.params.roleId)
		},
		[getProfileByProfileRoleId]
	);


	const renderProfiles = () => {
		if(profiles){
			return profiles.map(profile =>{
			return(<div>{profile.profileUsername}</div>)
			})
		}
	};

	console.log(profiles);

	return (
		<>
			{/*<NavBar/>*/}
			{/*<div className="bg-secondary p-2">*/}
			{/*	/!*Dev Page Header*!/*/}
			{/*	<div className="container d-flex justify-content-center text-content-center">*/}
			{/*		<div id="jumbotron"*/}
			{/*			  className="jumbotron p-3 mb-2 bg-transparent text-body text-align .bg-transparent">*/}
			{/*			<div className="row">*/}
			{/*				<h1 className="display-2 font-weight-bold">Developer Hub</h1>*/}
			{/*			</div>*/}
			{/*		</div>*/}
			{/*	</div>*/}
				{renderProfiles()}
				{/*User Cards*/}
				{/*<DevCard/>*/}
				{/*<div className="container bg-dark justify-content-center p-3 mb-5">*/}
				{/*	<div className="row justify-content-center">*/}
				{/*		<div className="col-sm-8 justify-content-center">*/}
				{/*			<div id="dev">*/}
				{/*				<div className="card bg-light border-primary">*/}
				{/*					<h2 className="text-center p-3">Marty Bonacci</h2>*/}
				{/*					<h3 className="text-center p-2">Freelancer</h3>*/}
				{/*					<p className="text-center mx-3">*/}
				{/*						I’ve been lucky enough to have the pleasure of Designing and Programming Websites for the*/}
				{/*						last handful of years.*/}
				{/*						I first worked as a Graphic Designer at a Printing Facility, designing everything from*/}
				{/*						Business Cards and Logos to flyers, brochures, and huge banners.*/}
				{/*						Eventually I was asked to make a website - and I did what every programmer does: I do*/}
				{/*						searches using Google to figure out how to fix my problems and errors. Since then, I have*/}
				{/*						been learning the ins and outs of the Web Design world - specifically Front End Development.*/}
				{/*						In Web Design I satiate my desire to visually design something while stretching my*/}
				{/*						Programming wings at the same time. I like to work with the Wordpress platform, focusing on*/}
				{/*						creating websites that result in a pleasing browsing experience for the user - making sure*/}
				{/*						that the website is viewable on whatever sized screen, fast, and beautiful.*/}
				{/*						Outside of work, I enjoy growing Carnivorous Plants and learning how to make stuff with*/}
				{/*						wood.My Skills: Print / Graphic Design, 5 Years Experience, adobe Photoshop / Illustrator,*/}
				{/*						Knowledge of Design Principles*/}
				{/*						Experience working at a Print Facility, Web Design & Development class, 8 Years Experience*/}
				{/*						HTML, CSS/SCSS/SASS , Javascript, JQuery, PHP, Wordpress Expert,Bootstrap, Responsive/Mobile*/}
				{/*						Design*/}
				{/*						Performance Optimization, 1 year working with React</p>*/}
				{/*				</div>*/}
				{/*			</div>*/}
				{/*		</div>*/}
				{/*	</div>*/}
				{/*</div>*/}
			{/*</div>*/}

			{/*<Footer/>*/}
		</>
	)
};
const mapStateToProps = (state) => {
	const {profiles, roles} = state;
	return {profiles};
};
export const Dev = connect(mapStateToProps, { getProfileByProfileRoleId})(DevComponent);

