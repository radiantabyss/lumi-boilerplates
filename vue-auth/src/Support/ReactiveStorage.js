import Vue from 'vue';

const self = {
    state: Vue.observable({
        data: {}
    }),

    setItem(key, value) {
        StorageHandler.setItem(key, value);
        Vue.set(self.state.data, key, value);
    },

    getItem(key) {
        if (!self.state.data[key]) {
            const value = StorageHandler.getItem(key);
            if ( value ) {
                Vue.set(self.state.data, key, value);
            }
        }

        return self.state.data[key];
    },

    removeItem(key) {
        StorageHandler.removeItem(key);
        Vue.delete(self.state.data, key);
    }
};

export default self;
