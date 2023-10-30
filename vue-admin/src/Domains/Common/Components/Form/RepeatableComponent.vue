<script>
export default {
    name: 'RepeatableComponent',
    props: {
        value: {
            type: Array,
            required: false,
            default: () => {
                return [];
            },
        },
        inputs: {
            type: Object,
            required: true,
        },
        name: {
            type: String,
            required: false,
            default: '',
        },
        show_labels: {
            type: Boolean,
            required: false,
            default: false,
        },
    },
    data() {
        return {
            items: this.value || [],
        }
    },
    methods: {
        add() {
            let item = {};
            for ( let input_name in this.inputs )  {
                let input = this.inputs[input_name];

                if ( input.type == 'select' ) {
                    let options = input.options_are_grouped ? input.options[Object.keys(input.options)[0]] : input.options;
                    item[input_name] = input.options_have_text ? Object.keys(options)[0] : options[0];
                }
                else {
                    item[input_name] = '';
                }
            }

            this.items.push(item);
        },

        remove(i) {
            this.items.splice(i, 1);
        },

        removeAll() {
            this.items = [];
        },
    },
    watch: {
        items() {
            this.$emit('input', this.items);
        }
    },
}
</script>

<template>
<div>
    <div class="grid" v-if="show_labels && items && items.length">
        <div v-for="(input, input_name) in inputs" :key="input_name">
            <div :class="input.input_css_class ? input.input_css_class : ''">{{ input_name | to_words }}</div>
        </div>
        <div></div>
    </div>

    <template v-if="items && items.length">
        <div class="grid items-center mb-10" v-for="(item, i) in items" :key="item.id">
            <div v-for="(input, input_name) in inputs" :key="input_name" :class="input.css_class">
                <input type="text" class="input"
                    :class="input.input_css_class ? input.input_css_class : ''"
                    :key="input_name"
                    :placeholder="input.placeholder"
                    v-model="item[input_name]"
                    v-if="input.type == 'text'"
                />

                <select class="input"
                    :class="input.input_css_class ? input.input_css_class : ''"
                    :key="input_name"
                    v-model="item[input_name]"
                    v-else-if="input.type == 'select'"
                >
                    <template v-if="input.options_are_grouped">
                        <optgroup v-for="(options, group) in input.options" :key="group" :label="$options.filters.to_words(group)">
                            <option v-for="(text, value) in options" :key="value" :value="input.options_have_text ? value : text">
                                {{ input.options_have_text ? text : $options.filters.to_words(text) }}
                            </option>
                        </optgroup>
                    </template>
                    <template v-else>
                        <option v-for="(text, value) in input.options" :key="value" :value="input.options_have_text ? value : text">
                            {{ input.options_have_text ? text : $options.filters.to_words(text) }}
                        </option>
                    </template>
                </select>

                <autocomplete v-if="input.type == 'autocomplete'"
                    :class="input.input_css_class ? input.input_css_class : ''"
                    :text="value[i][input.text_key]"
                    :domain="input.autocomplete_settings.domain"
                    :url="input.autocomplete_settings.url || ''"
                    :limit="input.autocomplete_settings.limit || 20"
                    :search_params="input.autocomplete_settings.search_params || {}"
                    :placeholder="input.autocomplete_settings.placeholder || ''"
                    :autosearch="input.autocomplete_settings.autosearch || false"
                    :autosearch_limit="input.autocomplete_settings.autosearch_limit || 10"
                    :enable_modal="input.autocomplete_settings.enable_modal || false"
                    :can_create="input.autocomplete_settings.can_create || false"
                    v-model="item[input_name]"
                />
            </div>

            <div class="col-10">
                <a class="icon-link-small" @click="remove(i)"><sprite id="trash" class="color-red" /></a>
            </div>
        </div>
    </template>

    <a @click="add" class="btn btn--auto btn--small mt-10"><sprite id="plus"/> Add {{ name }}</a>
</div>
</template>
