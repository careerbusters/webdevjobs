import React, {useEffect} from "react";
import {JobCard} from "./jobCard";
import {connect} from "react-redux";
import {getAllPostings} from "../actions/";


const CarouselComponent = ({posting}) => {

	console.log(posting);
	return (
		<>
			<div id="carousel" className=" carousel slide justify-content-center center-content  height=500 width=900"
				  data-ride="carousel">
				<div className="justify-content-center center-content carousel-inner height=500 width=900">
					<div className="justify-content-center center-content carousel-item active">
						<JobCard postings={posting}/>
					</div>
				</div>
				<a className="carousel-control-prev" href="#carouselExampleControls" role="button"
					data-slide="prev">
					<span className="carousel-control-prev-icon" aria-hidden="true"></span>
					<span className="sr-only">Previous</span>
				</a>
				<a className="carousel-control-next" href="#carouselExampleControls" role="button"
					data-slide="next">
					<span className="carousel-control-next-icon" aria-hidden="true"></span>
					<span className="sr-only">Next</span>
				</a>
			</div>
		</>
	)
};

const mapStateToProps = ({posting}) => {
	return {posting};
};

export const Carousel = connect(mapStateToProps)(CarouselComponent);