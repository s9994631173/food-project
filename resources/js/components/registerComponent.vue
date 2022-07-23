<template>
    <div class='container px-4'>
        <div class="row justify-content-center vh-100">
            <div class="col align-self-center">
                <main class='form-signin w-100 m-auto'>
                <form class="text-center" @submit.prevent="formSubmit">
                    <div class="form-floating" v-if="errors">
                        <div class="text-danger" v-for="(item, index) in errors" :key="index">
                            {{ item.join() }}
                        </div>
                    </div>

                    <div class="form-floating">
                        <input type="text" name='name' class="form-control" id="floatingLogin" placeholder="Имя" required v-model="name">
                        <label for="floatingLogin">Имя</label>
                    </div>
                    <div class="form-floating">
                        <input type="email" name='email' class="form-control" id="floatingInput" placeholder="name@example.com" required v-model="email">
                        <label for="floatingInput">Почта</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Пароль" required v-model="password">
                        <label for="floatingPassword">Пароль</label>
                    </div>
                    <div class="form-floating">
                    </div>
                    <button class="w-100 btn btn-lg btn-primary clr-button" type="submit">Регистрация</button>
                    <router-link to="/login" class="link-light">Войти</router-link>
                </form>
                </main>
            </div>
        </div>
    </div>

</template>

<script>
import axios from 'axios'

export default{
    data: function(){
        return{
            name: null,
            email: null,
            password: null,
            errors: null
        }
    },
    methods: {
        formSubmit: function(){
            axios.post('/api/register', {
                email: this.email,
                name: this.name,
                password: this.password
            })
            .then(response => {
                if (response.data.userName){
                    this.$store.commit('addName', response.data.userName)
                    this.$router.push('app')
                }
            })
            .catch(error => {
                if(error.response.data.errors){
                    this.errors = error.response.data.errors
                }
            })
        }
    },
    mounted() {
        axios.post('/api/checkLogin')
        .then(response => {
                if (response.data.name){
                    this.$store.commit('addName', response.data.name)
                    this.$router.push('app')
                }
            })
        .catch()

    }
}
</script>

<style>
    .form-signin {
    max-width: 330px;
    padding: 15px;
    }

    .form-signin .form-floating:focus-within {
    z-index: 2;
    }

    .form-signin input[type="text"] {
    margin-bottom: -4px;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 0;
    }

    .form-signin input[type="email"] {
    margin-bottom: -1px;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 0;
    }

    .form-signin input[type="password"] {
    margin-bottom: 10px;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    }
</style>