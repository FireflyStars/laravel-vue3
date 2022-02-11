import { createStore } from 'vuex'
import { LOGIN, LOGOUT } from './mutation_types'
import subject from './subject'
import { useCookies } from "vue3-cookies";
const { cookies } = useCookies();

const store = createStore({
    modules: {
        subject: subject,
    },
    state: {
        userInfo: null
    },
    mutations: {
        // we can use the ES2015 computed property name feature
        // to use a constant as the function name
        [LOGIN] (state, userInfo) {
            cookies.set('userInfo', userInfo);
            state.userInfo = userInfo;
        },
        [LOGOUT] (state) {
            cookies.remove('userInfo');
            state.userInfo = null
        },
    },
    actions: {
        LOGIN ( context, userInfo ) {
            context.commit('LOGIN', userInfo)
        },
        LOGOUT ( context ) {
            context.commit('LOGOUT')
        },
    },
    getters:{
        getUserInfo (state) {
            return state.userInfo
        }
    }
})

export default store;