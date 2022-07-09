import { createStore } from 'vuex'

const store = createStore({
    state () {
      return {
        userName: null,
        date: new Date(),
      }
    },
    mutations: {
        addName(state, name){
          state.userName = name
        },
    },
    getters: {
        date (state){
            function padTo2Digits(num) {
            return num.toString().padStart(2, '0');
            }
            
            function formatDate(date) {
            return [
                padTo2Digits(date.getDate()),
                padTo2Digits(date.getMonth() + 1),
                date.getFullYear(),
            ].join('.');
            }
            return (formatDate(state.date))
        }
    }
  }
  )

  export default store;