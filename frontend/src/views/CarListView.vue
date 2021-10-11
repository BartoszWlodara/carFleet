<template>
  <div>
    <router-link to="/addCar" tag="button" class="addNewCarBTN">Add New</router-link>
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
<style scoped>
.addNewCarBTN{
  padding: 14px;
  width: 200px;
  border-radius: 8px;
  border: none;
  background-color: #455457;
  color: #ffffff;
  margin-top: 40px;
  box-shadow: 0px 2px 7px -3px #000000;
  cursor: pointer;
  transition: .3s;
}
.addNewCarBTN:hover{
  transform: scale(1.1);
  background-color: #556b6f;
}
</style>