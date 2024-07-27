<template>
  <div class="comment-form">
    <textarea v-model="newComment" placeholder="Write a review..." rows="4"></textarea>
    <DangerButton  @click="submitComment" :class="{ 'opacity-25': btnDisabled }" class="w-full" :disabled="btnDisabled" v-if="$page.props.auth.user">
      Submit
    </DangerButton>
    <DangerButton class="w-full opacity-25 cursor-not-allowed" v-else>Log in to Review</DangerButton>
  </div>
</template>

<script setup>
import { ref, defineProps, defineEmits } from 'vue';
import DangerButton from '@/Components/DangerButton.vue';

const btnDisabled = ref(false);
const emit = defineEmits(['add-comment']);
const newComment = ref('');

const props = defineProps({
  listingId: {
    required: true
  },
  isAuthenticated: {
    type: Boolean,
    required: true
  }
});

const submitComment = async () => {
  try {
    const response = await axios.post('/comments', {
      listingId: props.listingId,
      comment_text: newComment.value,
    });
    emit('add-comment', response.data);
    newComment.value = '';
  } catch (error) {
    console.error("There was an error submitting the review:", error);
  }
};
</script>

<style scoped>
.comment-form {
  display: flex;
  flex-direction: column;
}
textarea {
  margin-bottom: 10px;
  padding: 10px;
  font-size: 14px;
}
button {
  align-self: center;
  padding: 10px 20px;
  background-color: #42b983;
  color: white;
  border: none;
  cursor: pointer;
}
button:disabled {
  background-color: #ccc;
  cursor: not-allowed;
}
.text-red-500 {
  color: red;
  margin-top: 10px;
}
</style>
