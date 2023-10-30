<script>
export default {
    name: 'LoginForm',
    data() {
        return {
            fields: {},
        }
    },
    methods: {
        submit(e) {
            this.$emit('submit', {
                _event: e,
                ...this.fields,
            });
        },
    },
    mounted() {
        setTimeout(() => {
            this.$refs.form.getElementsByTagName('input')[0].focus();
        }, 150);
    },
}
</script>

<template>
<form ref="form">
    <div class="row">
        <label>Email</label>
        <input type="email" v-model="fields.email" id="email" class="input input--full input--big" />
    </div>
    <div class="row">
        <label>Password</label>
        <password v-model="fields.password" class="input--big input--full" style="display: block;" />
    </div>
    <div class="row">
        <button type="submit" @click.prevent="submit" class="btn mb-20">LOGIN</button>
        <div class="mt-10 flex space-between">
            <router-link to="/forgot-password" class="font-12">Forgot password?</router-link>
            <router-link to="/register" class="font-12">Register</router-link>
        </div>
    </div>
</form>
</template>
