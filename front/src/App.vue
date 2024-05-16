<template>
    <MainPage></MainPage>
</template>

<script>
import MainPage from "@/pages/MainPage.vue";

export default {
  name: 'App',
  components: {
    MainPage,
  }
}
</script>

<style>
@import "bootstrap";
#app {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: 60px;
}
</style>
