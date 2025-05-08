<template>
  <div class="chat-container">
    <div
      v-for="message in props.messages"
      :key="message.id"
      class="message-wrapper"
      :class="{ 'sent': message.user_id === props.currentUserId, 'received': message.user_id !== props.currentUserId }"
    >
      <div class="message-bubble">
        <div class="sender-name">{{ message.user.name }}</div>
        <div class="message-text">{{ message.message }}</div>
        <div class="message-timestamp">{{ formatTimestamp(message.created_at) }}</div>
      </div>
    </div>
  </div>
</template>

<script setup>
const props = defineProps({
  messages: Array,
  currentUserId: Number,
});

const formatTimestamp = (timestamp) => {
  const date = new Date(timestamp);
  return date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
};
</script>

<style scoped>
.chat-container {
  display: flex;
  flex-direction: column;
  gap: 10px;
  padding: 20px;
}

.message-wrapper {
  display: flex;
  width: 100%;
}

.sent {
  justify-content: flex-end;
}

.received {
  justify-content: flex-start;
}

.message-bubble {
  max-width: 60%;
  padding: 12px 16px;
  border-radius: 16px;
  word-break: break-word;
}

.sent .message-bubble {
  background-color: #4CAF50;
  color: white;
  text-align: right;
}

.received .message-bubble {
  background-color: #e5e5ea;
  color: black;
  text-align: left;
}

.sender-name {
  font-size: 12px;
  font-weight: bold;
  margin-bottom: 5px;
  opacity: 0.7;
}

.message-text {
  font-size: 16px;
}

.message-timestamp {
  font-size: 10px;
  color: gray;
  margin-top: 4px;
  opacity: 0.7;
}
</style>