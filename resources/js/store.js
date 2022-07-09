import axios from 'axios';
import { createStore } from 'vuex'

const store = createStore({
    state () {
      return {
        userName: null,
        date: new Date(),

        today: {
          weight: null,
          pr: null,
          ft: null,
          cb: null,
          kcal: null,
          products: null,
        },
        week: null
      }
    },
    mutations: {
        addName(state, name){
          state.userName = name
        },
        addWeight (state, weight){
          state.today.weight = weight
        },
        addNutritions (state, obj){
          state.today.pr = obj.proteins
          state.today.ft = obj.fats
          state.today.cb = obj.carbohydrates
          state.today.kcal = obj.KKAL
        },
        addProducts (state, array){
          state.today.products = array
        },
        addWeek (state, data){
          state.week = data
        }
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