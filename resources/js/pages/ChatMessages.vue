<template>
  <div class="messages-container">
    <div
      v-for="message in messages"
      :key="message.id"
      :class="[
        'message-bubble',
        message.user_id === currentUserId ? 'sent' : 'received'
      ]"
    >
      <div class="sender-name">
        {{ message.user.name }}
      </div>
      <div class="message-text">
        {{ message.message }}
      </div>
    </div>
  </div>
</template>

<script setup>
defineProps({
  messages: Array,
  currentUserId: Number,
});
</script>

<style scoped>
.messages-container {
  display: flex;
  flex-direction: column;
  gap: 10px;
  overflow-y: auto;
  height: 100%;
}

.message-bubble {
  max-width: 70%;
  padding: 12px 16px;
  border-radius: 16px;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
  word-break: break-word;
}

.sent {
  background-color: #4CAF50; /* Green bubble */
  color: white; /* White text */
  margin-left: auto;
  text-align: right;
}

.received {
  background-color: #ffffff; /* White bubble */
  color: black; /* Black text */
  margin-right: auto;
  text-align: left;
}

.sender-name {
  font-size: 12px;
  font-weight: bold;
  margin-bottom: 4px;
  opacity: 0.8;
}

.message-text {
  font-size: 16px;
}
</style>
