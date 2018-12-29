<template>
    <div>

        <!-- /.content-header -->
        <table class="table table-bordered">
            <tr>
                <th>Note</th>
                <th>Added</th>
                <th></th>
            </tr>

            <tr v-for="project_note in notes">
                <td class="w-75">{{ project_note.note }}</td>
                <td class="w-20">{{ project_note.note_date }}</td>
                <td class="w-5"><button @click="deleteTicketNote(project_note.id)" type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i>
                </button></td>
            </tr>
        </table>

        <!-- Modal -->
        <div class="modal fade" id="modalNotesForm" tabindex="-1" role="dialog" aria-labelledby="modalNotesFormLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalNotesFormLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <textarea class="form-control" v-model="note_form.note" name="note" id="note" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="file" name="file" />
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button @click="saveTicketNote()" type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>



    </div>
    <!-- /.row -->
</template>

<script>
    export default {
        props: ['resource', 'ticket_id', 'ticket_url'],
        data() {
            return {
                notes: [],
                note_form: {
                    note: '',
                    id: ''
                },
            }
        },
        methods: {
            getNotes() {
                axios.get(this.resource)
                    .then((response)=>{
                        this.notes = response.data.notes;
                        //console.log(this.notes);
                    }).catch((error)=>{
                    if (ENVIRONMENT === "local") {
                        console.log(error);
                    }
                });
            },
            saveTicketNote(){
                axios
                    .post(this.ticket_url, {
                        note: this.note_form.note,
                        ticket_id: this.ticket_id
                    }).then((response)=>{
                    $('#modalNotesForm').modal('hide');
                    this.getNotes();
                }).catch((error)=>{
                    if (ENVIRONMENT === "local") {
                        console.log(error);
                    }
                });
            },
            deleteTicketNote(id){
                axios
                    .post(this.ticket_url, {
                        note: this.note_form.note,
                        ticket_id: this.ticket_id
                    }).then((response)=>{
                    $('#modalNotesForm').modal('hide');
                    this.getNotes();
                }).catch((error)=>{
                    if (ENVIRONMENT === "local") {
                        console.log(error);
                    }
                });
            }
        },
        created(){
            this.getNotes()
        },
        mounted() {
            if (ENVIRONMENT === "local") {
                console.log(this.notes);
            }
        }
    }
</script>
