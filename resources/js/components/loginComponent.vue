<template>
    <div class='container-fluid auth'>
        <main class='form-signin w-100 m-auto'>
    <form class="text-center" @submit.prevent="formSubmit">
        <div class="form-floating" v-if="errors">
            <div class="text-danger" v-for="(item, index) in errors" :key="index">
                {{ item.join() }}
            </div>
        </div>

        <div class="form-floating">
        <input type="email" name='email' class="form-control" id="floatingInput" placeholder="name@example.com" required v-model="email">
        <label for="floatingInput">Почта</label>
        </div>
        <div class="form-floating">
        <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Пароль" required v-model="password">
        <label for="floatingPassword">Пароль</label>
        </div>
        <button class="w-100 btn btn-lg btn-primary clr-button" type="submit">Войти</button>
        <router-link to="/register" class="link-light">Зарегистрироваться</router-link>
    </form>
    </main>
    </div>
</template>

<script>
import axios from 'axios';

export default{
    data: function(){
        return{
            email: null,
            password: null,
            errors: null
        }
    },
    methods: {
        formSubmit: function(){

            function getCookie(name) {
                let matches = document.cookie.match(new RegExp(
                    "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
                ));
                return matches ? decodeURIComponent(matches[1]) : undefined;
            }

            axios.get('http://localhost:8000/sanctum/csrf-cookie')
            let csrf = getCookie('XSRF-TOKEN')

            axios.post('http://localhost:8000/login', {
                email: this.email,
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
    html,
    body {
    height: 100%;
    }

    body {
    display: flex;
    align-items: center;
    padding-top: 40px;
    padding-bottom: 40px;
    }

    .form-signin {
    max-width: 330px;
    padding: 15px;
    background: #1a202c;
    border-radius: 20px;
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