<template>
    <div class="listing-card">
        <img :src="'/${listing.image}'" :alt="listing.name" class="image">
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
    height: 50px;
    width: 50px;
    margin: 100px auto;
    background-color: white;
    display: flex;
    border-radius: 50px;
}
.image {
    border-radius: 50px;
}
</style>
