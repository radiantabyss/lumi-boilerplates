//import global modules
import Vue from 'vue';

//register lumi services
import LumiBootstrap from '@lumi/Bootstrap';
LumiBootstrap.run();

//register services
import Bootstrap from '@/Bootstrap';
Bootstrap.run();

//import lumi router and store
import Router from '@lumi/Routing/Router';
import Store from '@lumi/Store';

//other settings
Vue.config.productionTip = false;
Vue.config.ignoredElements = ['t'];

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
