<template>
    <div class="nav-bar">
        <router-link to="home">Home</router-link>
        <router-link to="create">Create</router-link>
    </div>
</template>
<style>
.nav-bar {
    display: flex;
    justify-content: space-between;
    background-color: #007BFF;
    padding: 1rem;
    color: white;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 1000;
}
</style>
