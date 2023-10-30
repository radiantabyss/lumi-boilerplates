<script>
import Form from './../Forms/Form.vue';

export default {
    components: { Form },
    methods: {
        submit(fields) {
            Request.post('/auth/team/create', fields, true)
            .then(data => {
                //switch to this team
                this.$store.dispatch('Auth/login', {
                    item: data.user,
                    jwt_token: data.jwt_token,
                });

                this.$store.commit('Auth/ADD_TEAM', data.item);
                this.$router.push(`/dashboard`);
            });
        },
    }
}
</script>

<template>

<div>
    <div class="page-title">
        <div>
            New Team
            <div class="crumbs">
                <router-link to="/"><sprite id="home" /></router-link>
                <sprite id="arrow-right" />
                <router-link to="/auth/user/account">My Account</router-link>
                <sprite id="arrow-right" />
                <span>New Team</span>
            </div>
        </div>
    </div>

    <Form @submit="submit" />
</div>
</template>
