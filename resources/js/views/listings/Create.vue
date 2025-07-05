<template>
    <div class="create-form">
        <h2>Create Listing</h2>
        <form @submit.prevent=""
    </div>

</template>
<script setup>
import { ref } from 'vue';
import { reactive } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';

const router = useRouter();
const error = ref('');
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
    }
}
</script>
<style>
.create-form {
    width: 400px;
    height: 500px;
    margin: 100px auto;
    justify-content: center;
    align-items: center;
}
</style>

