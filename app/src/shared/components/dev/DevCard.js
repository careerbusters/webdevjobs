import React from "react";
import {connect} from "react-redux";


const DevCardComponent = ({profiles}) => {
	console.log(profiles);

	return (
		<>
			{profiles.map( index => {
				return (
					<div key={index.profileId} className="card text-center my-5">
						<div className="card-header justify-content-left">
							{`${index.profileUsername}`}
						</div>

						<div className="card-body">
							<h5 className="card-text">{`${index.profileBio}`}</h5>
							<p className="card-title text-center mt-3">Email: {index.profileEmail}</p>
						</div>
						<div className="card-footer text-muted">
							{`${index.profileLocation}`}
						</div>
					</div>
				)
			})
			}
			</>
	)
			};

export const DevCard = (DevCardComponent);