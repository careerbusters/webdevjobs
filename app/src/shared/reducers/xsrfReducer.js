export default (state = [], action) => {
	switch(action.type) {
		case "GET_XSRF":
			return action.payload;
		default:
			return state;
	}
}