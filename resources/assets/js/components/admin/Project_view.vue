<template>
    <div style="min-width:100%">
        <div class="row contacts">
            <div class="col-md-10 invoice-to">
                <div class="text-gray-light">Project:</div>
                <h2 class="to">{{project.title}}</h2>
                <div class="address">{{project.description}}</div>
            </div>
            <div class="col-md-2 invoice-details">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalNotesForm">
                    Edit
                </button>
            </div>
        </div>

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


                        <form id="editProjectForm" method="post">
                            <div class="form-group row">
                                <label for="title" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input name="title" type="text" class="form-control" v-model="project.title" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description" class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="description" rows="3" v-model="project.description">project.description</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="create_date" class="col-sm-2 col-form-label">Dates</label>
                                <div class="col-sm-10">
                                    <div class="form-group row">
                                        <div class="col">
                                            <input type="text" class="form-control datepicker" name="create_date" v-model="project.create_date">
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control datepicker" name="due_date" v-model="project.due_date">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="git_tag" class="col-sm-2 col-form-label">Git Tag</label>
                                <div class="col-sm-10">
                                    <input name="git_tag" type="text" class="form-control" placeholder="v0.0.0" v-bind="project.git_tag">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button id="cycleSaveBtn" type="submit" class="btn btn-primary">Save</button>
                                </div>
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
        props: ['title', 'project_id', 'description', 'project_get_url', 'project_edit_url'],
        data() {
            return {
                project: [],
                project_form: {
                    title: '',
                    description: '',
                    create_date: '',
                    due_date: '',
                    git_tag: ''
                },
            }
        },
        methods: {
            getProject() {
                axios.get(this.project_get_url)
                    .then((response)=>{
                        this.project = response.data.project;
                        console.log(this.project);

                    }).catch((error)=>{
                    if (ENVIRONMENT === "local") {
                        console.log(error);
                    }
                });
            },
            editProject(){
                axios
                    .post(this.project_edit_url, {
                        title: this.project_form.title,
                        id: this.project_id,
                    }).then((response)=>{
                    $('#modalNotesForm').modal('hide');
                    this.getProject();
                    showMessage('Note Added');
                }).catch((error)=>{
                    if (ENVIRONMENT === "local") {
                        console.log(error);
                    }
                });
            }

        },
        created(){
            this.getProject()
        },
        mounted() {
            if (ENVIRONMENT === "local") {
                console.log(this.project);
            }
        }
    }
</script>
