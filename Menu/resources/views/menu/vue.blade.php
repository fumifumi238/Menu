<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <title>Image Preview</title>
  </head>
  <body>
    <div id="app">
      <h1>@{{ message }}</h1>
      <div>
       <input type="file" ref="preview" @change="uploadFile">
       <div v-if="url">
  <img :src="url">
</div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script>
     new Vue({
        el: "#app",
        data() {
  return {
    message:"Try Preview!",
    url:""
  }
},
methods:{
  uploadFile(){
      const file = this.$refs.preview.files[0];
      this.url = URL.createObjectURL(file)
  }
}
      })
    </script>
  </body>
</html>