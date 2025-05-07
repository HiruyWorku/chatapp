<template>
  <form @submit.prevent="sendMessage" class="chat-form">
    <input
      v-model="newMessage"
      type="text"
      placeholder="Type your message..."
      class="chat-input"
    />
    <button type="submit" class="send-button">Send</button>
  </form>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';

const newMessage = ref('');

const emit = defineEmits(['messageSent']);

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
.chat-form {
  display: flex;
  align-items: center;
  gap: 10px;
  background-color: #222;
  padding: 10px;
  border-radius: 8px;
}

.chat-input {
  flex: 1;
  padding: 10px;
  border-radius: 6px;
  border: none;
  outline: none;
  background-color: #333;
  color: white;
}

.send-button {
  padding: 10px 16px;
  background-color: #4CAF50;
  border: none;
  border-radius: 6px;
  color: white;
  font-weight: bold;
  cursor: pointer;
}

.send-button:hover {
  background-color: #45a049;
}
</style>
