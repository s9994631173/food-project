<template>
    <div class="clr">
        <notifications position="bottom right"/>
        <div>
            <span class="badge rounded-pill bg-warning text-dark mb-2">Вес</span>
        </div>
        <div class="input-group input-group-sm">
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
            return this.$store.state.today.weight
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