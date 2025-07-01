<template>
    <h2 class="h2">Login</h2>
    <div class="registration-container">

        <form @submit.prevent="submit-details">
          <div class="form-group">
              <label> Email</label>
              <input v-model="form.email" type="text" required />
          </div>
            <div class="form-group">
                <label> Password</label>
                <input v-model="form.password" type="password" required />
            </div>
            <button type="submit" class="login-button">Login</button>
        </form>
        <router-link to="register"> Register an Account</router-link>
    </div>
</template>
<script>
import { ref } from 'vue';
import { reactive } from 'vue';
import { useRouter } from 'vue-router';

export default {
    setup() {
        const router = useRoiter();
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
}
</style>
