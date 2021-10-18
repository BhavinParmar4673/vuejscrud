<template>
    <div>
        <h3 class="text-center">Create Product</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addProduct" enctype="multipart/form-data">
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
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                product: {
                    title:'',
                    description:'',
                    path:''
                },
                success: ''
            }
        },
        methods: {
             onImageChange(e){
                this.product.path = e.target.files[0];
            },
            addProduct() {
                const config = {
                    headers: {
                    'content-type': 'multipart/form-data',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    }
                }
                let formData = new FormData();
                formData.append('title', this.product.title);
                formData.append('description', this.product.description);
                formData.append('path', this.product.path);

                this.axios.post('http://localhost:8000/api/products', formData,config)
                    .then(response => (
                        this.$router.push({ name: 'home' })
                    ))
                    .catch(err => console.log(err))
            }
        }
    }
</script>
