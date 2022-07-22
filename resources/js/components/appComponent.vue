<template>
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-auto">
                <Header/>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <Datepicker/>
            </div>
            <div class="col-2 align-self-end">
                <Weight/>
            </div>
            <div class="col-4 align-self-end">
                <PFC/>
            </div>
        </div>
        <div class="row">
            <div class="col-3 gy-3">
                <div class="row justify-content-center">
                    <div class="col-auto text-center">
                        <Dials/>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-auto text-center">
                        <Line/>
                    </div>
                </div>
            </div>
            <div class="col gy-2">
                <div class="row text-center justify-content-end">
                    <SelectMeal/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Header from './app/headerComponent.vue'
import Datepicker from './app/datepickerComponent.vue'
import SelectMeal from './app/foods/selectmealComponent.vue'

import Weight from './app/weightComponent.vue'
import PFC from './app/pfcComponent.vue'

import Dials from './app/dialsComponent.vue'
import Line from './app/lineComponent.vue'

import Mobile from './mobileComponent.vue'

export default{
    components: {
        Weight,
        PFC,
        Dials,
        Line,
        Mobile,
        Header,
        Datepicker,
        SelectMeal
    },
    data: () => {
        return{
            date: new Date(),
        }
    },
    computed:{
        boxSize (){
            return {
                width: document.documentElement.scrollWidth,
                height: document.documentElement.scrollHeight
            }
        }
    },
    methods: {

    },
    mounted (){
        axios.post('/api/checkLogin')
        .then(response => {
            this.$store.commit('setDate', this.date)
            this.$store.commit('addName', response.data.name)

            this.$store.commit('setDate', this.date)
            this.$store.dispatch('getData')
        })
        .then(() => this.$router.push('/app'))
        .catch(() => this.$router.push('/login'))

    }
}
</script>

<style>
INPUT::placeholder {
    color: #484848 !important;
}
</style>