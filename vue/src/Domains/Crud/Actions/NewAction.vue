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
                this.$router.push(`${Domain.url()}`);
            });
        }
    },
    mounted() {
        if ( this.$route.params.id ) {
            Request.get(`${Domain.url()}/edit/${this.$route.params.id}`)
            .then(data => {
                this.item = data.item;
            });
        }
        else {
            this.item = null;
        }
    },
}
</script>

<template>

<div>
    <div class="page-title">
        <div>
            New {{ Domain.name() }}
            <div class="crumbs">
                <router-link to="/"><sprite id="home" /></router-link>
                <sprite id="arrow-right" />
                <router-link :to="`${Domain.url()}`">{{ Domain.name(true) }}</router-link>
                <sprite id="arrow-right" />
                <span>New {{ Domain.name() }}</span>
            </div>
        </div>
    </div>

    <Form @submit="submit" :item="item" v-if="item !== false" />
</div>
</template>
