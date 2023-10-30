//import global modules
import Vue from 'vue';

//register lumi services
import lumiBootstrap from '@lumi/bootstrap';
lumiBootstrap.run();

//register services
import bootstrap from '@/bootstrap';
bootstrap.run();

//import lumi router and store
import Router from '@lumi/routing/Router';
import Store from '@lumi/Store';

//other settings
Vue.config.productionTip = false;
Vue.config.ignoredElements = [];

//import layout
import Layout from '@/Layout/Layout.vue';

/* eslint-disable no-new */
window.VM = new Vue({
    el: '#app',
    router: Router,
    store: Store,
    components: { Layout },
    template: '<Layout/>',
});
