<script>
export default {
    name: 'ConfirmModal',
    props: {
        type: {
            type: String,
            required: true,
        },
        question: {
            type: String,
            required: false,
            default: 'Are you sure you want to delete this item?',
        },
        text: {
            type: String,
            required: false,
            default: '',
        },
        deleteText: {
            type: String,
            required: false,
            default: 'Delete',
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
<modal :name="`confirm-${type}`" classes="modal modal--small" @before-open="beforeOpen" :clickToClose="false">
    <a href="javascript:;" @click="$modal.hide(`confirm-${type}`)" class="modal__close">
        <sprite id="x" class="small" />
    </a>

    <div class="modal__content">
        <div class="subtitle text-center">
            {{ question }}
        </div>
        <div class="mt-20" v-if="text">{{ text }}</div>

        <div class="mt-60 text-center">
            <a href="javascript:;" @click="confirm" class="btn btn--auto btn--red">{{ deleteText }}</a>
            <div class="mt-20">
                <a href="javascript:;" @click="$modal.hide(`confirm-${type}`)">Cancel</a>
            </div>
        </div>
    </div>
</modal>
</template>
