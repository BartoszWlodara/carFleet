<template>
  <div class="home">
    <img alt="Vue logo" src="../assets/logo.png">
    <CarGrid />
  </div>
</template>

<script>
// @ is an alias to /src
import CarGrid from '@/components/CarGridComponent.vue'

export default {
  name: 'CarListView',
  components: {
    CarGrid
  }
}
</script>
