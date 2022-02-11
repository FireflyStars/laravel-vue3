
import { SetUserSubject } from './mutation_types';

const subject = {
    state: () => ({
      subjects: []
    }),
    mutations: {
        [SetUserSubject] (state, subjects){
            state.subjects = subjects;
        }
    },
    actions : {
        SetUserSubject(context, subjects){
            context.commit('SetUserSubject', subjects);
        }
    },
    getters: {
      getSubject (state) {
        return state.subjects
      }
    },

  }
  export default subject;