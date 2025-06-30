<template>
    <h2 class="h2">Register</h2>
    <div class="registration-container">

         <form @submit.prevent="submitDetails" >
        <div class="form-group">
            <label>Name </label>
            <input v-model="form.name" type="text" required />
      </div>
        <div class="form-group">
            <label>Email </label>
            <input v-model="form.email" type="text" required />
        </div>
        <div class="form-group">
            <label>Password </label>
            <input v-model="form.password" type="password" required />
        </div>
        <button type="submit" class="submit-button">Register</button>
        <router-link to="login">  Already have an account?</router-link>
         </form>
    </div>
</template>
<script>
 import { ref } from 'vue';
 import { reactive } from 'vue';
 import { useRouter } from 'vue-router';

 export default {
     setup() {
         const router = useRouter();

         const form = reactive({
             name: "",
             email: "",
             password: "",
         });
         const error1 = ref(null);

         const submitDetails = async () => {
             try {
                 await axios.post('/api/register', form);
                 router.push('/login');
             } catch (error) {
                 error1.value = error.response?.data?.error || 'Registration Failed';
             }
         }
         return {
             form,
             error1,
             submitDetails,
         }
     }
 }
</script>
<style scoped>
.registration-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    max-width: 500px;
    background: #a7151d;
    color: #ffffff;
    border-radius: 12px;
    padding: 2rem;
    text-align: left;
    margin: 100px auto;
}
.form-group {
    margin-bottom: 1rem;
}
.h2 {
    color: #0a0a0a;
    font-size: 24px;
    justify-content: center;
    align-items: center;
    text-align: center;
}

.submit-button {
    background-color: #90D5FF;
    color: #1b1b18;
    border: none;
    border-radius: 4px;

}
.submit-button:hover {
    background-color: #4a5568;
}

</style>
