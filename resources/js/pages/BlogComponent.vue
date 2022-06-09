<template>
  <div class="container">
    <div class="row">
      <div class="col-12 text-center">BLOG</div>
      <div v-for="(post, index) in posts" :key="index" class="col-12">
        {{ post.title }}
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "BlogComponent",
  data() {
    return {
      posts: [],
    };
  },
  mounted() {
    axios
      .get("http://127.0.0.1:8000/api")
      .then((result) => {
        this.posts = result.data;
      })
      .catch((error) => console.log(error));
  },
};
</script>

<style>
</style>
