<template>
    <div>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#addtask">
        Ajouter une tâche
        </button>

        <!-- Modal -->
        <div class="modal fade" id="addtask" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ajouter une tâche</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="">Nom de la tâche</label>
                                <textarea name="name" id="name" row="4" class="form-control" v-model="name"></textarea>
                            </div>
                        </form>    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-success" @click="taskStore" data-dismiss="modal">Créer une tâche</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {

    data() {
        return {
        
            name: ''
    
        }
    },

    methods: {

        taskStore() {
            axios.post('http://journal-de-bord.test/todo', {
                name: this.name
            })
            //.then(response => console.log(response))
            .then(response => this.$emit('task-added', response))
            .catch(error => console.log(error))
            this.name = ''
        }
    }
    
}
</script>