<template>
<div>
    <div class="d-flex">
        <div class="flex-grow-1 p-1">
            <span class="badge rounded-pill bg-warning text-dark mb-2">Завтрак</span>
        </div>
        <div class="p-1">
            <span class="badge bg-danger">Б <span> {{ nutritions.pr }} </span></span>
        </div>
        <div class="p-1">
            <span class="badge bg-success">Ж <span> {{ nutritions.ft }} </span></span>
        </div>
        <div class="p-1">
            <span class="badge bg-primary">У <span> {{ nutritions.cb }} </span></span>
        </div>
        <div class="p-1">
            <span class="badge bg-light text-dark">Ккал <span> {{ nutritions.KKAL }} </span></span>
        </div>
    </div>
    <div class="row g-3">
        <div class="col">
            <input type="text" class="form-control form-control-sm mb-2" placeholder="Добавить продукт" v-model="newProduct.product">
        </div>
        <div class="col-6">
            <div class="input-group input-group-sm">
                <div class="input-group-text">Гр.</div>
                <input type="text" class="form-control form-control-sm" id="autoSizingInputGroup" v-model="newProduct.weight">
                <div class="input-group-text">Б</div>
                <input type="text" class="form-control form-control-sm" id="autoSizingInputGroup" v-model="newProduct.pr">
                <div class="input-group-text">Ж</div>
                <input type="text" class="form-control form-control-sm" id="autoSizingInputGroup" v-model="newProduct.ft">
                <div class="input-group-text">У</div>
                <input type="text" class="form-control form-control-sm" id="autoSizingInputGroup" v-model="newProduct.cb">
                <div class="input-group-text">ККАЛ</div>
                <input type="text" class="form-control form-control-sm" id="autoSizingInputGroup" v-model="newProduct.KKAL">
            </div>
        </div>
        <div class="col-auto">
            <button type="button" class="btn btn-outline-success btn-sm" @click="addProduct"> 💪🏽 </button>
        </div>
    </div>
    <div class="row g-3" v-for="(item, index) in getMeal" :key="index">
        <div class="col">
            <input type="text" class="form-control form-control-sm mb-2" placeholder="" v-model="item.product" @change="update(index)">
        </div>
        <div class="col-6">
            <div class="input-group input-group-sm">
                <div class="input-group-text">Гр.</div>
                <input type="text" class="form-control form-control-sm" id="autoSizingInputGroup" v-model="item.weight" @change="update(index)" @input="calc(index)">
                <div class="input-group-text">Б</div>
                <input type="text" class="form-control form-control-sm" id="autoSizingInputGroup" v-model="item.pr" @change="update(index)">
                <div class="input-group-text">Ж</div>
                <input type="text" class="form-control form-control-sm" id="autoSizingInputGroup" v-model="item.ft" @change="update(index)">
                <div class="input-group-text">У</div>
                <input type="text" class="form-control form-control-sm" id="autoSizingInputGroup" v-model="item.cb" @change="update(index)">
                <div class="input-group-text">ККАЛ</div>
                <input type="text" class="form-control form-control-sm" id="autoSizingInputGroup" v-model="item.KKAL" @change="update(index)">
            </div>
        </div>
        <div class="col-auto">
            <button type="button" class="btn btn-outline-danger btn-sm" @click="deleteProduct(index)"> 👋🏾 </button>
        </div>
    </div>
</div>
</template>

<script>
export default{
    data () {
        return {
            newProduct: {
                product: null,
                weight: 100,
                pr: null,
                ft: null,
                cb: null,
                KKAL: null,
                type: 'breakfast'
            }
        }
    },
    computed: {
        getMeal: function(){
            return _.cloneDeep(this.$store.getters.meals.breakfast)
        },
        nutritions: function(){
            let result = {
                pr: 0,
                ft: 0,
                cb: 0,
                KKAL: 0
            }

            for (var i=0; i<this.getMeal.length; i++){
                result.pr += Number(this.getMeal[i].pr)
                result.ft += Number(this.getMeal[i].ft)
                result.cb += Number(this.getMeal[i].cb)
                result.KKAL += Number(this.getMeal[i].KKAL)
            }
            return result
        },
        date: function(){
            return this.$store.getters.date
        }
    },
    methods: {
        addProduct: function(){
            axios.post('/api/products/new', {
                ...this.newProduct,
                date: this.date
            })
            .then((response) => {
                this.$store.commit('new', response.data)
                this.newProduct.product = null
                this.newProduct.weight = null
                this.newProduct.pr = null
                this.newProduct.ft = null
                this.newProduct.cb = null
                this.newProduct.KKAL = null
            })
            .catch(err => console.log(err.response.data))
        },
        deleteProduct: function(index){
            axios.post('/api/products/delete', {
                ...this.getMeal[index],
                date: this.date
            })
            .then(() => {
                this.$store.commit('remove', this.getMeal[index])
            })
            .catch(err => console.log(err.response.data))
        },
        update: function(index){
            axios.post('/api/products/update', {
                ...this.getMeal[index],
                date: this.date
            })
            .then(() => {
                this.$store.commit('update', this.getMeal[index])
            })
            .catch(err => console.log(err.response.data))
        },
        calc: function(index){
            let weight = this.$store.getters.meals.breakfast[index].weight
            let newWeight = this.getMeal[index].weight
            
            let pr = this.$store.getters.meals.breakfast[index].pr
            let ft = this.$store.getters.meals.breakfast[index].ft
            let cb = this.$store.getters.meals.breakfast[index].cb
            let KKAL = this.$store.getters.meals.breakfast[index].KKAL

            this.getMeal[index].pr = (pr / weight * newWeight).toFixed(1)
            this.getMeal[index].ft = (ft / weight * newWeight).toFixed(1)
            this.getMeal[index].cb = (cb / weight * newWeight).toFixed(1)
            this.getMeal[index].KKAL = (KKAL / weight * newWeight).toFixed(1)
        }
    }
}
</script>