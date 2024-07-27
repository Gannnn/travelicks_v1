<template>
  <div class="top-bar">
    <a 
      v-for="(link, index) in filtered_links" 
      :key="index" 
      :href="link.href" 
      :class="{ active: active_index === link.active }"
      @click.prevent="handleClick(link.href, link.active)">
      <span class="text">{{ link.name }}</span>
    </a>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import { useRouter } from 'vue-router';

const props = defineProps({
  is_admin: {
    type: Boolean,
    required: true
  }
});

const router = useRouter();

const client_links = ref([
  { name: 'Home', href: '/home', active: 0 },
  { name: 'Dashboard', href: '/dashboard', active: 1 },
  { name: 'Listings', href: '/dashboard/listings', active: 2 },
  { name: 'Reservations', href: '/dashboard/reservations', active: 3 },
]);

const admin_links = ref([
  ...client_links.value,
  { name: 'Admin Dashboard', href: '/admin/dashboard/listings', active: 4 }
]);

const active_index = ref(parseInt(localStorage.getItem('active_index')) || 1);

const filtered_links = computed(() => {
  return props.is_admin ? admin_links.value : client_links.value;
});

onMounted(() => {
  let current_active_index = parseInt(localStorage.getItem('active_index'));
  if (isNaN(current_active_index) || current_active_index === 0) {
    current_active_index = 1;
  }
  active_index.value = current_active_index;
});

function handleClick(href, active_index) {
  setActive(active_index);
  if (href !== '#') {
    window.location.href = href;  
  }
}

function setActive(index) {
  active_index.value = index;
  localStorage.setItem('active_index', index);
}
</script>

<style scoped>
.top-bar {
  margin: 0;
  padding: 0;
  height: 50px;
  width: 100%;
  position: fixed;
  top: 0;
  left: 0;
  background-color: #000011;
  overflow: auto;
  transition: width 0.3s ease;
  display: flex;
  justify-content: space-around;
  align-items: center;
}

.top-bar a {
  text-decoration: none;
  display: flex;
  align-items: center;
  padding: 0 18px;
  height: 100%;
  color: #fff;
}

.top-bar a.active {
  color: #f73d76;
}

.top-bar > a:hover:not(.active) {
  background-color: #403b3b;
}

div.content {
  margin-top: 50px;
  padding: 40px;
  height: 100vh;
  transition: margin-top 0.3s ease; 
}

@media screen and (max-width: 768px) {
  .top-bar a .text {
    display: none; 
  }
}
</style>
