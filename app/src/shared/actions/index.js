
import {httpConfig} from "../misc/http-config";
export const getAllPostings = () => async dispatch => {
	const {data} = await httpConfig("/apis/job-posting/");
	dispatch({type: "GET_ALL_POSTINGS", payload: data})
};

export const getPostingByPostingId = (id) => async dispatch => {
	const {data} = await httpConfig(`/apis/job-posting/${id}`);
	dispatch({type: "GET_POSTING_BY_POSTING_PROFILE_ID", payload: data})
};

export const getPostingByPostingProfileId = (postingProfileId) => async dispatch => {
	const {data} = await httpConfig(`/apis/job-posting/${postingProfileId}`);
	dispatch({type: "GET_POSTING_BY_POSTING_ID", payload: data})
};

export const getPostingByPostingRoleId = (postingRoleId) => async dispatch => {
	const {data} = await httpConfig(`/apis/job-posting/${postingRoleId}`);
	dispatch({type: "GET_POSTING_BY_POSTING_ROLE_ID", payload: data})
};



export const getProfileByProfileId = (profileId) => async dispatch => {
	const {data} = await httpConfig(`/apis/profile/${profileId}`);
	dispatch({type: "GET_PROFILE_BY_PROFILE_ID", payload: data})
};

export const getProfileByProfileRoleId = (profileRoleId) => async dispatch => {
	const {data} = await httpConfig(`/apis/profile/${profileRoleId}`);
	dispatch({type: "GET_PROFILE_BY_PROFILE_ROLE_ID", payload: data})
};

export const getProfileByProfileEmail = (profileEmail) => async dispatch => {
	const {data} = await httpConfig(`/apis/profile/${profileEmail}`);
	dispatch({type: "GET_PROFILE_BY_PROFILE_EMAIL", payload: data})
};

export const getProfileByProfileUsername = (profileUsername) => async dispatch => {
	const {data} = await httpConfig(`/apis/profile/${profileUsername}`);
	dispatch({type: "GET_PROFILE_BY_PROFILE_USERNAME", payload: data})
};



export const getRoleByRoleId = (roleId) => async dispatch => {
	const {data} = await httpConfig(`/apis/role/${roleId}`);
	dispatch({type: "GET_ROLE_BY_ROLE_ID", payload: data})
};

export const getAllRoles = () => async dispatch => {
	const {data} = await httpConfig(`/apis/role/`);
	dispatch({type: "GET_ALL_ROLES", payload: data})
};
