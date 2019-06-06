import {combineReducers} from "redux"
import profileReducer from "./profileReducer";
import roleReducer from "./roleReducer";
import postingReducer from "./postingReducer";



export default combineReducers({
	profile: profileReducer,
	role: roleReducer,
	posting: postingReducer,
})