<template>
    <notifications position="bottom right"/>
    <div class="input-group input-group-sm clr">
    <span class="input-group-text fw-bold" id="inputGroup-sizing-sm">Вес</span>
    <input type="text" class="form-control" aria-describedby="inputGroup-sizing-sm" v-model="weight" @change="updateValue">
</div>
</template>

<script>
export default{
    data (){
        return {
            weight: null,
            errors: null
        }
    },
    computed: {
        refresh: function(){
            return this.$store.state.today.weight
        }
    },
    methods: {
        updateValue: function(){
            axios.post('/api/weight/update', {
                date: this.$store.getters.date,
                weight: this.weight
            })
            .then(() => {
                this.$store.commit('addWeight', this.weight)
            })
            .catch(err => {
                this.$notify({
                text: err.response.data.message,
                type: 'error'
                });
            })
        }
    },
    watch: {
        refresh (){
            this.weight = this.refresh
        }
    }
}
</script>

<style>

</style>