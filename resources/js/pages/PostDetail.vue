<template>
  <div>pagina dettaglio</div>
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
    const slug = this.$route.params.slug;
    axios
      .get("http://127.0.0.1:8000/api/" + slug)
      .then((result) => {
        this.post = result.data;
      })
      .catch((error) => console.log(error));
  },
};
</script>

<style>
</style>
