<script>
export default {
    name: 'EditLiveComponent',
    props: {
        value: {
            type: String,
            required: false,
        },
        css_class: {
            type: String,
            required: false,
        },
    },
    data() {
        return {
            is_visible: false,
            current_value: this.value,
            input: this.value,
        }
    },
    methods: {
        show() {
            this.is_visible = true;
            setTimeout(() => {
                this.$refs.input.focus();
            }, 0);
        },

        hide() {
            this.input = this.current_value;
            this.is_visible = false;
        },

        submit() {
            this.current_value = this.input;
            this.$emit('submit', this.input);
            this.hide();
        },
    },
    watch: {
        value() {
            this.current_value = this.value;
        },
    },
}
</script>

<template>
<div class="edit-live" :class="css_class" v-closable="{exclude:['edit'], handler: 'hide'}" @keydown.esc="hide">
    <span v-show="!is_visible" @click="show">{{ current_value }}</span>
    <a @click="show" v-show="!is_visible" ref="edit">
        <sprite id="edit" class="tiny" />
    </a>
    <form class="inline-flex items-center" v-show="is_visible">
        <input type="text" v-model="input" class="input edit-live__input" ref="input" />
        <button type="submit" @click.prevent="submit" class="btn-clear">
            <sprite id="check" class="tiny" />
        </button>
    </form>
</div>
</template>
