import { createStore } from 'vuex'

const store = createStore({


    state: {
        //define variables
        token : localStorage.getItem('token') || 0,
        email : localStorage.getItem('email') || 0
    },

    mutations:{
        // update variable value
        UPDATE_TOKEN(state,payload){
            state.token = payload
        },
        UPDATE_EMAIL(state,payload){
            state.email = payload
        }
    },

    actions:{
        // action to be performed
        setToken(context,payload){
            localStorage.setItem('token',payload)
            context.commit('UPDATE_TOKEN',payload)
        },
        setEmail(context,payload){
            localStorage.setItem('email',payload)
            context.commit('UPDATE_EMAIL',payload)
        },
        removeToken(context){
            localStorage.removeItem('token');
            context.commit('UPDATE_TOKEN', 0);
        }
    },

    getters:{
        // get state variable value
        getToken: function(state){
            return state.token
        },
        getEmail: function(state){
            return state.email
        }
    }

})

export default store;
