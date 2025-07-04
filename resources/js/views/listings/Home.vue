<template>
<div class="listings">
    <p v-if="loading">...</p>
    <p v-else-if="!listings">Currently no listings</p>
    <div v-else class="listing-grid">
    <ListingCard v-for="listing in listings" :key="listing.id" :listing="listing">
    </ListingCard>
    </div>
</div>
</template>
<script setup>
import { ref } from 'vue';
import { reactive } from 'vue';
import { useRouter } from 'vue-router';
import ListingCard from "../../components/ListingCard.vue";
import { onMounted } from 'vue';
import axios from 'axios';

const router = useRouter();
const listings = ref([]);
const loading = ref(true);
const error = ref('');

onMounted(async () => {
    try {
        const response = await axios.get('/api/listings/index');
        listing.value = response.data;
    } catch(error) {
        error.value = error.response.data.errors;
    } finally {
        loading.value = false;
    }
});
</script>

<style>
.listings {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}
.listing-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
}
</style>
