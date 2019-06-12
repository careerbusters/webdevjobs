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
							<h5 className="card-title text-left mt-1">Pay: {index.postingPay}</h5>
							<p className="card-text">{`${index.postingContent}`}</p>
						</div>
						<div className="card-footer text-muted">
							{`${index.postingLocation}`}
						</div>
					</div>
				)
			})
			}
		</>
	)

};

export const JobCard = (JobCardComponent);