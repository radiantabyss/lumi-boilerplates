<script>
export default {
    mounted() {
        this.$store.dispatch('Auth/logout')
        .then(() => {
            this.$router.push('/login');
        });
    },
}
</script>

<template>
<div>

</div>
</template>
