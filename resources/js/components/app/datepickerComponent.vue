<template>
<div class="row">
    <div class="col-auto">
        <h1 class="display-5 fw-bold">{{ week }}</h1>
    </div>
</div>
<div class="row" v-click-away="onClickAway">
    <div class="col-auto">
        <span class="chngDate text-white-50" @click="show = !show"> {{ date.toLocaleString('ru', {year: 'numeric', month: 'long', day: 'numeric'}) }} </span>
    </div>
    <div class="col-auto position-absolute" v-show="show" style="z-index: 10;">
        <Calendar v-model="date" is-dark/>
    </div>
</div>

</template>

<script>
export default{
    data: () => {
        return {
            show: false,
            date: new Date()
        }
    },
    computed: {
        week (){
            var days = [
            'Воскресенье',
            'Понедельник',
            'Вторник',
            'Среда',
            'Четверг',
            'Пятница',
            'Суббота'
            ];
            return days[this.date.getDay()]
        }
    },
    methods: {
        onClickAway (){
            this.show = false
        }
    },
    watch: {
        date (){
            this.$store.commit('setDate', this.date)
            this.$store.dispatch('getData')
            this.show = false
        }
    },
}
</script>

<style>
.chngDate {
    cursor: pointer;
}
</style>