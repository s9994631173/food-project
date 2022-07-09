<template>
    <div class="input-group input-group-sm mb-3">
        <div class="form-floating" v-if="errors">
            <div class="text-danger"> {{ errors }} </div>
        </div>

        <span class="input-group-text" id="inputGroup-sizing-sm">Вес</span>
        <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" v-model="weight">
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
            this.weight = this.$store.state.today.weight
        },
        updateValue: function(){
            axios.post('/api/weight/update', {
                date: this.$store.getters.date,
                weight: this.weight
            })
            .then(() => this.errors = null)
            .catch(err => this.errors = err.response.data.message)
        }
    }
}
</script>

<style>

</style>