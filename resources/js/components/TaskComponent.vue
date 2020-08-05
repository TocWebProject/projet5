<template>
    <div class="container">
        <div class="form-row">
            <div class="col-row">
                <add-task-component @task-added="refresh"></add-task-component>
            </div>
            <div class="col-row">
                <input type="text" class="form-control my-3" @keyup="searchTask" v-model="searchQ" placeholder="Rechercher une tâche">
            </div>
        </div>    
        <ul class="list-group mt-2">
            <li class="list-group-item" v-for="task in tasks.data" :key="task.id">
                <div class="d-flex justify-content-between align-self-center">
                    <a href="#" class="align-self-center text-wrap mr-3">{{task.name}}</a>
                    <div class="d-flex justify-content-arround">
                        <div class="btn-group-vertical ml-2">
                            <button type="button" class="btn-sm btn-primary m-1" data-toggle="modal" data-target="#editModal" @click="getTask(task.id)" title="Modifier">
                                <i class="far fa-edit m-1"></i>
                            </button>
                            <button type="button" class="btn-sm btn-secondary m-1" @click="deleteTask(task.id)" title="Supprimer"><i class="far fa-trash-alt m-1"></i></button>    
                        </div>                        
                    </div>
                </div>
            </li>
            <modify-task-component v-bind:taskToEdit="taskToEdit" @task-updated="refresh"></modify-task-component>
        </ul>
        <pagination :data="tasks" @pagination-change-page="getResults" class="mt-5"></pagination>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                tasks: {},
                taskToEdit:'',
                searchQ:''
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

            getTask(id){
                axios.get('http://journal-de-bord.test/tasks/modify/' + id)
                    //.then(response => console.log(response.data))
                    .then(response => this.taskToEdit = response.data)
                    .catch(error => console.log(error));
            },

            deleteTask(id){
                axios.delete('http://journal-de-bord.test/tasks/' + id)
                    .then(response => this.tasks = response.data)
                    .catch(error => console.log(error));
            },

            searchTask(){
                if(this.searchQ.length > 2 ){
                  axios.get('http://journal-de-bord.test/todo/' + this.searchQ)
                    .then(response => this.tasks = response.data)  
                    .catch(error => console.log(error));
                }else{
                    axios.get('http://journal-de-bord.test/todo')
                        //promesse attend les data de la bdd
                        // .response(response => console.log(response))
                        .then(response => this.tasks = response.data)
                        .catch(error => console.log(error));                    
                }
            },

            refresh(tasks){
                this.tasks = tasks.data
            }
        },

        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
