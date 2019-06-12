import React, {useEffect} from 'react';
import {getAllPostings} from "../shared/actions/";
import {connect} from "react-redux";
import {NavBar} from "../shared/components/NavBar";
import {Footer} from "../shared/components/Footer";
import {JobCard} from "../shared/components/jobCard";
import {httpConfig} from "../shared/misc/http-config";


const JobsComponent = ({posting, getAllPostings}) => {
	useEffect(() => {
			getAllPostings();
		},
		[getAllPostings]
	);
	return (
		<>
			<NavBar/>
			<body className="bg-secondary pb-5 ">
				<div className="container text-center">
					<div id="jumbotron"
						  className="jumbotron p-3 mb-2 bg-transparent text-body text-align .bg-transparent">
						<div className="row justify-content-center">
							<h1 className="display-2 font-weight-bold a">Job Postings</h1>
						</div>
					</div>
				</div>
				<section>
					<div className="container bg-dark mb-5 p-5">
						<div className="row justify-content-center my-5">
							<div className="col-lg-9">
								<JobCard postings={posting}/>
							</div>
						</div>
					</div>
				</section>
			</body>
			<Footer/>
		</>
	)
};

const mapStateToProps = ({posting}) => {
	return {posting};
};
export const Jobs = connect(mapStateToProps, {getAllPostings})(JobsComponent);

