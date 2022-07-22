<template>
<div class="row text-center">
    <div class="col gy-3">
        <span class="btnMeal" @click="breakfast = !breakfast" :class="{'clr-button': breakfast}">Завтрак</span>
    </div>
    <div class="col gy-3">
        <span class="btnMeal" @click="brunch = !brunch" :class="{'clr-button': brunch}">Бранч</span>
    </div>
    <div class="col gy-3">
        <span class="btnMeal" @click="lunch = !lunch" :class="{'clr-button': lunch}">Обед</span>
    </div>
    <div class="col gy-3">
        <span class="btnMeal" @click="lunch2 = !lunch2" :class="{'clr-button': lunch2}">Перекус</span>
    </div>
    <div class="col gy-3">
        <span class="btnMeal" @click="dinner = !dinner" :class="{'clr-button': dinner}">Ужин</span>
    </div>
    <div class="col gy-3">
        <span class="btnMeal" @click="dinner2 = !dinner2" :class="{'clr-button': dinner2}">Ужин 2</span>
    </div>
    <div class="col gy-3">
        <span class="btnMeal text-white-50" @click="all">все</span>
    </div>
</div>

<div class="row text-start">
    <div class="row" v-if="breakfast">
        <div class="col gy-3 clr">
            <Meal :title="{name: 'Завтрак', title: 'breakfast'}"/>
        </div>
    </div>
    <div class="row" v-if="brunch">
        <div class="col gy-3 clr">
            <Meal :title="{name: 'Бранч', title: 'brunch'}"/>
        </div>
    </div>
    <div class="row" v-if="lunch">
        <div class="col gy-3 clr">
            <Meal :title="{name: 'Обед', title: 'lunch'}"/>
        </div>
    </div>
    <div class="row" v-if="lunch2">
        <div class="col gy-3 clr">
            <Meal :title="{name: 'Перекус', title: 'lunch2'}"/>
        </div>
    </div>
    <div class="row" v-if="dinner">
        <div class="col gy-3 clr">
            <Meal :title="{name: 'Ужин', title: 'dinner'}"/>
        </div>
    </div>
    <div class="row" v-if="dinner2">
        <div class="col gy-3 clr">
            <Meal :title="{name: 'Ужин 2', title: 'dinner2'}"/>
        </div>
    </div>
</div>
</template>

<script>
import Meal from './mealComponent.vue'
export default{
    data: () => {
        return{
            breakfast: true,
            brunch: false,
            lunch: false,
            lunch2: false,
            dinner: false,
            dinner2: false
        }
    },
    components: {
        Meal
    },
    methods: {
        all() {
            this.breakfast = true
            this.brunch = true
            this.lunch = true
            this.lunch2 = true
            this.dinner = true
            this.dinner2 = true
        }
    }
}
</script>