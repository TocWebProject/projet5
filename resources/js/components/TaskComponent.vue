<template>
    <div class="container">
        <ul class="list-group">
            <li class="list-group-item" v-for="task in tasks" :key="task.id">
                <p>{{ task.name }}</p>
            </li>
        </ul>
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

        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
