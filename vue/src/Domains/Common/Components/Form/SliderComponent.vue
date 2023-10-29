<script>
export default {
    name: 'SliderComponent',
    props: {
        value: {
            type: [String, Number],
            required: false,
            default: '',
        },
        values: {
            type: [Array, Object],
            required: true,
        },
        texts: {
            type: Array,
            required: false,
        },
        value_key: {
            type: String,
            required: false,
            default: 'value',
        },
        text_key: {
            type: String,
            required: false,
            default: 'text',
        },
        debounce_timeout: {
            type: Number,
            required: false,
            defualt: 200,
        }
    },
    data() {
        return {
            current_value: '',
            timeout: null,
        }
    },
    computed: {
        slider_data() {
            let slider_data = [];
            if ( Array.isArray(this.values) && this.texts ) {
                for ( let i = 0; i < this.values.length; i++ ) {
                    let entry = {};
                    entry[this.value_key] = this.values[i];
                    entry[this.text_key] = this.texts[i];
                    slider_data.push(entry);
                }

                return slider_data;
            }

            return this.values;
        },

        current_text() {
            if ( Array.isArray(this.values) && !this.texts ) {
                return this.current_value;
            }

            return Items.findByKey(this.slider_data, 'value', this.current_value, true).text;
        },
    },
    methods: {
        mount() {
            this.current_value = this.value || this.values[0];
        },

        change() {
            if ( this.timeout ) {
                clearTimeout(this.timeout);
                this.timeout = null;
            }

            this.timeout = setTimeout(() => {
                this.$emit('input', this.current_value);
            }, this.debounce_timeout);
        },

        parseNumber(number) {
            if ( number === undefined ) {
                return null;
            }

            return parseFloat((number+'').replace(/,/g, '').replace(/%/g, ''));
        },
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
<div class="slider">
    <div class="slider__value">{{ current_text }}</div>
    <div class="slider__slider">
        <vue-slider
            ref="slider"
            dotSize="15"
            v-model="current_value"
            :dragOnClick="true"
            :duration="0"
            tooltip="none"
            :data="slider_data"
            :data-value="value_key"
            :data-label="text_key"
            @change="change"
        />
    </div>
</div>
</template>
