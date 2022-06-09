<template>
  <header>
    <nav>
      <ul class="nav bg-white">
        <li v-for="(menuItem, index) in menu" :key="index" class="nav-item">
          <router-link :to="{ name: menuItem.name }" class="nav-link">
            {{ menuItem.label }}
          </router-link>
        </li>
      </ul>
    </nav>
  </header>
</template>

<script>
export default {
  name: "HeaderComponent",
  data() {
    return {
      menu: [
        {
          name: "home",
          label: "Home",
        },
        {
          name: "blog",
          label: "Posts",
        },
        {
          name: "contacts",
          label: "Contatti",
        },
      ],
    };
  },
};
</script>

<style>
</style>
