<template>
    <div class='container-fluid auth'>
        <main class='form-signin w-100 m-auto'>
    <form class="text-center" @submit.prevent="formSubmit">
        <h1 class="h3 mb-3 fw-normal clt-text">Авторизация</h1>

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
        <router-link to="/register">Зарегистрироваться</router-link>
    </form>
    </main>
    </div>
</template>

<script>
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
            fetch('http://localhost:8000/sanctum/csrf-cookie')
            function getCookie(name) {
                let matches = document.cookie.match(new RegExp(
                    "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
                ));
                return matches ? decodeURIComponent(matches[1]) : undefined;
            }
            let csrf = getCookie('XSRF-TOKEN')

            let form = new FormData();
            form.append('email', this.email)
            form.append('password', this.password)

            fetch('http://localhost:8000/api/login', {
                method: 'POST',
                body: form
            })
            .catch(e => console.log(e))
            .then(response => response.json())
            .then(response => {

                if(response.errors){
                    this.errors = response.errors
                }
                if (response.token){
                    this.$store.commit('addToken', response.token)
                    this.$router.push('app')
                }
            })
        }
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
    background-color: #252526;
    }

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