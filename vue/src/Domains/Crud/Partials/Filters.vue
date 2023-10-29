<script>
export default {
    name: 'Filters',
    mixins: [Mixins.Filters],
}
</script>

<template>
<div class="rows rows--filters">
    <a @click="clear" class="btn btn--small btn--outline clear-filters">Clear All Filters</a>

    <div class="row">
        <label>Name</label>
        <clearable v-model="fields.name" @input="submit" />
    </div>
</div>
</template>
