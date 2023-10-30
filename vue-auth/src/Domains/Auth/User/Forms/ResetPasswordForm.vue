<script>
export default {
    name: 'ResetPasswordForm',
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
                id: this.$route.params.id,
                code: this.$route.params.code,
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
        <input type="email" v-model="fields.email" class="input input--full input--big" id="email" />
    </div>
    <div class="row">
        <button type="submit" @click.prevent="submit" class="btn mb-20">Submit</button>
        <div class="mt-10">
            <router-link to="/login" class="font-12">&laquo; Back to Login</router-link>
        </div>
    </div>
</form>
</template>
