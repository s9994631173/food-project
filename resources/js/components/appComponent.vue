<template>
    <div class="container">
        <div class="row">
            <div class="col-4 gy-4">
                <div class="row">
                    <div class="col-10 clr">Круги</div>
                </div>
                <div class="row">
                    <div class="col-10 gy-3 clr">График</div>
                </div>
                <div class="row text-center">
                    <div class="col-10 gy-3 clr">
                        <Calendar v-model="date"/>
                    </div>
                </div>
            </div>
            <div class="col gy-4">
                <div class="row justify-content-start">
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

export default{
    components: {
        Weight,
        PFC,
        Meal
    },
    data: () => {
        return{
            date: new Date(),
        }
    },
    computed:{

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

    }
}
</script>

<style>
    BODY{
        background: #202327;
        color: #d8d8d8;
    }
    .clr{
        background: #292c31 !important;
        border-radius: 20px;
        padding: 10px 20px;
    }
</style>