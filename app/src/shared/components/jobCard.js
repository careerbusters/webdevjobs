import React from "react";

const JobCardComponent = ({postings}) => {
	 console.log(postings);


	return (
		<>
			{postings.map( index => {
				return(
					<div key={index.postingId} className="card text-center my-5">
						<div className="card-header justify-content-left">
							{`${index.postingTitle} - ${index.postingCompanyName}`}
						</div>
						<div className="card-body">
							<h5 className="card-title text-left mt-1">{`${index.postingDate} apply until ${index.postingEndDate}`}</h5>
							<p className="card-text">I am web dev, I go code code code. I am web dev, I go code code code. I am
								web
								dev, I go code code code. I am web dev, I go code code code.</p>
						</div>
						<div className="card-footer text-muted">
							Albuquerque, New Mexico
						</div>
					</div>
				)
			})
			}
		</>
	)

};

export const JobCard = (JobCardComponent);