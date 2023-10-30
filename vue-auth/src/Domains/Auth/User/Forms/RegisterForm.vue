<script>
import Store from '@lumi/Store';

export default {
    name: 'RegisterForm',
    data() {
        return {
            fields: {
                meta: {},
            },
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
        <label>Your Name</label>
        <input type="text" v-model="fields.name" id="name" class="input input--full input--big" />
    </div>
    <div class="row">
        <label>Email</label>
        <input type="email" v-model="fields.email" class="input input--full input--big" />
    </div>
    <div class="row">
        <label>Password</label>
        <password v-model="fields.password" class="input--big input--full" style="display: block;" />
    </div>
    <div class="row">
        By continuing you agree to our <a href="/terms" target="_blank">Terms</a>
    </div>
    <div class="row">
        <button type="submit" @click.prevent="submit" class="btn mb-20">
            Register
        </button>
        <div class="mt-10">
            <router-link to="/login" class="font-12">Already have an account?</router-link>
        </div>
    </div>
</form>
</template>
