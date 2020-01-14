import axios from "axios";
import { SET_USER_SUCCESS, SET_USER_FAILURE, SET_USER_START } from "../mutations-type";
import { LOGIN_USER } from "../action-types";

export const userModule = {
    state: {
        isAuthenticated: false,
        data: {},
        error: "",
    },
    mutations: {
        [SET_USER_SUCCESS](state, payload) {
            state.user = {...state, isAuthenticated: true, data: {...payload}};
        },
        [SET_USER_FAILURE](state, error) {
            state.user = {...state, isAuthenticated: false, error}
        },
        [SET_USER_START](state) {
            state.user = {...state.user}
        }
    },
    actions: {},
    getters: {
        getUser: state => state.user

    },
    setters: {},

}

