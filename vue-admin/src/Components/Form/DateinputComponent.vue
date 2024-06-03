<script>
export default {
    name: 'DateinputComponent',
    props: {
        value: {
            type: [String, Object],
            required: false,
            default: '',
        },
    },
    data() {
        return {
            fields: {
                day: '',
                month: '',
                year: '',
            },
        }
    },
    methods: {
        mount() {
            if ( typeof this.value == 'object' ) {
                this.fields = { ...this.value };
            }
            else if ( this.value.match(/\d{4}-\d{2}-\d{2}/) ) {
                let split = this.value.split('-');
                this.fields = {
                    day: split[2],
                    month: split[1],
                    year: split[0],
                };
            }
            else if ( this.value.match(/\d{2}-\d{2}-\d{4}/) ) {
                let split = this.value.split('-');
                this.fields = {
                    day: split[0],
                    month: split[1],
                    year: split[2],
                };
            }
        },

        keyup(e) {
            let inputs = [
                'day', 'month', 'year',
            ];

            for ( let i = 0; i < inputs.length; i++ ) {
                if ( e.target == this.$refs[inputs[i]]
                        && i < inputs.length - 1
                        && event.target.value.length === event.target.maxLength
                ) {
                    this.$refs[inputs[i + 1]].focus();
                }
            }

            this.$emit('input', `${this.fields.year}-${this.fields.month}-${this.fields.day}`);
        },
    },
    mounted() {
        this.mount();
    },
    watch: {
        value() {
            this.mount();
        }
    },
}
</script>

<template>
<div class="input-group">
    <input ref="day" type="text" class="input" placeholder="DD"
        pattern="\d*"
        maxlength="2"
        v-model="fields.day"
        @input="keyup"
    />

    <input ref="month" type="text" class="input" placeholder="MM"
        pattern="\d*"
        maxlength="2"
        v-model="fields.month"
        @input="keyup"
    />

    <input ref="year" type="text" class="input" placeholder="YYYY"
        pattern="\d*"
        maxlength="4"
        v-model="fields.year"
        @input="keyup"
    />
</div>
</template>
