<template>
  <div>
    <CommentList :comments="comments" />
    <CommentForm @add-comment="handleAddComment" :isAuthenticated="isAuthenticated" :listingId="listingId" />
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import CommentForm from './CommentForm.vue';
import CommentList from './CommentList.vue';
import axios from 'axios';

const comments = ref([]);
const props = defineProps({
  listingId: {
    type: Number,
    required: true,
  },
  isAuthenticated: {
    type: Boolean,
    required: true,
  }
});

const fetchComments = async () => {
  const response = await axios.get(`/comments/${props.listingId}`);
  comments.value = response.data;
};

const handleAddComment = () => {
  fetchComments();
};

onMounted(() => {
  fetchComments();
});
</script>

<style scoped>
.comment-section {
  max-width: 600px;
  margin: auto;
}
</style>
