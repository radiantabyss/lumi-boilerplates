<script>
export default {
    name: 'Table',
    props: {
        params: {
            type: Object,
            required: false,
            default() {
                return {};
            }
        },
    },
    data() {
        return {
            url: '/crud',
            item_name: 'Crud Item',
            items: false,
            total: false,
            pages: false,
            loading: true,
        }
    },
    methods: {
        mount() {
            this.loading = true;
            Request.get(this.url, this.params)
            .then(data =>  {
                this.items = data.items;
                this.total = data.total;
                this.pages = data.pages;
                this.loading = false;
            });
        },

        deleteItem(e) {
            Request.get(`${this.url}/delete/${e.id}`)
            .then(() => {
                this.items = Items.delete(this.items, e.id);
            });
        },
    },
    mounted() {
        this.mount();
    },
    watch: {
        params() {
            this.mount();
        }
    }
}
</script>

<template>
<div class="table-wrapper">
    <div class="loading-overlay" v-if="loading"><sprite id="request-spinner" /></div>

    <template v-if="items !== false">
        <template v-if="items.length">
            <pagination :pages="pages" :total="total" />
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 40px;"></th>
                        <th>Name</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in items" :key="item.id">
                        <td>
                            <miniburger>
                                <router-link :to="`${Domain.url()}/edit/${item.id}`">
                                    <sprite id="edit" /> Edit
                                </router-link>
                                <a @click="$modal.show('confirm-delete', {id: item.id})" class="color-red">
                                    <sprite id="trash" /> Delete
                                </a>
                            </miniburger>
                        </td>
                        <td>{{ item.name }}</td>
                    </tr>
                </tbody>
            </table>
            <pagination :pages="pages" :total="total" />
        </template>
        <template v-else>
            No {{ item_name }} found.
        </template>
    </template>

    <confirm-modal :type="`delete-${item_name}`" @confirm="deleteItem" :question="`Are you sure you want to delete this ${item_name}?`" />
</div>
</template>
