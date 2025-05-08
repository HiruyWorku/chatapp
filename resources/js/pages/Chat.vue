<template>
  <div>
    <h1>Armadillo</h1>
    <ChatMessages :messages="messages" :current-user-id="userId" />
    <p v-if="typingUser" class="typing-indicator">{{ typingUser }}</p>
    <ChatForm @messageSent="fetchMessages" />
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import ChatMessages from '@/components/ChatMessages.vue';
import ChatForm from '@/components/ChatForm.vue';
import axios from 'axios';
import Echo from '@/lib/echo';

const messages = ref([]);
const userId = ref(null);
const typingUser = ref(null);

const fetchMessages = async () => {
  const response = await axios.get('/messages');
  messages.value = response.data;
};

const scrollToBottom = () => {
  setTimeout(() => {
    window.scrollTo({
      top: document.body.scrollHeight,
      behavior: 'smooth',
    });
  }, 100);
};

onMounted(async () => {
  await fetchMessages();
  scrollToBottom();

  const userResponse = await axios.get('/api/user');
  userId.value = userResponse.data.id;

  Echo.channel('chat')
    .listen('MessageSent', (e) => {
      messages.value.push(e.message);
      scrollToBottom();
    })
    .listen('UserTyping', (e) => {
      if (e.user.id !== userId.value) {
        typingUser.value = e.user.name + ' is typing...';
        setTimeout(() => {
          typingUser.value = null;
        }, 3000);
      }
    });
});
</script>

<style scoped>
.typing-indicator {
  font-size: 14px;
  font-style: italic;
  color: gray;
  margin: 10px 20px;
}
</style>
