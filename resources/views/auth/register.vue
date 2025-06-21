<template xmlns:v="http://www.w3.org/1999/xhtml">
    <div class="registration-container">
        <h2 class="">Register</h2>

        <div class="form-group">
            <label>Name</label>
            <input v-model="form.name" type="text" required />
      </div>

        <div class="form-group">
            <label>Email</label>
            <input v-model="form.email" type="text" required />
        </div>
        <div class="form-group">
            <label>Password</label>
            <input v-model="form.password" type="password" required />
        </div>
    </div>
</template>
<script>
 import { ref } from 'vue';

</script>
<style scoped>
.registration-container {
    display: flex;
    align-items: center;
    justify-content: center;
    max-width: 400px;
    background: #fff;
    border-radius: 1px;
    padding: 2rem;
}
.form-group {
    margin-bottom: 1rem;
}
.h2 {
    color: #0a0a0a;
    font-size: 24px;
}

</style>
