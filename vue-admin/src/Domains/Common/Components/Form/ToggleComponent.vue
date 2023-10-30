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
            checked: null,
        }
    },
    methods: {
        mount() {
            let checked = this.value ? true : false;
            if ( this.value === '0' ) {
                checked = false;
            }

            this.checked = checked;
        },

        change() {
            this.$emit('input', this.checked ? 1 : 0);
            this.$emit('change', this.checked ? 1 : 0);
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
<label class="toggle" :class="disabled ? 'disabled' : ''" v-if="checked !== null">
    <input type="checkbox" ref="input" v-model="checked" @change="change">
    <span></span>
</label>
</template>
