<script>
export default {
    name: 'PasswordComponent',
    data() {
        return {
            show: false,
        }
    },
    methods: {
        mount() {
            for ( let css_class of this.$el.classList ) {
                if ( ['password'].includes(css_class) ) {
                    continue;
                }

                this.$refs.input.classList.add(css_class);
            }

            this.$el.className = `password`;
        },

        handleInput() {
            this.$emit('input', this.$refs.input.value);
        },

        toggle() {
            this.show = !this.show;
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
<div class="password">
    <input :type="show ? 'text' : 'password'" @input="handleInput" ref="input" class="input" />
    <a @click="toggle"><sprite :id="show ? 'eye-crossed' : 'eye'" /></a>
</div>
</template>
