<template>
    <div>
        <h1 class="text-center">Tutti gli articoli ricevuti tramite API</h1>
  
        <div class="card" v-for="article in articles" :key="article.id">
            <div class="card-header">{{ article.title }}</div>
        
            <div class="card-body">
                {{ article.body }}
            </div>
            
            <div class="card-footer">
                Creato il: {{ new Date(article.created_at).toLocaleString('it') }}
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                articles: []
            }
        },
        mounted() {
            axios.get('api/articles')
            .then(response => {
                //console.log(response.data.data);
                this.articles = response.data.data;
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