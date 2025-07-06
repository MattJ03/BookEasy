<template>
    <div class="create-form">
        <h2 class="h2">Create Listing</h2>
        <form @submit.prevent="submitForm">
            <div class="form-group">
              <label>Image of property </label>
                <input type="file" accept="image/*" class="image-listing" required>
            </div>
            <div class="form-group">
                <label>Name of property </label>
                <input v-model="form.name" type="text" required>
            </div>
            <div class="form-group">
                <label>Price </label>
                <input v-model="form.price" type="number" required>
            </div>
            <div class="form-group">
                <label>Available to Book? </label>
                <input v-model="form.availability" type="checkbox" value="yes">
            </div>
        </form>
    </div>

</template>
<script setup>
import { ref } from 'vue';
import { reactive } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';

const router = useRouter();
const error = ref(null);
const form = reactive({
    name: "",
    price: "",
    availability: true,
    image: ""
});

const submitForm = async () => {
    try {
        await axios.post('/api/listings/store', form);
        await router.push('/home');
    } catch(error) {
        error.value = error.response.data.errors;
    }
}
</script>
<style>
.create-form {
    width: 800px;
    height: 800px;
    margin: 100px auto;
    justify-content: center;
    align-items: center;
    background: #a7151d;
    border-radius: 12px;
    padding: 2rem;
}
.image-listing {
    margin:  auto;
    display: flex;
    flex-direction: column;
    justify-content: left;
}
.form-group {
    margin-bottom: 3rem;
    border-radius: 10px;
    width: 50%;
    background: #edf2f7;
}
.h2 {
    justify-content: center;
}
</style>

