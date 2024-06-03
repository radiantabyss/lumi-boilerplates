<script>
export default {
    name: 'GateComponent',
}
</script>

<template>
<z v-if="Gate.allows(Object.keys(this.$attrs)[0], this.$attrs[Object.keys(this.$attrs)[0]])">
    <slot />
</z>
</template>
