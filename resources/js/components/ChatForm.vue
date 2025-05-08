<template>
  <form @submit.prevent="sendMessage">
    <input
      v-model="newMessage"
      type="text"
      placeholder="Type your message..."
      class="input"
    />
    <button type="submit" class="button">Send</button>
  </form>
</template>

<script setup>
import { ref, watch } from 'vue';
import axios from 'axios';

const newMessage = ref('');
const emit = defineEmits(['messageSent']);

watch(newMessage, async (newVal) => {
  if (newVal.trim() !== '') {
    await axios.post('/typing');
  }
});

const sendMessage = async () => {
  if (newMessage.value.trim() === '') {
    return;
  }
  await axios.post('/send-message', { message: newMessage.value });
  emit('messageSent');
  newMessage.value = '';
};
</script>

<style scoped>
.input {
  padding: 10px;
  width: 80%;
  margin-right: 10px;
}

.button {
  padding: 10px;
}
</style>