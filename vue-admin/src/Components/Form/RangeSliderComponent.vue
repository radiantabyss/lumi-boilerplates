<script>
export default {
    name: 'RangeSliderComponent',
    props: {
        min: {
            type: Number,
            required: true,
        },
        max: {
            type: Number,
            required: true,
        },
        value: {
            type: Array,
            required: false,
            default() {
                return [];
            },
        },
        is_percetage: {
            type: Boolean,
            required: false,
            default: false,
        },
    },
    data() {
        return {
            current_value: [],
            timeout: null,
        }
    },
    computed: {
        current_value_min: {
            get() {
                let current_value_min = this.current_value[0];
                if ( current_value_min < this.min ) {
                    current_value_min = this.min;
                }

                if ( this.is_percetage ) {
                    current_value_min = this.$options.filters.to_percetange(current_value_min);
                }
                else {
                    current_value_min = this.$options.filters.add_commas(current_value_min);
                }

                return current_value_min;
            },
            set(value) {
                this.$refs.slider.setValue([parseFloat(value), this.parseNumber(this.current_value[1])]);
            },
        },
        current_value_max: {
            get() {
                let current_value_max = this.current_value[1];
                if ( current_value_max > this.max ) {
                    current_value_max = this.max;
                }

                if ( this.is_percetage ) {
                    current_value_max = this.$options.filters.to_percetange(current_value_max);
                }
                else {
                    current_value_max = this.$options.filters.add_commas(current_value_max);
                }

                return current_value_max;
            },
            set(value) {
                this.$refs.slider.setValue([this.parseNumber(this.current_value[0]), parseFloat(value)]);
            },
        },
    },
    methods: {
        change() {
            if ( this.timeout ) {
                clearTimeout(this.timeout);
                this.timeout = null;
            }

            this.timeout = setTimeout(() => {
                this.$emit('change', this.current_value);
            }, 200);
        },

        parseNumber(number) {
            if ( number === undefined ) {
                return null;
            }

            return parseFloat((number+'').replace(/,/g, '').replace(/%/g, ''));
        },
    },
    mounted() {
        this.current_value = [...this.value];

        if ( this.current_value[0] === undefined ) {
            this.current_value[0] = this.min;
        }

        if ( this.current_value[1] === undefined ) {
            this.current_value[1] = this.max;
        }
    }
}
</script>

<template>
<div class="slider">
    <div class="slider__slider">
        <vue-slider
            ref="slider"
            dotSize="15"
            v-model="current_value"
            :dragOnClick="true"
            :duration="0"
            tooltip="none"
            :min="min"
            :max="max"
            @change="change"
        />
    </div>
    <div class="slider__values">
        <input type="text" v-model="current_value_min" class="input input--small" />
        <input type="text" v-model="current_value_max" class="input input--small" />
    </div>
</div>
</template>
