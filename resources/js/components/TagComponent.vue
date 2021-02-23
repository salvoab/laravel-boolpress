<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" v-for="tag in tags" :key="tag.id">
                    <div class="card-header">Nome Tag: {{ tag.name }}</div>

                    <div class="card-body">
                        <p>Descrizione: {{ tag.description }} </p>
                    </div>

                    <div class="card-footer">
                        Creato il: {{ new Date(tag.created_at).toLocaleString('it') }}
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
                tags: []
            }
        },
        mounted() {
            axios.get('api/tags')
            .then(response => {
                //console.log(response.data.data);
                this.tags = response.data.data;
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