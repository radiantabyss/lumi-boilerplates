<script>
import ResetPasswordForm from './../Forms/ResetPasswordForm.vue';

export default {
    metaInfo() {
        return {
            title: 'Set your new password',
        }
    },
    components: { ResetPasswordForm },
    methods: {
        submit(fields) {
            Request.post('/auth/user/reset-password', fields, true)
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
            <div class="title">Reset Password</div>
            <ResetPasswordForm @submit="submit" />
        </div>
    </div>
    <div class="auth__right"></div>
</div>
</template>
