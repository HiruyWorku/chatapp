<template>
  <div>
    <h1>Chat Room</h1>
    <ChatMessages :messages="messages" />
    <ChatForm @messageSent="fetchMessages" />
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import ChatMessages from './ChatMessages.vue'; 
import ChatForm from '@/components/ChatForm.vue';
import axios from 'axios';
import Echo from '@/lib/echo';

const messages = ref([]);

const fetchMessages = async () => {
    const response = await axios.get('/messages');
    messages.value = response.data;
};

onMounted(async () => {
    await fetchMessages();

    Echo.channel('chat')
        .listen('MessageSent', (e) => {
            messages.value.push(e.message);
            scrollToBottom();
        });
});

const scrollToBottom = () => {
    setTimeout(() => {
        window.scrollTo({
            top: document.body.scrollHeight,
            behavior: 'smooth'
        });
    }, 100);
};
</script>
