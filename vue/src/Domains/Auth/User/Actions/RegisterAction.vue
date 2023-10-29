<script>
import RegisterForm from './../Forms/RegisterForm.vue';

export default {
    metaInfo() {
        return {
            title: 'Register',
        }
    },
    components: { RegisterForm },
    methods: {
        submit(fields) {
            Request.post('/auth/user/register', fields, true)
            .then(data =>  {
                Store.dispatch('Auth/login', data);
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
            <div class="title">Register</div>
            <RegisterForm @submit="submit" />
        </div>
    </div>
    <div class="auth__right"></div>
</div>
</template>
