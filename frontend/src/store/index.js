import Vue from 'vue'
import Vuex from 'vuex'
import repository from '../api/repository';

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    user: localStorage.user ? JSON.parse(localStorage.getItem('user')) : null,
    token: localStorage.user ? localStorage.getItem('token') : null
  },
  mutations: {
    SET_USER(state, data){
      state.user = data.user;
      state.token = data.token;

      localStorage.user = JSON.stringify(data.user);
      localStorage.token = data.token;
    },
    SET_LOGOUT_USER(state){
      state.user = null;
      state.token = null;

      localStorage.removeItem('user');
      localStorage.removeItem('token');
    }
  },
  actions: {
    async login({commit}, user){
      await repository.createSession();
      const {data} = await repository.login(user);
      commit('SET_USER', data);
    },
    async logout({commit}){
      await repository.logout();
      commit('SET_LOGOUT_USER'); 
    }
  },
  getters:{
    user: state => state.user,
    authenticated: state => state.user !== null
  }
})
