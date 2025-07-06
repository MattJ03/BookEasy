<template>
    <nav-bar>

    </nav-bar>
    <div class="create-form">
        <h2 class="h2">Create Listing</h2>
        <form @submit.prevent="submitForm">
            <div class="form-group">
                <label><strong>Name of property </strong></label>
                <input v-model="form.name" type="text" class="name-form" required>
            </div>
            <div class="form-group">
                <label><strong>Image of property </strong></label>
                <input type="file" accept="image/*" class="image-listing" required>
            </div>
            <div class="form-group">
                <label><strong>Price </strong> </label>
                <input v-model="form.price" type="number" class="price-form" required>
            </div>
            <div class="form-group">
                <label><strong>Available to Book? </strong></label>
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
import NavBar from '../../components/NavBar.vue'

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
    border-radius: 14px;
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

}
.h2 {
    justify-content: center;
}
.name-form {
    border-radius: 10px;
    background: #edf2f7;
}
.price-form {
    border-radius: 10px;
    background: #edf2f7;
}
.account-info {
    width: 30px;
    height: 30px;
    border-radius: 20px;
}
</style>

