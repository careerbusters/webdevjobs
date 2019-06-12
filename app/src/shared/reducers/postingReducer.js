export default (state = [], action) => {
	console.log(action);
	switch(action.type) {
		case "GET_ALL_POSTINGS":
			return action.payload;
		case "GET_POSTING_BY_POSTING_ID":
			return action.payload;
		case "GET_POSTING_BY_POSTING_PROFILE_ID":
			return action.payload;
		case "GET_POSTING_BY_POSTING_ROLE_ID":
			return action.payload;
		default:
			return state;
	}
}