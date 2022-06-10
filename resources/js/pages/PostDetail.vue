<template>
  <div class="container">
    <div v-if="post">
      {{ post.title }}
    </div>
    <div v-else>
      <p>Caricamento in corso</p>
    </div>
  </div>
</template>

<script>
export default {
  name: "PostDetail",
  data() {
    return {
      post: undefined,
    };
  },
  mounted() {
    const id = this.$route.params.id;
    window.axios
      .get("http://127.0.0.1:8000/api/" + id)
      .then((data) => {
        this.post = data.results;
        console.log(this.post);
      })
      .catch((error) => console.log(error));
  },
};
</script>

<style>
</style>
