<script>
export default {
    name: 'ClearableComponent',
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
            if ( ['clearable'].includes(css_class) ) {
                continue;
            }

            this.$refs.input.classList.add(css_class);
        }

        this.$el.className = `clearable`;
    },
    watch: {
        value() {
            this.term = this.value;
        }
    }
}
</script>

<template>
<div class="clearable">
    <input type="text" class="input"
        v-model="term"
        @input="emit"
        @keypress.enter="emit"
        ref="input"
    />
    <a @click="clear" v-if="term"><sprite id="x" /></a>
</div>
</template>
