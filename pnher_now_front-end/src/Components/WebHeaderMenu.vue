<script setup lang="ts">
import { Icon } from '@iconify/vue'
</script>

<template>
  <header class="flex justify-between px-12 py-3 bg-white items-center">
    <!-- Logo -->
    <div class="flex items-center space-x-2">
      <Icon icon="skill-icons:devto-dark" style="font-size: 45px" />
      <span class="text-xl font-bold">I-KNOW</span>
    </div>

    <!-- Menu Items -->
    <nav class="flex justify-center space-x-10">
      <a
        href="/post"
        class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900"
        >Post</a
      >
      <a
        href="/team"
        class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900"
        >Team</a
      >
      <a
        href="/projects"
        class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900"
        >Projects</a
      >
      <a
        href="/reports"
        class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900"
        >Reports</a
      >
      <a
        href="/product"
        class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900"
        >Product</a
      >
      <a
        href="/history_user"
        class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900"
        >User history</a
      >
    </nav>

    <!-- Log Out and User Profile -->
    <div class="d-flex justify-content user">
      <div class="px-4 py-2 rounded font-semibold">
        <a
          href="/Logout"
          class="font-bold text-slate-700 rounded-full flex items-center justify-center bg-danger"
          style="width: 40px; height: 40px; display: inline-flex"
        >
          <i class="bi bi-box-arrow-right text-white"></i>
        </a>
      </div>
      <div class="norma_user mt-1.5 dropdown">
        <button
          class="btn p-0"
          type="button"
          id="dropdownMenuButton"
          data-bs-toggle="dropdown"
          aria-expanded="false"
        >
          <img
            src="https://fcb-abj-pre.s3.amazonaws.com/img/jugadors/501_maradona.jpg"
            class="rounded-circle"
            width="40"
            height="40"
          />
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <li><a class="dropdown-item" href="#">Profile</a></li>
          <li><a class="dropdown-item" href="#">Settings</a></li>
          <li><a class="dropdown-item" href="#">Logout</a></li>
        </ul>
      </div>
    </div>
  </header>
</template>

<style>
.user {
  padding-left: 50px;
}
</style>
