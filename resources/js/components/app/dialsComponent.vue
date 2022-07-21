<template>
    <div class="row justify-content-center clr">
        <div class="row justify-content-center">
            <div class="col-auto p-1">
                <span class="badge pr">Б <span> {{ fact.pr }} ({{ Math.round(plan.pr - fact.pr) < 0 ? 0 : Math.round(plan.pr - fact.pr) }})</span></span>
            </div>
            <div class="col-auto p-1">
                <span class="badge ft">Ж <span> {{ fact.ft }} ({{ Math.round(plan.ft - fact.ft) < 0 ? 0 : Math.round(plan.ft - fact.ft) }})</span></span>
            </div>
            <div class="col-auto p-1">
                <span class="badge cb">У <span> {{ fact.cb }} ({{ Math.round(plan.cb - fact.cb) < 0 ? 0 : Math.round(plan.cb - fact.cb) }})</span></span>
            </div>
            <div class="col-auto p-1">
                <span class="badge bg-light text-dark">Ккал <span> {{ fact.KKAL }} ({{ Math.round(plan.KKAL - fact.KKAL) < 0 ? 0 : Math.round(plan.KKAL - fact.KKAL) }})</span></span>
            </div>
        </div>
    </div>
    
    <div class="row justify-content-center">
        <div class="col p-0">
            <canvas id="cnvs" width="300" height="300"></canvas>
        </div>
    </div>
</template>

<script>
export default{
    data: () => {
        return {

        }
    },
    computed: {
        plan (){
            return {
                pr: this.$store.state.today.pr,
                ft: this.$store.state.today.ft,
                cb: this.$store.state.today.cb,
                KKAL: this.$store.state.today.kcal,
            }
        },
        fact (){
            return this.$store.getters.nutritions
        },
        percents (){
            return {
                pr: (this.fact.pr * 100) / this.plan.pr,
                ft: (this.fact.ft * 100) / this.plan.ft,
                cb: (this.fact.cb * 100) / this.plan.cb,
                KKAL: (this.fact.KKAL * 100) / this.plan.KKAL
            }
        }
    },
    watch: {
        percents (){
            let nutrients = {
            KKAL:{
                r: 123,
                radians: getRadians(getDegres(this.percents.KKAL)),
                bgColor: '#262626',
                color: '#f2f2f2'
            },
            pr: {
                r: 100,
                radians: getRadians(getDegres(this.percents.pr)),
                bgColor: '#320910',
                color: '#ed484f'
            },
            ft: {
                r: 77,
                radians:getRadians(getDegres(this.percents.ft)),
                bgColor: '#0b2100',
                color: '#a9f230'
            },
            cb: {
                r: 54,
                radians: getRadians(getDegres(this.percents.cb)),
                bgColor: '#092529',
                color: '#6aeede'
            }
        }
        var canvas = document.getElementById('cnvs');
        var ctx = canvas.getContext('2d');
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        draw(nutrients.KKAL)
        draw(nutrients.pr)
        draw(nutrients.ft)
        draw(nutrients.cb)
        }
    },
    mounted(){
        
    }
}
</script>

<style>

</style>