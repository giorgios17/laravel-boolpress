<template>
  <header>
    <nav>
      <ul>
        <li>
          <router-link :to="{ name: 'home' }">Home</router-link>
        </li>
        <li>
          <router-link :to="{ name: 'blog' }">Blog</router-link>
        </li>
        <li>
          <router-link :to="{ name: 'contacts' }">Contacts</router-link>
        </li>
      </ul>
    </nav>
  </header>
</template>

<script>
export default {
  name: "HeaderComponent",
};
</script>

<style>
</style>
