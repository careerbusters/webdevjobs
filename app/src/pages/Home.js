import React, {useEffect} from 'react';
import {LoginNavBar} from "../shared/components/Login-NavBar";
import "../index.css";
import {Footer} from "../shared/components/Footer";
import {getAllPostings} from "../shared/actions";
import {httpConfig} from "../shared/misc/http-config";
import {Carousel} from "../shared/components/carousel";
import {connect} from "react-redux";


const HomeComponent = ({getAllPostings}) => {
	useEffect(() => {
		httpConfig("/apis/earl-grey/");
		getAllPostings();
		},
		[]
	);
	return (
		<>
			<LoginNavBar>
			</LoginNavBar>
			<div id="home" className="col-lg-offset-4 bg-secondary">
				<div className="container d-flex justify-content-center text-content-center">
					<div id="jumbotron"
						  className="jumbotron p-5 mb-2 bg-transparent text-body text-align .bg-transparent">
						<div className="row">
							<h1 className="display-2 font-weight-bold">Web Dev Jobs</h1>
						</div>
					</div>
				</div>

			</div>
			<div className="container-fluid bg-secondary pb-5" id="1">
				<div className="row justify-content-center">
					<div className="col-sm-10 justify-content-center">
						<Carousel/>
						</div>
					</div>
				</div>

			<div className="container-fluid pt-5 pb-5 bg-secondary">
			<blockquote className="blockquote text-center">
				<p className="mb-0"><em>Welcome to Your Professional Web Dev Jobs Platform!</em></p>
			</blockquote>
			{/*Welcome Page Text*/}
			<blockquote className="blockquote text-center">
				<p className="mb-0"><em>If opportunity doesn't come knocking, build a website!</em></p>
			</blockquote>
			</div>
			<Footer/>
		</>
	)
};

const mapStateToProps = () => ({});
export const Home = connect(mapStateToProps, {getAllPostings})(HomeComponent);