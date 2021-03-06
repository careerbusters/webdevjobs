export default (state = [], action) => {
	switch(action.type) {
		case "GET_PROFILE_BY_PROFILE_ID":
			return action.payload;
		case "GET_PROFILE_BY_PROFILE_ROLE_ID":
			return action.payload;
		case "GET_PROFILE_BY_PROFILE_EMAIL":
			return action.payload;
		case "GET_PROFILE_BY_PROFILE_USERNAME":
			return action.payload;
		default:
			return state;
	}
}