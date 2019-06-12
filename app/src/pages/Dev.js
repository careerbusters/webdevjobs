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
		// 	if(profiles){
		// 		return profiles.map(profile =>{
		// 		return(
		// 			<>
		// 			<div>{profile.profileUsername}</div>
		// 				<div>{profile.profileBio}</div>
		// 				<div>{profile.profileLocation}</div>
		// 		</>
		// 		)
		// 		})
		// 	}
	};

	console.log(profiles);

	return (
		<>
			<NavBar/>
			<div className="bg-secondary p-2">
				{/*Dev Page Header*/}
				<div className="container d-flex justify-content-center text-content-center">
					<div id="jumbotron"
						  className="jumbotron p-3 mb-2 bg-transparent text-body text-align .bg-transparent">
						<div className="row">
							<h1 className="display-2 font-weight-bold">Developer Hub</h1>
						</div>
					</div>
				</div>
				{renderProfiles()}


				<div className="container bg-dark justify-content-center p-3 mb-5">
					<div className="row justify-content-center">
						<div className="col-sm-8 justify-content-center">
							<DevCard profiles={profiles}/>
							</div>
						</div>
					</div>
				</div>


			<Footer/>
		</>
	)
};
const mapStateToProps = (state) => {
	const {profiles, roles} = state;
	return {profiles};
};
export const Dev = connect(mapStateToProps, {getProfileByProfileRoleId})(DevComponent);


