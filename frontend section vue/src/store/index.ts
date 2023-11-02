import { createStore } from 'vuex'
import axios from 'axios';

axios.defaults.baseURL = "http://127.0.0.1:8000/api/v1"

export default createStore({
  state: {
    token: localStorage.getItem('access_token') || null,
  },

  getters: {
    loggedIn(state){
      return state.token !== null;
    },
    getToken: (state) => state.token,
  },

  mutations: {
    setToken(state, token){
      state.token = token
    },
    removeToken(state){
      state.token = null
    }
  },

  actions: {
    register(context, formData){
      return new Promise((resolve, reject)=>{
        axios.post('/register', {
          name: formData.name,
          email: formData.email,
          password: formData.password,
        }).then(res => {
            resolve(res.data)
        }).catch(error =>{
          reject(error)
        })
      })
    },

    login(context, credential){
      return new Promise((resolve, reject)=>{
        axios.post('/login', {
          email: credential.email,
          password: credential.password,
        }).then(res => {
            localStorage.setItem('Token', res.data.data.access_token)
            context.commit('setToken', res.data.data.access_token)
            resolve(res.data)
        }).catch(error =>{
          reject(error)
        })
      })
    },

    logout(context){
      axios.defaults.headers.common['Authorization'] ='Bearer' +context.state.token
      return new Promise((resolve, reject)=>{
        axios.post('/logout').then(res => {
            localStorage.removeItem('Token')
            context.commit('removeToken')
            resolve(res.data)
        }).catch(error =>{
          reject(error)
        })
      })
    },

    setToken({ commit }, token) {
      commit('setToken', token);
    },
    
  },

  modules: {}
})
