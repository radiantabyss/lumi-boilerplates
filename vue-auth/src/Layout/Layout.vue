<style lang="scss">@import "@/Sass/app.scss";</style>

<script>
import Header from '@/Layout/Header.vue';
import Footer from '@/Layout/Footer.vue';

let metaInfo = {
    titleTemplate: '%s - Lumi Vue Boilerplate',
    meta: [
        {charset: 'utf-8'},
        {name: 'viewport', content: 'width=device-width, initial-scale=1'},
    ],
    script: [],
    __dangerouslyDisableSanitizersByTagID: {
        'google-tag-manager': ['innerHTML']
    },
};

export default {
    name: 'Layout',
    metaInfo,
    components: {
        Header, Footer
    },
    mounted() {
        setTimeout(() => {
            document.body.classList.add("default-transition");
        }, 100);
    },
    computed: {
        app_class() {
            let css_class = '';

            return css_class;
        },

        in_production() {
            return process.env.VUE_APP_ENV == 'production';
        },
    },
}
</script>

<template>
<div id="app" :class="`${app_class}`">
    <alert />
    <confirm />

    <Header />

    <transition name="fade">
        <router-view :key="$route.path" />
    </transition>

    <Footer />
</div>
</template>
