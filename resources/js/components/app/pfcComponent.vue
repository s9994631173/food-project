<template>
    <div class="clr">
        <notifications position="bottom right"/>
        <span class="badge rounded-pill bg-warning text-dark mb-2">План на день</span>
        
        <div class="input-group input-group-sm">
        <span class="input-group-text" id="inputGroup-sizing-sm">Б</span>
        <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" v-model="pr" @change="updateValue">
        <span class="input-group-text" id="inputGroup-sizing-sm">Ж</span>
        <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" v-model="ft" @change="updateValue">
        <span class="input-group-text" id="inputGroup-sizing-sm">У</span>
        <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" v-model="cb" @change="updateValue">
        <span class="input-group-text" id="inputGroup-sizing-sm">Ккал</span>
        <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" v-model="Kcal" @change="updateValue">
        </div>
    </div>
</template>

<script>
export default{
    data: () => {
        return{
            pr: 0,
            ft: 0,
            cb: 0,
            Kcal: 0
        }
    },
    computed: {
        refresh: function(){
            this.pr = this.$store.state.today.pr
            this.ft = this.$store.state.today.ft
            this.cb = this.$store.state.today.cb
            this.Kcal = this.$store.state.today.kcal
        }
    },
    methods: {
        updateValue: function(){
            axios.post('/api/pfc/update', {
                date: this.$store.getters.date,
                proteins: this.pr,
                fats: this.ft,
                carbohydrates: this.cb,
                KKAL: this.Kcal,
            })
            .catch(err => {
                this.$notify({
                text: err.response.data.message,
                type: 'error'
                });
            })
        }
    }
}
</script>