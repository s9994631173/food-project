<template>
<div class="container clr">
    <notifications position="bottom right"/>
    <div class="row justify-content-center">
        <div class="col">
            <span class="badge rounded-pill bg-secondary mb-2">{{title.name}}</span>
        </div>
        <div class="col-xl-auto text-end">
            <span class="badge pr me-2">Б <span> {{ nutritions.pr }} </span></span>
            <span class="badge ft me-2">Ж <span> {{ nutritions.ft }} </span></span>
            <span class="badge cb me-2">У <span> {{ nutritions.cb }} </span></span>
            <span class="badge bg-light text-dark">Ккал <span> {{ nutritions.KKAL }} </span></span>
        </div>
    </div>
    <div class="row" v-if="!newProduct.visible">
        <div class="col" @click="newProduct.visible = true" >
            <span class="text-white-50" style="cursor: pointer;"><small><em>Добавить продукт</em></small></span>
        </div>
    </div>
    <div class="row justify-content-center gy-2 pt-2" v-else>
        <div class="col-xl-4">
            <input type="text" class="form-control form-control-sm" placeholder="Добавить продукт" v-model="newProduct.product" @click="searchVisible = true" @input="presearch">
            <div class="search" v-if="searchVisible" v-click-away="onClickAway" >
                <div class="list-group">
                    <button class="list-group-item list-group-item-action" v-for="(item, index) in search" :key="index" @click="select(item)">{{item.prod_title}}</button>
                </div>
            </div>
        </div>
        <div class="col-xl-8 col-11 text-center">
            <div class="row gy-2 justify-content-end">
                <div class="col-xl-2 col-4 p-0 text-center">
                    <div class="input-group input-group-sm">
                        <div class="input-group-text">Гр.</div>
                        <input type="text" class="form-control form-control-sm" id="autoSizingInputGroup" v-model="newProduct.weight" @focus="saveNewProdProps" @input='calcAppend'>
                    </div>
                </div>
                <div class="col-xl-3 col-4 p-0 text-end">
                    <div class="input-group input-group-sm">
                        <div class="input-group-text">Ккал</div>
                        <input type="text" class="form-control form-control-sm" id="autoSizingInputGroup" v-model="newProduct.KKAL">
                    </div>
                </div>
                <div class="col-10 col-xl p-0 text-end">
                    <div class="input-group input-group-sm">
                        <div class="input-group-text">Б</div>
                        <input type="text" class="form-control form-control-sm" id="autoSizingInputGroup" v-model="newProduct.pr">
                        <div class="input-group-text">Ж</div>
                        <input type="text" class="form-control form-control-sm" id="autoSizingInputGroup" v-model="newProduct.ft">
                        <div class="input-group-text">У</div>
                        <input type="text" class="form-control form-control-sm" id="autoSizingInputGroup" v-model="newProduct.cb">
                    </div>
                </div>
                <div class="col-12 col-xl-2 p-0 text-end">
                    <div class="spinner-border text-warning" role="status" v-if="newProduct.loading">
                        <span class="sr-only"></span>
                    </div>
                    <button type="button" class="btn btn-outline-success btn-sm" @click="addProduct" v-else> Добавить </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center gy-2 pt-xl-1 pt-3" v-for="(item, index) in getMeal" :key="index">
        <div class="col-xl-4">
            <input type="text" class="form-control form-control-sm" placeholder="Добавить продукт" v-model="item.product" @change="update(item)">
        </div>
        <div class="col-xl-8 col-11 text-center">
            <div class="row gy-2 justify-content-end">
                <div class="col-xl-2 col-4 p-0 text-center">
                    <div class="input-group input-group-sm">
                        <div class="input-group-text">Гр.</div>
                        <input type="text" class="form-control form-control-sm" id="autoSizingInputGroup" v-model="item.weight" @change="update(item)" @input="calc(index)">
                    </div>
                </div>
                <div class="col-xl-3 col-4 p-0 text-end">
                    <div class="input-group input-group-sm">
                        <div class="input-group-text">Ккал</div>
                        <input type="text" class="form-control form-control-sm" id="autoSizingInputGroup" v-model="item.KKAL" @change="update(item)">
                    </div>
                </div>
                <div class="col-10 col-xl p-0 text-end">
                    <div class="input-group input-group-sm">
                        <div class="input-group-text">Б</div>
                        <input type="text" class="form-control form-control-sm" id="autoSizingInputGroup" v-model="item.pr" @change="update(item)">
                        <div class="input-group-text">Ж</div>
                        <input type="text" class="form-control form-control-sm" id="autoSizingInputGroup" v-model="item.ft" @change="update(item)">
                        <div class="input-group-text">У</div>
                        <input type="text" class="form-control form-control-sm" id="autoSizingInputGroup" v-model="item.cb" @change="update(item)">
                    </div>
                </div>
                <div class="col-12 col-xl-2 p-0 text-end">
                    <button type="button" class="btn btn-outline-danger btn-sm" @click="deleteProduct(item)"> Удалить </button>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default{
    props: ['title'],
    data () {
        return {
            newProduct: {
                product: [],
                weight: 100,
                pr: null,
                ft: null,
                cb: null,
                KKAL: null,
                type: this.title.title,
                loading: false,
                visible: false,
            },
            newProductProps: null,
            productProps: null,
            search: [],
            searchVisible: false
        }
    },
    computed: {
        getMeal: function(){
            return _.cloneDeep(this.$store.getters.meals[this.title.title])
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
            result.pr = result.pr.toFixed(1)
            result.ft = result.ft.toFixed(1)
            result.cb = result.cb.toFixed(1)
            result.KKAL = result.KKAL.toFixed(1)
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
                this.newProduct.weight = 100
                this.newProduct.calcWeight = 100
                this.newProduct.pr = null
                this.newProduct.ft = null
                this.newProduct.cb = null
                this.newProduct.KKAL = null

                this.search = null
                this.searchVisible = false
                this.newProduct.visible = false
            })
            .catch(err => {
                this.$notify({
                text: err.response.data.message,
                type: 'error'
                });
            })
        },
        deleteProduct: function(item){
            item.loading = true

            axios.post('/api/products/delete', {
                ...item,
                date: this.date
            })
            .then(() => {
                item.loading = false

                this.$store.commit('remove',item)
            })
            .catch(err => {
                item.loading = false

                this.$notify({
                text: err.response.data.message,
                type: 'error'
                });
            })
        },
        update: function(item){
            item.loading = true
            axios.post('/api/products/update', {
                ...item,
                date: this.date
            })
            .then(() => {
                item.loading = false

                this.$store.commit('update', item)
            })
            .catch(err => {
                item.loading = false

                this.$notify({
                text: err.response.data.message,
                type: 'error'
                });
            })
        },
        calc: function(index){
            let weight = this.$store.getters.meals[this.title.title][index].weight
            let newWeight = this.getMeal[index].weight
            
            let pr = this.$store.getters.meals[this.title.title][index].pr
            let ft = this.$store.getters.meals[this.title.title][index].ft
            let cb = this.$store.getters.meals[this.title.title][index].cb
            let KKAL = this.$store.getters.meals[this.title.title][index].KKAL

            this.getMeal[index].pr = (pr / weight * newWeight).toFixed(1)
            this.getMeal[index].ft = (ft / weight * newWeight).toFixed(1)
            this.getMeal[index].cb = (cb / weight * newWeight).toFixed(1)
            this.getMeal[index].KKAL = (KKAL / weight * newWeight).toFixed(1)
        },
        onClickAway() {
            if (this.searchVisible = true){
                this.searchVisible = false
            }
        },
        select(item){
            this.newProduct.loading = true

            axios.post('/api/products/search', {
                prod_id: item.prod_id
            })
            .then(response => {
                this.newProduct.loading = false

                this.newProduct.product = response.data.product
                this.newProduct.pr = response.data.pr
                this.newProduct.ft = response.data.ft
                this.newProduct.cb = response.data.cb
                this.newProduct.KKAL = response.data.KKAL

                this.search = null
                this.searchVisible = false
            })
            .catch(err => {
                this.newProduct.loading = false

                this.$notify({
                text: err.response.data.message,
                type: 'error'
                });
            })
            
        },
        presearch(){
            this.search = null

            if(this.newProduct.product.length > 2){
                axios.post('/api/products/presearch', this.newProduct)
                .then(response => {
                    let presearch = response.data.replace(/\\/g, '1')

                    let rpl = JSON.parse(presearch)

                    if (rpl.prod_title){
                        let result = []
                        for (var i=0; i<rpl.prod_title.length; i++){
                            result.push({prod_title: rpl.prod_title[i], prod_id: rpl.prod_id[i]})
                        }
                        this.search = result
                    }else{
                        this.$notify({
                        text: 'Продукт не найден',
                        type: 'warn'
                        });
                    }
                })
            }
        },
        saveNewProdProps(){
            this.newProductProps = _.cloneDeep(this.newProduct)
        },
        calcAppend(){
            let weight = this.newProductProps.weight
            let newWeight = this.newProduct.weight
            
            let pr = this.newProductProps.pr
            let ft = this.newProductProps.ft
            let cb = this.newProductProps.cb
            let KKAL = this.newProductProps.KKAL

            this.newProduct.pr = (pr / weight * newWeight).toFixed(1)
            this.newProduct.ft = (ft / weight * newWeight).toFixed(1)
            this.newProduct.cb = (cb / weight * newWeight).toFixed(1)
            this.newProduct.KKAL = (KKAL / weight * newWeight).toFixed(1)
        }
    }
}
</script>