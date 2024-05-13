<script>
import DatePicker from 'vue2-datepicker';

export default {
    name: 'DatepickerComponent',
    props: {
        value: {
            type: [String, Number],
            required: false,
            default: '',
        },
    },
    components: { DatePicker },
    data() {
        return {
            show: false,
            timeout: null,
            text: this.value ? Str.prettify_date(this.value) : 'Select Date',
        }
    },
    methods: {
        hide() {
            this.show = false;
        },

        select(value) {
            clearTimeout(this.timeout);
            this.hide();
            this.text = Str.prettify_date(value);
            this.$emit('input', Str.mysql_date(value));
        },

        parse(timeout_delay) {
            clearTimeout(this.timeout);

            if ( this.text == 'Select Date' ) {
                return;
            }

            this.timeout = setTimeout(() => {
                this.text = Str.prettify_date(this.text);
                this.$emit('input', Str.mysql_date(this.text));
            }, timeout_delay);
        },
    },
}
</script>

<template>
<div class="datepicker">
    <input @click="show = !show" class="datepicker__value" ref="trigger"
        v-model="text"
        @keyup="parse(700)" @blur="parse(150)"
    />

    <transition name="simple-fade">
        <div class="daterangepicker__popup" v-show="show" v-closable="{ handler: 'hide', exclude: ['trigger'] }">
            <div class="daterangepicker__picker">
                <DatePicker type="date"
                    format="YYYY-MM-DD"
                    :inline="true"
                    :lang="{
                        formatLocale: { firstDayOfWeek: 1 },
                        monthBeforeYear: false
                    }"
                    @change="select"
                />
            </div>
        </div>
    </transition>
</div>
</template>
