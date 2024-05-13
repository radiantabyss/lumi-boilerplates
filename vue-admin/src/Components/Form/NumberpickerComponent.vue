<script>
export default {
    props: {
        value: {
            type: [String, Number],
            required: false,
            default: '',
        },
        type: {
            type: String,
            required: false,
            default: '',
        },
        from: {
            type: Number,
            required: false,
            default: 0,
        },
        to: {
            type: Number,
            required: false,
            default: 0,
        },
        placeholder: {
            type: String,
            required: false,
            default: '',
        },
        leading_zero: {
            type: Boolean,
            required: false,
            default: true,
        },
    },
    data() {
        return {
            current_value: null,
            current_range: null,
            is_visible: false,
        }
    },
    computed: {
        text() {
            if ( this.type == 'month' ) {
                return this.$options.filters.number_to_month(this.current_value);
            }

            if ( this.current_value == '' ) {
                return this.current_value;
            }

            return Str.leading_zero(this.current_value);
        }
    },
    methods: {
        mount() {
            let year = new Date().getFullYear();

            let ranges = {
                minute: range(0, 59),
                hour: range(0, 23),
                day: range(1, 31),
                month: range(1, 12),
                year: range(year - 8, year),
            };

            this.current_value = isNaN(parseFloat(this.value)) ? '' : parseFloat(this.value);
            this.current_range = this.type ? ranges[this.type] : range(this.from, this.to);
            this.is_visible = false;
        },

        show() {
            this.is_visible = true;
        },

        hide() {
            this.is_visible = false;
        },

        select(i) {
            this.current_value = i;
            this.is_visible = false;
            this.$emit('input', this.leading_zero ? Str.leading_zero(i) : i);
        },
    },
    mounted() {
        this.mount();

        for ( let css_class of this.$el.classList ) {
            if ( ['numberpicker', `numberpicker--${this.type}`].includes(css_class) ) {
                continue;
            }

            this.$refs.input.classList.add(css_class);
        }

        this.$el.className = `numberpicker numberpicker--${this.type}`;
    },
    watch: {
        value() {
            this.mount();
        },
    },
}
</script>

<template>
<div class="numberpicker" :class="`numberpicker--${type}`" @keydown.esc="hide">
    <input type="text" :placeholder="placeholder" autocomplete="off" readonly
        @click="show" ref="input" :value="text"
    />
    <ul :class="is_visible ? 'visible' : ''" v-closable="{exclude:['input'], handler: 'hide'}">
        <li v-for="i in current_range" :key="i" @click="select(i)" :class="i == current_value ? 'selected' : ''">
            <template v-if="type == 'month'">
                {{ i | number_to_month }}
            </template>
            <template v-else>
                {{ i | leading_zero }}
            </template>
        </li>
    </ul>
</div>
</template>
