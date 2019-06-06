import React from 'react';
import ReactDOM from 'react-dom'
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap/dist/js/bootstrap.bundle.min';
import {BrowserRouter} from "react-router-dom";
import {Route, Switch} from "react-router";
import {library} from '@fortawesome/fontawesome-svg-core'
import {faUser, faSignOutAlt, faPencilAlt} from '@fortawesome/free-solid-svg-icons'

import {FourOhFour} from "./pages/FourOhFour";
import {NavBar} from "./shared/components/NavBar";
import reducers from "./shared/reducers";
import {applyMiddleware, createStore} from "redux";
import thunk from "redux-thunk";




const App = () => ( <h1 className="text-info">hello world</h1> );


const Routing = (store) => (
<>

			<NavBar/>
			<Switch>
				<Route exact path="/" component={NavBar}/>
				<Route component={FourOhFour}/>
			</Switch>

</>
);

ReactDOM.render(<App/>, document.querySelector('#root'));