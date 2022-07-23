<template>
        <header>
            <div class="container-fluid">
                <div class="row justify-content-end">
                    <div class="col-auto">
                        <Header/>
                    </div>
                </div>
            </div>
        </header>

        <section>
            <div class="container px-4">
                <div class="row gy-2">
                    <div class="col-xl-6 col-md-9 col-6">
                        <Datepicker/>
                    </div>
                    <div class="col-xl-2 col-md-3 col-6 align-self-end">
                        <Weight/>
                    </div>
                    <div class="col-xl-4 col-md- align-self-end">
                        <PFC/>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container px-4">
                <div class="row">
                    <div class="col-xl-4 gy-3">
                        <div class="row justify-content-center gx-5">
                            <div class="col col-md-6 col-xl-12 text-center">
                                <Dials/>
                            </div>
                            <div class="col col-md-6 col-xl-12 text-center">
                                <Line/>
                            </div>
                        </div>
                    </div>
                    <div class="col gy-3">
                        <div class="p-1">
                            <Meal :title="{name: 'Завтрак', title: 'breakfast'}"/>
                        </div>
                        <div class="p-1">
                            <Meal :title="{name: 'Бранч', title: 'brunch'}"/>
                        </div>
                        <div class="p-1">
                            <Meal :title="{name: 'Обед', title: 'lunch'}"/>
                        </div>
                        <div class="p-1">
                            <Meal :title="{name: 'Перекус', title: 'lunch2'}"/>
                        </div>
                        <div class="p-1">
                            <Meal :title="{name: 'Ужин', title: 'dinner'}"/>
                        </div>
                        <div class="p-1">
                            <Meal :title="{name: 'Ужин 2', title: 'dinner2'}"/>
                        </div>
                    </div>
                </div>
            </div>
        </section>
</template>

<script>
import Header from './app/headerComponent.vue'
import Datepicker from './app/datepickerComponent.vue'

import Meal from './app/foods/mealComponent.vue'

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
        Meal
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
            this.$router.push('/app')
        })
        .catch(() => this.$router.push('/login'))

    }
}
</script>

<style>
INPUT::placeholder {
    color: #484848 !important;
}
</style>