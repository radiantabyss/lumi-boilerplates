export default {
    props: {
        store: {
            type: Boolean,
            required: false,
            default: true,
        },
        store_key: {
            type: String,
            required: false,
            default: '',
        },
    },
    data() {
        return {
            fields: {},
        }
    },
    methods: {
        submit() {
            let query = {...this.fields};

            //remove empty
            for ( let key in query ) {
                if ( query[key] === '' ) {
                    delete query[key];
                }
            }

            //reset page
            query.page = 1;

            this.$router.push({
                path: this.$route.path,
                query,
            });

            //save to storage
            if ( this.store ) {
                store_url_filters(this.store_key || this.$route.path, query);
            }
        },

        clear() {
            this.$router.push({
                path: this.$route.path,
                query: {},
            });

            //save to storage
            if ( this.store ) {
                store_url_filters(this.store_key || this.$route.path, {});
            }
        },

        toggle(key) {
            if ( this.fields[key] ) {
                this.fields = Item.setKey(this.fields, key, 1);
            }
            else {
                delete this.fields[key];
            }

            this.submit();
        },
    },
    mounted() {
        this.fields = {
            ...this.fields,
            ...this.$route.query
        };
    },
    watch: {
        $route() {
            this.fields = {
                ...this.fields,
                ...this.$route.query
            };
        }
    },
}
