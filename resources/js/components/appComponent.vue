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
                    <div class="col-2">
                        <Weight/>
                    </div>
                    <div class="col-5 ms-auto">
                        <PFC/>
                    </div>
                </div>
                <div class="row">
                    <div class="row">
                        <div class="col gy-3 clr">
                            <Breakfast/>
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

import Breakfast from './app/foods/breakfastComponent.vue'

export default{
    components: {
        Weight,
        PFC,
        Breakfast
    },
    data: () => {
        return{
            r: []
        }
    },
    mounted (){
        this.$store.dispatch('getData')
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