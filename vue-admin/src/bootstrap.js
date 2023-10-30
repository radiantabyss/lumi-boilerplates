import Vue from 'vue';

//load custom modules
import VueMeta from 'vue-meta';
import VModal from 'vue-js-modal';
import CollapseTransition from '@ivanv/vue-collapse-transition';
import VueSlider from "vue-slider-component";
import VueSelect from "vue-select";
import VueClipboard from 'vue-clipboard2';

//load support
import BaseHelpers from '@/Support/BaseHelpers';
import Directives from '@/Support/Directives';
import Gates from '@/Support/Gates';
import Globals from '@/Support/Globals';
import Settings from '@/Support/Settings';
import Str from '@/Support/Str';
import ReactiveStorage from '@/Support/ReactiveStorage';

let self = {
    run() {
        //custom modules
        Vue.use(VueMeta);
        Vue.use(VModal);
        Vue.use(VueClipboard);

        //custom components
        Vue.component('collapse-transition', CollapseTransition);
        Vue.component('vue-slider', VueSlider);
        Vue.component('vue-select', VueSelect);

        //directives
        Vue.use(Directives);

        //str helpers
        window.Str = Str;
        Vue.prototype.Str = Str;
        Vue.use({
            install(Vue) {
                for ( let key in Str ) {
                    Vue.filter(key, Str[key]);
                }
            }
        });

        //globals
        for ( let key in Globals ) {
            window[key] = Globals[key];
            Vue.prototype[key] = Globals[key];
        }

        //base helpers
        for ( let key in BaseHelpers ) {
            window[key] = BaseHelpers[key];
            Vue.prototype[key] = BaseHelpers[key];
        }

        //settings
        window.Settings = Settings;
        Vue.prototype.Settings = Settings;

        //gates
        Gates.register();

        //reactive storage
        window.ReactiveStorage = ReactiveStorage;
    }
}

export default self;
