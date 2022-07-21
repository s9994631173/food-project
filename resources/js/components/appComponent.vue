<template>
    <div class="container-fluid">
        <div class="row justify-content-center" v-if="boxSize.width < 600">
            <Mobile/>
        </div>
        <div class="row " v-else>
            <div class="col-3 gy-4">
                <div class="row justify-content-center">
                    <div class="col-10 text-center">
                        <Dials/>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-10 text-center">
                        <Line/>
                    </div>
                </div>
                <div class="row text-center justify-content-center">
                    <div class="col-10 gy-3">
                        <Calendar v-model="date" is-dark/>
                    </div>
                </div>
            </div>
            <div class="col-9 gy-4">
                <div class="row justify-content-center">
                    <div class="col-2">
                        <Weight/>
                    </div>
                    <div class="col-5">
                        <PFC/>
                    </div>
                </div>
                <div class="row">
                    <div class="row">
                        <div class="col gy-3 clr">
                            <Meal :title="{name: 'Завтрак', title: 'breakfast'}"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col gy-3 clr">
                            <Meal :title="{name: 'Бранч', title: 'brunch'}"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col gy-3 clr">
                            <Meal :title="{name: 'Обед', title: 'lunch'}"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col gy-3 clr">
                            <Meal :title="{name: 'Перекус', title: 'lunch2'}"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col gy-3 clr">
                            <Meal :title="{name: 'Ужин', title: 'dinner'}"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col gy-3 clr">
                            <Meal :title="{name: 'Чтоб крепче спалось', title: 'dinner2'}"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Weight from './app/weightComponent.vue'
import PFC from './app/pfcComponent.vue'

import Meal from './app/foods/mealComponent.vue'

import Dials from './app/dialsComponent.vue'
import Line from './app/lineComponent.vue'

import Mobile from './mobileComponent.vue'

export default{
    components: {
        Weight,
        PFC,
        Meal,
        Dials,
        Line,
        Mobile
    },
    data: () => {
        return{
            date: new Date(),
        }
    },
    computed:{
        boxSize (){
            return {
                width: window.screen.width,
                height: window.screen.height
            }
        }
    },
    methods: {

    },
    watch: {
        date (){
            this.$store.commit('setDate', this.date)
            this.$store.dispatch('getData')
        }
    },
    mounted (){
        axios.post('/api/checkLogin')
        .then(() => {
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
    .clr{
        background: #1a202c !important;
        border-radius: 20px;
        padding: 10px 20px;
    }
</style>