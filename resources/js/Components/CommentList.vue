<template>
  <div class="comment-list">
    <div v-for="(comment, index) in comments" :key="index" class="comment-item">
      <p>{{ comment.comment_text }} by {{ comment.user.name }}</p>
      <p>Posted on: {{ formatDate(comment.created_at) }}</p>
    </div>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';
import moment from 'moment';

const props = defineProps({
  comments: {
    type: Array,
    required: true
  }
});

const formatDate = (date) => {
  return moment(date).format('MMMM Do YYYY, h:mm:ss a');
};
</script>

<style scoped>
.comment-list {
  margin-top: 20px;
}
.comment-item {
  background: whitesmoke;
  padding: 10px;
  margin-bottom: 10px;
  border-radius: 4px;
}
.comment-item p {
  margin: 0;
}
</style>
