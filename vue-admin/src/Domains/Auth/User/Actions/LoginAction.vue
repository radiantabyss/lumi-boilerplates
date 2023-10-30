<script>
import LoginForm from './../Forms/LoginForm.vue';

export default {
    metaInfo() {
        return {
            title: 'Login',
        }
    },
    components: { LoginForm },
    methods: {
        submit(fields) {
            Request.post('/auth/user/login', fields, true)
            .then(data => {
                this.$store.dispatch('Auth/login', data);
                this.$router.push(process.env.VUE_APP_LOGIN_REDIRECT);
            });
        },
    },
}
</script>

<template>
<div class="auth">
    <div class="auth__left">
        <div class="auth__logo"><img src="/images/logo.png" /></div>
        <div>
            <div class="title">Login</div>
            <LoginForm @submit="submit" />
        </div>
    </div>
    <div class="auth__right"></div>
</div>
</template>
