import {combineReducers} from "redux"
import profileReducer from "./profileReducer";
import roleReducer from "./roleReducer";
import postingReducer from "./postingReducer";
import savedJobReducer from "./savedJobsReducer";



export default combineReducers({
	profile: profileReducer,
	role: roleReducer,
	posting: postingReducer,
	savedJob: savedJobReducer,
})