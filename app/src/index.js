import React from 'react';
import ReactDOM from 'react-dom'
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap/dist/js/bootstrap.bundle.min';
import {BrowserRouter} from "react-router-dom";
import {Route, Switch} from "react-router";
import {library} from '@fortawesome/fontawesome-svg-core'
import {faUser, faSignOutAlt, faPencilAlt, faHome} from '@fortawesome/free-solid-svg-icons'
import {Home} from "./shared/components/Home";
import {FourOhFour} from "./pages/FourOhFour";
// import "./index.css";
import reducers from "./shared/reducers";
import {applyMiddleware, createStore} from "redux";
import thunk from "redux-thunk";
import {Provider} from "react-redux";
import {NavBar} from "./shared/components/NavBar";


library.add(faUser, faSignOutAlt, faPencilAlt, faHome);

const store = createStore(reducers, applyMiddleware(thunk));

const Routing = (store) => (

	<>
		<Provider store={store}>
			<BrowserRouter>
				<NavBar/>
				<Switch>
					{/*<Route exact path="/posts" component={Posts}/>*/}
					<Route exact path="/" component={Home}/>
					<Route component={FourOhFour}/>
				</Switch>
			</BrowserRouter>
		</Provider>
	</>
);


ReactDOM.render(Routing(store), document.querySelector('#root'));



