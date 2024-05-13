<script>
export default {
    name: 'ClearableAreaComponent',
    props: {
        value: {
            type: [String, Number],
            required: false,
            default: '',
        },
        placeholder: {
            type: String,
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

        input() {
            clearTimeout(this.timeout);

            this.timeout = setTimeout(() => {
                this.$emit('input', this.term);
            }, 200);
        },
    },
    mounted() {
        for ( let css_class of this.$el.classList ) {
            if ( ['clearable', 'clearable--area'].includes(css_class) ) {
                continue;
            }

            this.$refs.input.classList.add(css_class);
        }

        this.$el.className = `clearable clearable--area`;
    },
    watch: {
        value() {
            this.term = this.value;
        }
    }
}
</script>

<template>
<div class="clearable clearable--area">
    <textarea type="text" class="input"
        v-model="term"
        @input="input"
        @keypress.enter="input"
        ref="input"
        :placeholder="placeholder"
    />
    <a @click="clear" v-if="term"><sprite id="x" /></a>
</div>
</template>
