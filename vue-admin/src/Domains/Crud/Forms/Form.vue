<script>
export default {
    name: 'Form',
    props: {
        item: {
            type: Object,
            required: false,
            default: null,
        },
        redirect: {
            type: Boolean,
            required: false,
            default: true,
        }
    },
    data() {
        return {
            fields: {
                ...(this.item || {})
            },
        }
    },
    methods: {
        submit(e) {
            this.$emit('submit', {
                _event: e,
                ...this.fields,
            });
        },

        toggle(key) {
            this[key] = !this[key];
        },
    },
    mounted() {
        setTimeout(() => {
            this.$refs.form.getElementsByTagName('input')[0].focus();
        }, 150);
    },
}
</script>

<template>
<form ref="form">
    <div class="panel w-50">
        <div class="row">
            <label>Name</label>
            <input type="text" class="input" v-model="fields.name" />
        </div>
    </div>

    <div class="panel w-50">
        <div class="row row--submit">
            <button type="submit" @click.prevent="submit" class="btn btn--medium">Save</button>
            <a @click="$emit('cancel')"><sprite id="cancel" /> Cancel</a>
        </div>
    </div>
</form>
</template>
