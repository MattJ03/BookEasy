<template>

    <div class="registration-container">
        <h2 class="h2">Login</h2>
        <form @submit.prevent="loginDetails">
          <div class="form-group">
              <label><strong>Email </strong></label>
              <input v-model="form.email" type="text" required />
          </div>
            <div class="form-group">
                <label><strong> Password </strong></label>
                <input v-model="form.password" type="password" required />
            </div>
            <button type="submit" class="login-button">Login</button>
        <router-link to="register"> Register an Account</router-link>
        </form>
    </div>
</template>
<script>
import { ref } from 'vue';
import { reactive } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';
export default {
    setup() {
        const router = useRouter();

        const error = ref(null);
        const form = reactive({
            email: '',
            password: '',
        });

        const loginDetails = async () => {
            try {
                await axios.get('sanctum/csrf-cookie');
                await axios.post('/api/login', form);
                await router.push('/home');
            } catch (error) {
                error.value = error.response.data.error;
            }
        }
        return {
            form,
            loginDetails,
            error,
        }
    }
}

</script>
<style>
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
.h2 {
    color: #0a0a0a;
    font-size: 24px;
    justify-content: center;
    align-items: center;
    text-align: center;
}
.form-group {
    margin-bottom: 1rem;
    border-radius: 10px;
}
.login-button {
    height: 30px;
    width: 70px;
    border: none;
    border-radius: 4px;
}
.login-button:hover {
    background-color: #4a5568;
}
</style>
