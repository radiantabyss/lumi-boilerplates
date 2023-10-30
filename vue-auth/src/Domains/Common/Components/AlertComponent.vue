<script>
export default {
    name: 'AlertComponent',
    data() {
        return {
            is_visible: false,
            message: '',
            type: 'success',
            duration: null,
            timeout: null,
        }
    },
    computed: {
        cssClass() {
            let cssClass = `${this.type}`;

            if ( this.is_visible ) {
                cssClass += ' alert--visible';
            }

            return cssClass;
        }
    },
    created() {
        window.addEventListener('alert', (e) => {
            this.is_visible = true;
            this.message = e.detail.message;
            this.type = e.detail.type;
            this.duration = e.detail.duration;

            clearTimeout(this.timeout);

            if ( !this.duration ) {
                this.duration = 7000;
            }

            this.timeout = setTimeout(() => {
                this.is_visible = false;
            }, this.duration);
        });

        window.addEventListener('alert-hide', () => {
            clearTimeout(this.timeout);
            this.is_visible = false;
        });
    },
}
</script>

<template>
<div class="alert" :class="cssClass">
    <sprite :id="type" /> <div v-html="message"></div>
</div>
</template>
