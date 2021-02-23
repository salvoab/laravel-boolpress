<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" v-for="category in categories" :key="category.id">
                    <div class="card-header">Nome Categoria: {{ category.name }}</div>

                    <div class="card-body">
                        <p>Descrizione: {{ category.description }} </p>
                    </div>

                    <div class="card-footer">
                        Creata il: {{ new Date(category.created_at).toLocaleString('it') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                categories: []
            }
        },
        mounted() {
            axios.get('api/categories')
            .then(response => {
                //console.log(response.data.data);
                this.categories = response.data.data;
            })
            .catch(error => { console.log(error) })
        }
    }
</script>

<style scoped>
    .card{
        margin: 12px 0;
    }
</style>