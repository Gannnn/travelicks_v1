<template>
  <Head :title="title" />
  <Sidebar class="sidebar" :is_admin="$page.props.is_admin" />
  <Container class="main-content">
    <slot></slot>
  </Container>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import Sidebar from '@/Components/Sidebar.vue';
import Container from '../Components/Container.vue';

const props = defineProps({
  title: {
    type: String,
    required: true
  }
});
</script>
