<template>
  <div>
      <h1>Dashboard</h1>
  </div>
</template>

<script>
export default {
    created() {
        if(this.$store.getters.getUser) {
            console.log(this.$store.getters.getUser);
        }
    }
}
</script>

<style>

</style>
