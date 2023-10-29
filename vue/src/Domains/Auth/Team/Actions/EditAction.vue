<script>
import Form from './../Forms/Form.vue';
import Members from './../Partials/Members';

export default {
    components: { Form, Members },
    data() {
        return {
            item: false,
        }
    },
    methods: {
        submit(fields) {
            Request.post(`/auth/team/update/${this.$route.params.id}`, fields, true)
            .then(data => {
                //update store
                this.$store.commit('Auth/UPDATE_TEAM', data.item);
                Alert.show('Team updated!', 'success');
            });
        },
    },
    mounted() {
        Request.get(`/auth/team/edit/${this.$route.params.id}`)
        .then(data => {
            this.item = data.item;
        });
    },
}
</script>

<template>

<div v-if="item !== false">
    <div class="page-title">
        <div>
            Edit Team
            <div class="crumbs">
                <router-link to="/"><sprite id="home" /></router-link>
                <sprite id="arrow-right" />
                <router-link :to="`${Domain.url()}/${$route.params.type}`">Teams</router-link>
                <sprite id="arrow-right" />
                <span>Edit Team</span>
            </div>
        </div>
    </div>

    <Form :item="item" @submit="submit" v-if="item" />

    <div class="page-title mti-40">
        <div>Manage Members</div>
    </div>

    <Members :team="item" />
</div>
</template>
