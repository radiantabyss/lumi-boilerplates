<script>
export default {
    name: 'PermissionComponent',
}
</script>

<template>
<z v-if="Gate.allows('permission', this.$attrs)">
    <slot />
</z>
</template>
