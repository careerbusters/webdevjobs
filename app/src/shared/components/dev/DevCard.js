import React, {useEffect} from "react";
import {connect} from "react-redux";
import {getProfileByProfileId} from "../../actions";

const DevCard = (props) => {
	const {getProfileByProfileId, profile} = props;

	useEffect(() => {
		getProfileByProfileId("e8aaa70f-b03d-4c94-9f94-6b95ea95c64d")
	}, [getProfileByProfileId, "e8aaa70f-b03d-4c94-9f94-6b95ea95c64d"]);

	console.log(props);
	const renderProfile = () => {
		return (
		<h2 className="text-center p-3">{profile.profileUsername}</h2>
		);
	};
	return (
		<>
			{/*User Cards*/}
			<div className="container bg-dark justify-content-center p-3 mb-5">
				{/*{profiles.map(profile => (*/}
					<div className="row justify-content-center">
						<div className="col-sm-8 justify-content-center">
							<div id="dev">
								<div className="card bg-light border-primary">
									{renderProfile()}
									<h3 className="text-center p-2">tet</h3>
									<p className="text-center mx-3">
										I’ve been lucky enough to have the pleasure of Designing and Programming Websites for the
										last handful of years.
										I first worked as a Graphic Designer at a Printing Facility, designing everything from
										Business Cards and Logos to flyers, brochures, and huge banners.
										Eventually I was asked to make a website - and I did what every programmer does: I do
										searches using Google to figure out how to fix my problems and errors. Since then, I have
										been learning the ins and outs of the Web Design world - specifically Front End
										Development.
										In Web Design I satiate my desire to visually design something while stretching my
										Programming wings at the same time. I like to work with the Wordpress platform, focusing
										on creating websites that result in a pleasing browsing experience for the user - making
										sure that the website is viewable on whatever sized screen, fast, and beautiful.
										Outside of work, I enjoy growing Carnivorous Plants and learning how to make stuff with
										wood.My Skills: Print / Graphic Design, 5 Years Experience, adobe Photoshop / Illustrator,
										Knowledge of Design Principles
										Experience working at a Print Facility, Web Design & Development class, 8 Years Experience
										HTML, CSS/SCSS/SASS , Javascript, JQuery, PHP, Wordpress Expert,Bootstrap,
										Responsive/Mobile Design
										Performance Optimization, 1 year working with React</p>
								</div>
							</div>
						</div>
					</div>
				{/*))}*/}
			</div>
		</>
	)
};
const mapStateToProps = (DevCard) => {
	return {profile: DevCard.profile}

};
export const Profile = connect(mapStateToProps, {getProfileByProfileId})(DevCard);