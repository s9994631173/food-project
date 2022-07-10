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
          products: [],
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
        },
        update (state, obj){
          let produtsToday = state.today.products
          for (var i = 0; i<produtsToday.length; i++){
            if (produtsToday[i].id == obj.id) produtsToday[i] = obj
          }
        },
        remove (state, obj){
          let produtsToday = state.today.products
          for (var i = 0; i<produtsToday.length; i++){
            if (produtsToday[i].id == obj.id) produtsToday.splice(i, 1)
          }
        },
        new (state, obj){
          state.today.products.push(obj)
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
        },
        meals (state){
          let result = {
            breakfast: [],
            brunch: [],
            lunch: [],
            lunch2: [],
            dinner: [],
            dinner2: []
          }
          
          for (var i=0; i<state.today.products.length; i++){
            if (state.today.products[i].type == 'breakfast') result.breakfast.push(state.today.products[i])
            if (state.today.products[i].type == 'brunch') result.brunch.push(state.today.products[i])
            if (state.today.products[i].type == 'lunch') result.lunch.push(state.today.products[i])
            if (state.today.products[i].type == 'lunch2') result.lunch2.push(state.today.products[i])
            if (state.today.products[i].type == 'dinner') result.dinner.push(state.today.products[i])
            if (state.today.products[i].type == 'dinner2') result.dinner2.push(state.today.products[i])
          }

          return result
        }
    },
    actions: {
      getData(context){
        let dateToday = context.getters.date
        axios.post('/api/today', {
            date: dateToday
        })
        .then(response => {
            if (response.data.today.weight) context.commit('addWeight', response.data.today.weight)
            if (response.data.today.PFC) context.commit('addNutritions', response.data.today.PFC)
            if (response.data.today.products) context.commit('addProducts', response.data.today.products)
            context.commit('addWeek', response.data.week)
        })
      }
    }
  }
  )

  export default store;