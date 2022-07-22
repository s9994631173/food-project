<template>
<div class="container-sm">
    <div class="row justify-content-center vh-100">
    <div class="row justify-content-center">
        <div class="col gy-4">
            <div class="row justify-content-center">
                <div class="col text-center">
                    <Weight/>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 gy-3 text-center">
                    <Dials/>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col text-center">
                    <Line/>
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

export default{
    components: {
        Weight,
        PFC,
        Meal,
        Dials,
        Line
    }
}
</script>