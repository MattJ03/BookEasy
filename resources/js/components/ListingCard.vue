<template>
    <div class="listing-card">
        <img :src="'/storage/${listing.image_path}'" :alt="listing.name" class="image">
        <h3>{{ listing.name }}</h3>
        <p><strong>{{ listing.price }}</strong></p>
        <p>{{ listing.id }}</p>
        <p v-if="listing.availability">Available</p>
        <p v-else>Unavailable</p>
    </div>
</template>
<script setup>
const { listing } = defineProps({
   listing: {
       type: Object,
       required: true,
   }
});

</script>
<style>
.listing-card {
    height: 300px;
    width: 200px;
    border: 2px solid lightgray;
    margin: 50px auto;
    background-color: white;
    flex-direction: column;
    display: flex;
    border-radius: 50px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);

}
.image {
    border-radius: 50px;

}
</style>
