<template>
<div class="listings">
    <p v-if=""

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
const listings = reactive({});
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



</style>
