<script>
export default {
    name: 'RadioButtonsComponent',
    props: {
        value: {
            type: String,
            required: false,
            default: '',
        },
        options: {
            type: [Array, Object],
            required: true,
        }
    },
    data() {
        return {
            selected: '',
            is_object: !Array.isArray(this.options),
        }
    },
    methods: {
        mount() {
            let selected = this.value;

            if ( selected === '' ) {
                selected = Array.isArray(this.options) ? this.options[0] : Object.keys(this.options)[0];
            }

            this.selected = selected;
        },

        select(value) {
            this.selected = value;
            this.$emit('input', value);
        }
    },
    mounted() {
        this.mount();
    },
    watch: {
        value() {
            this.mount();
        },
    },
}
</script>

<template>
<div class="input-radio-buttons">
    <a class="btn btn--small btn--auto"
        v-for="(text, value) in options"
        :key="value"
        :class="selected === (is_object ? value : text) ? '' : 'btn--outline'"
        @click="select(is_object ? value : text)"
    >
        {{ is_object ? text : $options.filters.to_words(text) }}
    </a>
</div>
</template>
