<script>
export default {
    name: 'SpriteComponent',
    props: {
        id: {
            type: String,
            required: true,
        },
    }
}
</script>

<template>
<svg :class="`svg-${id}`"><use :xlink:href="`#${id}`"></use></svg>
</template>
