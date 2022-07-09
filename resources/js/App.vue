<template>
    <router-view></router-view>
</template>

<script>
    export default{
        mounted() {
            axios.post('/api/checkLogin')
            .catch(() => this.$router.push('/login'))
        }
    }
</script>