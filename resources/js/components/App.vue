<template>
    <div>
        <router-view></router-view>
    </div>
</template>

<script>
export default {
    mounted: function() {
        console.log(this.$store.state.user.name);
    }
}
</script>
