<template>
    <div>
        <bootstrap-4-datatable :columns="columns" :data="rows" :filter="filter" :per-page="perPage"></bootstrap-4-datatable>
        <bootstrap-4-datatable-pager v-model="page" type="abbreviated"></bootstrap-4-datatable-pager>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                columns: [{
                        label: 'id',
                        field: 'id'
                    },
                    {
                        label: 'Title',
                        field: 'title'
                    },
                    {
                        label: 'Description',
                        field: 'description'
                    },
                ],
                rows: [],
                page: 1,
                filter:  '',
                perPage: 12,
            }
        },
        methods: {
            showProduct: function () {
                axios.get('http://localhost:8000/api/products/').then(function (res) {
                    this.rows = res.data;
                }.bind(this));
            }
        },
        created: function () {
            this.showProduct()
        }
    }

</script>
