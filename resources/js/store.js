import axios from 'axios';
import { createStore } from 'vuex'

const store = createStore({
    state () {
      return {
        userName: null,
        date: null,

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
          let obj = new Object
          for (var i=0; i<data.length; i++){
            obj[i] = data[i]
          }
          state.week = obj
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
        },
        setDate (state, payload){
          state.date = payload
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
        },
        nutritions (state){
          let result = {
            pr: 0,
            ft: 0,
            cb: 0,
            KKAL: 0
          }
          for (var i=0;i<state.today.products.length; i++){
            result.pr += Number(state.today.products[i].pr)
            result.ft += Number(state.today.products[i].ft)
            result.cb += Number(state.today.products[i].cb)
            result.KKAL += Number(state.today.products[i].KKAL)
          }
          result.pr = result.pr.toFixed(1)
          result.ft = result.ft.toFixed(1)
          result.cb = result.cb.toFixed(1)
          result.KKAL = result.KKAL.toFixed(1)
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
          let weight = response.data.today.weight ? response.data.today.weight : 0
          let PFC = response.data.today.PFC ? response.data.today.PFC : {
            proteins: 0,
            fats: 0,
            carbohydrates: 0,
            KKAL: 0
          }
          let products = response.data.today.products ? response.data.today.products : null
          let week = response.data.week ? response.data.week : null
          context.commit('addWeight', weight)
          context.commit('addNutritions', PFC)
          context.commit('addProducts', products)
          context.commit('addWeek', week)
        })
      }
    }
  }
  )

  export default store;