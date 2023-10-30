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
        }
    },
    methods: {
        hide() {
            this.show = false;
        },

        select(value) {
            this.hide();
            this.$emit('input', Str.mysql_date(value));
        },
    },
}
</script>

<template>
<div class="datepicker">
    <a @click="show = !show" class="datepicker__value" ref="trigger">
        {{ value ? Str.prettify_date(value) : 'Select Date' }}
    </a>

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
