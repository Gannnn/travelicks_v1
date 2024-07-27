<template>
    <div class="relative">
      <div class="flex flex-row items-center gap-3" style="align-items:center;">
        <div class="
            flex
            justify-center
            align-middle
            rounded-full
            shadow-md
            border-[1px]
            border-neutral-200
            px-10
            py-1
        ">
          <div @click="showUserMenu = !showUserMenu" class="
              px-5 py-10
              flex
              items-center
              gap-3
              rounded-full
              cursor-pointer
              transition
          " style="padding: 15px;">
            <font-awesome-icon class="font-sm text-[#595959]" icon="fa-solid fa-bars" @click="showUserMenu = !showUserMenu" />
          </div>
          <div class="
              hidden
              md:block
          ">
            <Avatar @click="showUserMenu = !showUserMenu" />
          </div>
        </div>
      </div>
  
      <div v-if="showUserMenu" id="dropdown-user-menu" class="
          absolute
          rounded-xl
          shadow-lg
          bg-white
          w-[13vw]
          overflow-hidden
          top-20
          right-20
          text-sm
          z-50
          p-4
      ">
        <div class="flex flex-col cursor-pointer" v-if="!user" style="padding: 10px;">
          <MenuItem style="padding: 10px;" @click="toggleLoginForm" class="py-2 px-4 hover:bg-neutral-100 transition">Login</MenuItem>
          <MenuItem style="padding: 10px;" @click="toggleRegisterForm" class="py-2 px-4 hover:bg-neutral-100 transition">Sign up</MenuItem>
        </div>
        <div class="flex flex-col cursor-pointer" style="padding: 10px;" v-else>
          <div
            class="text-sm font-semibold py-3 px-4 hover:bg-neutral-100 transition cursor-pointer text-center border-b-2 border-neutral-200">
            <template v-if="user">
              {{ user.name }}
            </template>
          </div>
          <MenuItem style="padding: 10px;" @click="router.visit(route('dashboard.index'))" class="py-2 px-4 hover:bg-neutral-100 transition">Dashboard</MenuItem>
          <MenuItem style="padding: 10px;" @click="router.visit(route('listing.index'))" class="py-2 px-4 hover:bg-neutral-100 transition">Add Your Space</MenuItem>
          <MenuItem style="padding: 10px;" @click="logOut" class="py-2 px-4 hover:bg-neutral-100 transition">Logout</MenuItem>
        </div>
      </div>
  
      <LoginForm :showModal="showLoginForm" @closeLoginForm="closeLoginForm" />
      <RegisterForm :showModal="showRegisterForm" @closeRegisterForm="closeRegisterForm" />
    </div>
  </template>
  
  <script setup>
  import { onMounted, onUnmounted, ref } from 'vue';
  import { router, usePage } from '@inertiajs/vue3'
  import { useNotification } from '@/Stores/notification.js';
  
  import Avatar from '@/Components/Avatar.vue';
  import MenuItem from '@/Components/navbar/MenuItem.vue';
  import LoginForm from '../auth/LoginForm.vue';
  import RegisterForm from '../auth/RegisterForm.vue';
  
  const store = useNotification();
  const user = usePage().props.auth.user;
  
  const showUserMenu = ref(false);
  const showLoginForm = ref(false);
  const showRegisterForm = ref(false);
  
  function toggleLoginForm() {
    showLoginForm.value = true;
    showUserMenu.value = false;
  }
  
  const closeLoginForm = () => showLoginForm.value = false;
  
  function toggleRegisterForm() {
    showRegisterForm.value = true;
    showUserMenu.value = false;
  }
  
  const closeRegisterForm = () => showRegisterForm.value = false;
  
  function logOut() {
  router.visit(route('app.logout'), { method: 'post' })
    .then(() => {
      store.addToast({ message: 'Success' });
      router.visit(route('home'));
    })
    .catch((error) => {
      store.addToast({ message: 'Logout failed', type: 'error' });
      console.error(error);
    });
}

  onMounted(() => {
    window.addEventListener("click", closeDropdown);
  });
  
  onUnmounted(() => {
    window.removeEventListener("click", closeDropdown);
  });
  
  function closeDropdown(e) {
    if (showUserMenu.value && !e.target.closest('#dropdown-user-menu') && !e.target.closest('.navbar')) {
      showUserMenu.value = false;
    }
  }
  </script>
  
  <style scoped>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }
  
  body {
    font-family: Poppins;
    height: 100vh;
    display: grid;
    place-items: center;
  }
  
  .parallax-image {
    display: block;
    height: 58.75rem;
    width: 100%;
    background-size: cover;
    background-attachment: fixed;
    background-position: center;
    position: relative; /* Ensure proper stacking context */
    z-index: 1; /* Ensure parallax images are below the navbar */
  }
  
  .parallax-image-01 {
    background-image: url("assets/autumn_forest.jpg");
  }
  
  .parallax-image-02 {
    background-image: url("assets/forest_pathway.jpg");
  }
  
  .parallax-image-03 {
    background-image: url("assets/winter_forest.jpg");
  }
  
  section {
    padding: 4rem;
  }
  
  section > h2 {
    text-transform: uppercase;
    margin-bottom: 1.5rem;
  }
  
  .navbar {
    width: 100%;
    position: fixed;
    top: 0;
    right: 0;
    z-index: 1000; /* Ensure it's above other content */
    background-color: rgba(255, 255, 255, 0.5); /* Transparent background */
    backdrop-filter: blur(1px); /* Add blur effect */
  }
  </style>
  