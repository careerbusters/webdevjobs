export default (state = [], action) => {
	switch(action.type) {
		case "GET_ROLE_BY_ROLE_ID":
			return action.payload;
		case "GET_ALL_ROLES":
			return action.payload;
		default:
			return state;
	}
}