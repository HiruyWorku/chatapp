<template>
  <div>
    <div v-for="message in messages" :key="message.id" class="message">
      <strong>{{ message.user.name }}:</strong> {{ message.message }}
    </div>
  </div>
</template>

<script setup>
defineProps({
  messages: Array
});
</script>

<style scoped>
.message {
  margin-bottom: 10px;
}
</style>
