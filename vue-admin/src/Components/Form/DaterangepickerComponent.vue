<script>
import DatePicker from 'vue2-datepicker';

export default {
    name: 'DaterangepickerComponent',
    props: {
        value: {
            type: [String, Number],
            required: false,
            default: '',
        },
        windows: {
            type: Array,
            required: false,
            default() {
                return [
                    'none',
                    'today',
                    'yesterday',
                    'last_7_days',
                    'last_14_days',
                    'last_30_days',
                    'current_month',
                    'last_month',
                    'custom_range',
                ];
            }
        },
    },
    components: { DatePicker },
    data() {
        return {
            show: false,
            show_picker: false,
        }
    },
    computed: {
        text() {
            if ( this.value === '' ) {
                return 'None';
            }

            if ( this.windows.includes(this.value) ) {
                return Str.ucwords(this.value);
            }

            let dates = this.value.split(':');
            if ( dates[0] == dates[1] ) {
                return Str.prettify_date(dates[0]);
            }

            return `${Str.prettify_date(dates[0])} - ${Str.prettify_date(dates[1])}`;
        },
    },
    methods: {
        hide() {
            this.show = false;
        },

        select(value) {
            if ( value == 'custom_range' ) {
                this.show_picker = true;
                return;
            }

            this.show_picker = false;
            this.hide();
            this.$emit('input', value);
        },

        selectRange(range) {
            if ( !range || !range[0] || !range[1]) {
                return;
            }

            this.hide();
            this.$emit('input', Str.mysql_date(range[0])+':'+Str.mysql_date(range[1]));
        },
    },
}
</script>

<template>
<div class="daterangepicker">
    <a @click="show = !show" class="daterangepicker__value" ref="trigger">
        {{ text || 'Select Range' }}
    </a>

    <transition name="simple-fade">
        <div class="daterangepicker__popup" v-show="show" v-closable="{ handler: 'hide', exclude: ['trigger'] }">
            <div class="daterangepicker__windows">
                <a @click="select(window)" v-for="window in windows" :key="window">
                    {{ window | ucwords }}
                </a>
            </div>
            <div class="daterangepicker__picker" v-show="show_picker">
                <DatePicker type="date"
                    format="YYYY-MM-DD"
                    :range="true"
                    :inline="true"
                    :confirm="true"
                    confirm-text="Apply"
                    :lang="{
                        formatLocale: { firstDayOfWeek: 1 },
                        monthBeforeYear: false
                    }"
                    @confirm="selectRange"
                />
            </div>
        </div>
    </transition>
</div>
</template>
