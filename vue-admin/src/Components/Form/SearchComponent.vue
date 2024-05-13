<script>
export default {
    name: 'SearchComponent',
    props: {
        value: {
            type: [String, Number],
            required: false,
            default: '',
        },
    },
    data() {
        return {
            term: this.value,
            timeout: null,
        }
    },
    methods: {
        clear() {
            clearTimeout(this.timeout);
            this.term = '';
            this.$emit('input', this.term);
            this.$emit('clear');
            this.$refs.input.focus();
        },

        emit() {
            clearTimeout(this.timeout);

            this.timeout = setTimeout(() => {
                this.$emit('input', this.term);
            }, 200);
        },
    },
    mounted() {
        for ( let css_class of this.$el.classList ) {
            if ( ['input-search'].includes(css_class) ) {
                continue;
            }

            this.$refs.input.classList.add(css_class);
        }

        this.$el.className = `input-search`;
    },
}
</script>

<template>
<div class="input-search">
    <input type="text" class="input"
        v-model="term"
        @input="emit"
        @keypress.enter="emit"
        ref="input"
    />
    <a @click="clear" v-if="term"><sprite id="x" /></a>
</div>
</template>
