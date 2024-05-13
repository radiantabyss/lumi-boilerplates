<script>
export default {
    props: {
        value: {
            type: [Boolean, Number, String],
            required: false,
            default: false,
        },
        disabled: {
            type: Boolean,
            required: false,
            default: false,
        },
    },
    data() {
        return {
            name: Math.ceil(Math.random() * 10000),
            current_value: null,
        }
    },
    methods: {
        mount() {
            let current_value = this.value;

            if ( this.value === 1 || this.value === '1' ) {
                current_value = 1;
            }
            else if ( this.value === '0' || this.value === 0 ) {
                current_value = 0;
            }
            else {
                current_value = '';
            }

            this.current_value = current_value;
        },

        click() {
            if ( this.current_value === null || this.current_value === '' ) {
                this.current_value = 1;
            }
            else if ( this.current_value === 1 || this.current_value === '1' ) {
                this.current_value = 0;
            }
            else {
                this.current_value = '';
            }

            this.$emit('input', this.current_value);
            this.$emit('change', this.current_value);
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
<label class="triple-toggle" :class="disabled ? 'disabled' : ''" v-if="current_value !== null">
    <input type="radio" value="" :name="name" :checked="current_value === ''" @click="click">
    <input type="radio" value="1" :name="name" :checked="current_value === 1" @click="click">
    <input type="radio" value="0" :name="name" :checked="current_value === 0" @click="click">
    <span></span>
</label>
</template>
