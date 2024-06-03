<script>
import Form from './../Forms/Form.vue';

export default {
    components: { Form },
    data() {
        return {
            item: false,
        }
    },
    methods: {
        async submit(fields) {
            await Request.post(Domain.url(true), fields, true);
            this.redirect();
        },

        redirect() {
            this.$router.push(StorageHandler.getItem('_previous_route') || `${Domain.url()}/single/${this.$route.params.id}`);
        },
    },
    async mounted() {
        let data = await Request.get(`${Domain.url()}/edit/${this.$route.params.id}`);
        this.item = data.item;
    },
}
</script>

<template>

<div v-if="item">
    <div class="page-title">
        <div>
            Edit {{ Domain.name() }} #{{ item.id }}
            <div class="crumbs">
                <router-link to="/"><sprite id="home" /></router-link>
                <sprite id="arrow-right" />
                <router-link :to="`${Domain.url()}`">{{ Domain.name(true) }}</router-link>
                <sprite id="arrow-right" />
                <span>Edit {{ Domain.name() }} #{{ item.id }}</span>
            </div>
        </div>
    </div>

    <Form :item="item" @submit="submit" @cancel="redirect" v-if="item !== false" />
</div>
</template>
