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
            </div>
            <div class="col gy-4">
                <div class="row justify-content-center">
                    <div class="col-2 clr">
                        <Weight/>
                    </div>
                    <div class="col-5 clr">
                        <PFC/>
                    </div>
                </div>
                <div class="row">
                    <div class="row">
                        <div class="col gy-3 clr">Завтрак</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Weight from './app/weightComponent.vue'
import PFC from './app/pfcComponent.vue'

export default{
    components: {
        Weight,
        PFC
    },
    mounted (){
        let dateToday = this.$store.getters.date
        axios.post('/api/today', {
            date: dateToday
        })
        .then(response => {
            this.$store.commit('addWeight', response.data.today.weight)
            this.$store.commit('addNutritions', response.data.today.PFC)
            this.$store.commit('addProducts', response.data.today.products)
            this.$store.commit('addWeek', response.data.week)
        })
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
    }
</style>