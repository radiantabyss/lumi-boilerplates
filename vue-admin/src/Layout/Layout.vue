<style lang="scss">@import "@/Sass/app.scss";</style>

<script>
import Header from '@/Layout/Header.vue';
import Sidebar from '@/Layout/Sidebar.vue';
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
    components: { Header, Sidebar, Footer },
    computed: {
        app_class() {
            let css_class = '';

            if ( !Auth.user || (this.$route.meta.settings && this.$route.meta.settings.disable_header) ) {
                css_class += ' header-disabled';
            }

            if ( !Auth.user || (this.$route.meta.settings && this.$route.meta.settings.disable_sidebar) ) {
                css_class += ' sidebar-disabled';
            }

            return css_class;
        },

        in_production() {
            return process.env.VUE_APP_ENV == 'production';
        },
    },
    mounted() {
        document.body.classList.add('default-transition');
        document.body.classList.add(`env--${process.env.VUE_APP_ENV}`);
    },
}
</script>

<template>
<div id="app" :class="`${app_class}`">
    <alert/>
    <sprites/>

    <template v-if="Auth.user">
        <Header/>
        <Sidebar />
    </template>

    <transition name="fade">
        <router-view :key="$route.path" />
    </transition>

    <template v-if="Auth.user">
        <Footer/>
    </template>
</div>
</template>
