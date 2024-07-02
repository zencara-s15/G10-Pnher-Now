<script setup lang="ts">
import { ref } from 'vue'
import { useRoute, useRouter } from 'vue-router'

const showDropdown = ref(false)

function toggleDropdown() {
  showDropdown.value = !showDropdown.value
}

function closeDropdown() {
  showDropdown.value = false
}
</script>

<template>
  <header class="flex justify-between px-12 py-3 bg-white items-center">
    <!-- Logo -->
    <div class="flex items-center space-x-2">
      <Icon icon="skill-icons:devto-dark" style="font-size: 45px" />
      <span class="text-xl font-bold">I-KNOW</span>
    </div>

    <!-- Menu Items -->
    <nav class="d-flex justify-content-center">
      <a
        href="/post"
        class="font-weight-bold px-3 py-2 text-secondary rounded-lg text-decoration-none hover-text-red"
      >
        POST
      </a>
      <a
        href="/team"
        class="font-weight-bold px-3 py-2 text-secondary rounded-lg text-decoration-none hover-text-red"
      >
        TEAM
      </a>
      <a
        href="/projects"
        class="font-weight-bold px-3 py-2 text-secondary rounded-lg text-decoration-none hover-text-red"
      >
        PROJECT
      </a>
      <a
        href="/reports"
        class="font-weight-bold px-3 py-2 text-secondary rounded-lg text-decoration-none hover-text-red"
      >
        REPORT
      </a>
      <a
        href="/product"
        class="font-weight-bold px-3 py-2 text-secondary rounded-lg text-decoration-none hover-text-red"
      >
        PRODUCT
      </a>
      <a
        href="/history_user"
        class="font-weight-bold px-3 py-2 text-secondary rounded-lg text-decoration-none hover-text-red"
      >
        HISTORY USER
      </a>
    </nav>

    <!-- Sign In -->
    <div>
      <div class="px-4 py-2 rounded font-semibold">Sign In</div>
    </div>
  </header>
</template>

<style scoped>
.user {
  padding-left: 50px;
}
.hover-text-red:hover {
  color: red !important;
}
</style>
