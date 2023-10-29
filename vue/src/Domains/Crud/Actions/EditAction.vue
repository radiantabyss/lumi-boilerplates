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
        submit(fields) {
            Request.post(Domain.url(true), fields, true)
            .then(() => {
                this.$router.push(Domain.url());
            });
        }
    },
    mounted() {
        Request.get(`${Domain.url()}/edit/${this.$route.params.id}`)
        .then(data => {
            this.item = data.item;
        });
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

    <Form :item="item" @submit="submit" v-if="item !== false" />
</div>
</template>
