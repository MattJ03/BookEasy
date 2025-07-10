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
                <input type="file" accept="image/*" @change="onFileChange" class="image-listing" required>
            </div>
            <div class="form-group">
                <label><strong>Price </strong> </label>
                <input v-model="form.price" type="number" class="price-form" required>
            </div>
            <div class="form-group">
                <label><strong>Available to Book? </strong></label>
                <input v-model="form.availability" type="checkbox" value="yes">
            </div>
            <button type="submit">Submit</button>
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
const token = localStorage.getItem('token');
console.log("Token:", token);

const submitForm = async () => {
    const formData = new FormData();
    try {
        formData.append("name", form.name);
        formData.append("price", form.price);
        formData.append("availability", form.availability ? 1 : 0);
        formData.append("image_path", form.image);
        console.log(form.image);

        await axios.post("/api/listing", formData, {
            headers: {
                Authorization: `Bearer ${token}`,
                "Content-Type": "multipart/form-data",
                Accept: "application/json",
            }
        });

        await router.push("/home");
    } catch (err) {
        console.error(err);
        error.value = err.response?.data?.message || "Something went wrong";
    }
    }

    const onFileChange = (e) => {
    form.image = e.target.files[0];
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
    height: 20px;
}
.price-form {
    border-radius: 10px;
    background: #edf2f7;
    height: 20px;
}
.account-info {
    width: 30px;
    height: 30px;
    border-radius: 20px;
}
</style>

