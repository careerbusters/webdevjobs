import React from 'react';
import ReactDOM from 'react-dom'
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap/dist/js/bootstrap.bundle.min';
import {BrowserRouter} from "react-router-dom";
import {Route, Switch} from "react-router";
import {library} from '@fortawesome/fontawesome-svg-core'
import {Home} from "./pages/Home";
import {FourOhFour} from "./pages/FourOhFour";
import "./index.css";
import reducers from "./shared/reducers";
import {applyMiddleware, createStore} from "redux";
import thunk from "redux-thunk";
import {Provider} from "react-redux";
import {SignUp} from "./pages/Sign-up";
import {Login} from "./pages/Login";
import {NavBar} from "./shared/components/NavBar";
import {SignUpForm} from "./shared/components/sign-up/SignUpForm";
import {faUser, faLocation, faUserAlt, faSignOutAlt, faPencilAlt, faEnvelope, faLock, faImage, faGlasses, faBookReader, faHome, faBriefcase, faThumbtack} from "@fortawesome/free-solid-svg-icons/";
import {DevPage} from "./pages/Dev";
import {Jobs} from "./pages/Jobs";




library.add(faUser, faUserAlt, faSignOutAlt, faPencilAlt, faEnvelope, faLock, faImage, faGlasses, faBookReader, faHome, faBriefcase, faThumbtack);

const store = createStore(reducers, applyMiddleware(thunk));

const Routing = (store) => (

	<>
		<Provider store={store}>
			<BrowserRouter>
				<Switch>
					<Route exact path="/signup" component={SignUp}/>
					<Route exact path="/devpage" component={DevPage}/>
					<Route exact path="/jobs" component={Jobs}/>
					<Route exact path="/login" component={Login}/>
					<Route exact path="/" component={Home}/>
					<Route component={FourOhFour}/>
				</Switch>
			</BrowserRouter>
		</Provider>
	</>
);


ReactDOM.render(Routing(store), document.querySelector('#root'));



