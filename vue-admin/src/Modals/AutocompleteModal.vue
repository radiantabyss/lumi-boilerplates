<script>
export default {
    name: 'AutocompleteModal',
    props: {
        type: {
            type: String,
            required: true,
        },
        text: {
            type: String,
            required: false,
            default: 'Are you sure you want to delete this item?',
        },
    },
    data() {
        return {
            params: null,
        }
    },
    methods: {
        beforeOpen(event) {
            this.params = event.params;
        },

        confirm() {
            this.$emit('confirm', this.params);
            this.$modal.hide(`confirm-${this.type}`);
        },
    },
}
</script>

<template>
<modal :name="`autocomplete-${type}`" classes="modal" @before-open="beforeOpen">
    <a @click="$modal.hide(`autocomplete-${type}`)" class="modal__close">
        <sprite id="x" class="small" />
    </a>

    <div class="modal__content">
        <div class="subtitle text-center">
            Search {{ type | ucwords }}
        </div>

        <input type="text" :placeholder="`Search ${Str.plural(type)} by ID or Name...`" />

        <div class="flex space-between mt-60">
            <div></div>
            <a @click="$modal.hide(`autocomplete-${type}`)"><sprite id="cancel" /> Cancel</a>
        </div>
    </div>
</modal>
</template>
