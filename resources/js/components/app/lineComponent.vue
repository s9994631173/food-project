<template>
    <div class="row justify-content-center text-center">
        <div class="col clr p-1">
             <span class="badge rounded-pill bg-secondary" style="background: #1a202c !important; ">Колебания веса</span>
        </div>
    </div>
    <div class="row justify-content-center text-center">
        <div class="col p-0">
            <canvas id="cnvsLine" width="300" height="140"></canvas>
        </div>
    </div>
</template>

<script>
export default{
    computed: {
        week (){
            let obj = this.$store.state.week

            let arr = []
            for (var key in obj){
                arr.push([obj[key].date, Number(obj[key].weight)])
            }
            arr.unshift(['today', Number(this.$store.state.today.weight)])
            
            let result = 0
            for (var i=0; i<arr.length; i++){
                if (arr[i][1] > result) result = arr[i][1]
            }

            for (var i=0; i<arr.length; i++){
                let y = Math.round(110 - ((arr[i][1] * 100) / result))
                y = y < 1 ? 1 : y
                arr[i].push(y)
            }
            return arr
        }
    },
    watch: {
        week (){
            var canvas = document.getElementById('cnvsLine');
            var ctx = canvas.getContext('2d');
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            
            drawLine(this.week)
			
        }
    }
}
</script>