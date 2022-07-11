<template>
    <div class="clr">
        <notifications position="bottom right"/>

        <div class="input-group input-group-sm">
            <span class="input-group-text" id="inputGroup-sizing-sm">Вес</span>
            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" v-model="weight" @change="updateValue">
        </div>
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
        }
    },
    methods: {
        updateValue: function(){
            axios.post('/api/weight/update', {
                date: this.$store.getters.date,
                weight: this.weight
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

<style>

</style>