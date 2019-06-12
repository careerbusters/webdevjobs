import {combineReducers} from "redux"
import profileReducer from "./profileReducer";
import roleReducer from "./roleReducer";
import postingReducer from "./postingReducer";



export default combineReducers({
	profiles: profileReducer,
	roles: roleReducer,
	posting: postingReducer,
})