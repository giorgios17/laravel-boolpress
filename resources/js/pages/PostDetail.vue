<template>
  <div class="container">
    <div v-if="post">
      {{ post }}
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
    this.getPost();
  },
  methods: {
    getPost() {
      const id = this.$route.params.id;
      console.log("parametro id" + id);
      window.axios
        .get("http://127.0.0.1:8000/api/posts" + { params: { id: 2 } })
        .then(({ status, data }) => {
          console.log("data?", data);
          if (status === 200 && data.success) this.post = data.result;
          console.log(this.post);
        })
        .catch((e) => console.log(e));
    },
  },
};
</script>

<style>
</style>
