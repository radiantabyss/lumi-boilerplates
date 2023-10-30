const Directives = {}

export default {
    install(Vue) {
        for ( let key in Directives ) {
            Vue.directive(key, Directives[key]);
        }
    }
};
