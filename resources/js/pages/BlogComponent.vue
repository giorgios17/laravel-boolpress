<template>
  <div class="container">
    <div class="row">
      <div class="col-12 text-center">BLOG</div>
      <div v-for="post in posts" :key="post.id" class="col-12">
        <div class="card" style="width: 18rem">
          <div class="card-body">
            <div v-if="post.cover">
              <img
                :src="'storage/' + post.cover"
                class="card-img-top"
                alt="..."
              />
            </div>
            <h5 class="card-title">
              {{ post.title }}
            </h5>
            <router-link
              :to="{ name: 'postDetail', params: { id: post.id } }"
              class="nav-link"
              >Visualizza post</router-link
            >
          </div>
        </div>
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
      .get("http://127.0.0.1:8000/api/posts")
      .then((results) => {
        this.posts = results.data;
      })
      .catch((error) => console.log(error));
  },
};
</script>

<style>
</style>
