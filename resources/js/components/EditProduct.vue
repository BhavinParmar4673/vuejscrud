<template>
    <div>
        <h3 class="text-center">Edit Product</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateProduct" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" v-model="product.title">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" v-model="product.description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Product Image</label>
                        <input type="file" name="path" class="form-control-file" v-on:change="onImageChange">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                product: {},
            }
        },
        created() {
            this.axios
                .get(`http://localhost:8000/api/products/${this.$route.params.id}`)
                .then((res) => {
                    this.product = res.data;
                });
        },
        methods: {
            onImageChange(e){
                 e.target.files[0];
            },
            updateProduct() {
                let formData = new FormData();

                this.axios
                    .patch(`http://localhost:8000/api/products/${this.$route.params.id}`,this.product)
                    .then((res) => {
                        this.$router.push({ name: 'home' });
                    });
            }
        }
    }
</script>
