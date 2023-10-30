<script>
import Filters from './../Partials/Filters.vue';
import Table from './../Partials/Table.vue';

export default {
    metaInfo() {
        return {
            title: Domain.name(),
        }
    },
    components: { Filters, Table },
}
</script>

<template>
<div>
    <div class="page-title">
        <div>
            {{ Domain.name(true) }}
            <div class="crumbs">
                <router-link to="/"><sprite id="home" /></router-link>
                <sprite id="arrow-right" />
                <span>{{ Domain.name(true) }}</span>
            </div>
        </div>
        <router-link :to="`${Domain.url()}/new`" class="btn btn--auto btn--small">
            <sprite id="plus" /> New
        </router-link>
    </div>

    <div class="panel">
        <div class="panel__title">Filters</div>
        <Filters class="mb-20" />
    </div>

    <div class="panel">
        <Table :params="$route.query" />
    </div>
</div>
</template>
