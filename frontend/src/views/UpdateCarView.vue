<template>
    <div>
        {{ $route.params.id }}
        <CarFormComponent />
    </div>
</template>
<script>
import CarFormComponent from '../components/CarFormComponent.vue'

export default {
    name: 'UpdateCarView',
    components: {
        CarFormComponent
    }
}
</script>