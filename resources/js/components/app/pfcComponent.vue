<template>
    <div class="input-group input-group-sm mb-3">
        <span class="input-group-text" id="inputGroup-sizing-sm">Б</span>
        <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" v-model="pr">
        <span class="input-group-text" id="inputGroup-sizing-sm">Ж</span>
        <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" v-model="ft">
        <span class="input-group-text" id="inputGroup-sizing-sm">У</span>
        <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" v-model="cb">
        <span class="input-group-text" id="inputGroup-sizing-sm">Ккал</span>
        <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" v-model="Kcal">
    </div>
</template>

<script>
export default{
    data: () => {
        return{
            pr: null,
            ft: null,
            cb: null,
            Kcal: null
        }
    },
    computed: {
        refresh: function(){
            this.pr = this.$store.state.today.pr
            this.ft = this.$store.state.today.ft
            this.cb = this.$store.state.today.cb
            this.Kcal = this.$store.state.today.kcal
        },
        updateValue: function(){
            axios.post('/api/pfc/update', {
                date: this.$store.getters.date,
                proteins: this.pr,
                fats: this.ft,
                carbohydrates: this.cb,
                KKAL: this.Kcal,
            })
            .then(() => this.errors = null)
            .catch(err => this.errors = err.response.data.message)
        }
    }
}
</script>