<template>
    <div class="container">
        <ul class="list-group">
            <li class="list-group-item" v-for="task in tasks.data" :key="task.id">
                <p>{{ task.name }}</p>
            </li>
        </ul>
        <pagination :data="tasks" @pagination-change-page="getResults" class="mt-5"></pagination>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                tasks: {},
            }
        },

        created(){
            axios.get('http://journal-de-bord.test/todo')
                //promesse attend les data de la bdd
                // .response(response => console.log(response))
                .then(response => this.tasks = response.data)
                .catch(error => console.log(error));
        },

        methods: {
            // Our method to GET results from a Laravel endpoint
            getResults(page = 1) {
                axios.get('http://journal-de-bord.test/todo?page=' + page)
                    .then(response => {
                    this.tasks = response.data;
                });
            },
        },

        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
