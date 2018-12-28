<template>
    <div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">User Management</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="dataTables_length" id="example1_length"><label>Show <select
                                            name="example1_length" aria-controls="example1"
                                            class="custom-select custom-select-sm form-control form-control-sm">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select> entries</label></div>
                                </div>
                                <div class="col-sm-12 col-md-6 text-right">
                                    <a class="btn btn-primary" data-toggle="modal" data-target="#modalUserForm">Add</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example1" class="table table-bordered table-striped dataTable"
                                           role="grid" aria-describedby="example1_info">
                                        <thead>
                                        <tr role="row">
                                            <th rowspan="1" colspan="1">ID</th>
                                            <th rowspan="1" colspan="1">Name</th>
                                            <th rowspan="1" colspan="1">Email</th>
                                            <th rowspan="1" colspan="1">Admin</th>
                                            <th rowspan="1" colspan="1">Modify</th>
                                        </tr>
                                        </thead>
                                        <tbody>


                                        <tr v-for="user in users" role="row" class="odd">
                                            <td class="sorting_1">{{user.id}}</td>
                                            <td>{{user.name}}</td>
                                            <td>{{user.email}}</td>
                                            <td>{{user.isAdmin | adminText}}</td>
                                            <td><button @click="deleteUser(user.id)"><i class="fa fa-edit"></i> </button> |
                                                <button @click="deleteUser(user.id)"><i class="fa fa-trash"></i> </button></td>
                                        </tr>


                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th rowspan="1" colspan="1">ID</th>
                                            <th rowspan="1" colspan="1">Name</th>
                                            <th rowspan="1" colspan="1">Email</th>
                                            <th rowspan="1" colspan="1">Admin</th>
                                            <th rowspan="1" colspan="1">Modify</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-5">
                                    <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">
                                        Showing 1 to 10 of 57 entries
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                        <ul class="pagination">
                                            <li class="paginate_button page-item previous disabled"
                                                id="example1_previous"><a href="#" aria-controls="example1"
                                                                          data-dt-idx="0" tabindex="0"
                                                                          class="page-link">Previous</a></li>
                                            <li class="paginate_button page-item active"><a href="#"
                                                                                            aria-controls="example1"
                                                                                            data-dt-idx="1" tabindex="0"
                                                                                            class="page-link">1</a></li>
                                            <li class="paginate_button page-item "><a href="#" aria-controls="example1"
                                                                                      data-dt-idx="2" tabindex="0"
                                                                                      class="page-link">2</a></li>
                                            <li class="paginate_button page-item "><a href="#" aria-controls="example1"
                                                                                      data-dt-idx="3" tabindex="0"
                                                                                      class="page-link">3</a></li>
                                            <li class="paginate_button page-item "><a href="#" aria-controls="example1"
                                                                                      data-dt-idx="4" tabindex="0"
                                                                                      class="page-link">4</a></li>
                                            <li class="paginate_button page-item "><a href="#" aria-controls="example1"
                                                                                      data-dt-idx="5" tabindex="0"
                                                                                      class="page-link">5</a></li>
                                            <li class="paginate_button page-item "><a href="#" aria-controls="example1"
                                                                                      data-dt-idx="6" tabindex="0"
                                                                                      class="page-link">6</a></li>
                                            <li class="paginate_button page-item next" id="example1_next"><a href="#"
                                                                                                             aria-controls="example1"
                                                                                                             data-dt-idx="7"
                                                                                                             tabindex="0"
                                                                                                             class="page-link">Next</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Modal -->
        <div class="modal fade" id="modalUserForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true" ref="modalUserForm">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h4 class="modal-title w-100 font-weight-bold">Sign up</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="newUserForm" @submit.prevent="createUser">
                    <div class="modal-body mx-3">
                        <div class="form-group">
                            <label for="userName">Name</label>
                            <input type="text" class="form-control" id="userName" name="userName" v-model="newUser.userName">
                        </div>
                        <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" v-model="newUser.email">
                    </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="Password"
                                   v-model="newUser.password">
                        </div>

                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>



    </div>
    <!-- /.row -->
</template>

<script>
    export default {
        data() {
            return {
                users: {},
                newUser: {
                    userName: '',
                    email: '',
                    password: ''
                },
            }
        },
        methods: {
            createUser() {
                axios.post('http://localhost/_dev-php/site1/public/user',this.newUser)
                    .then((response)=>{
                        this.getUsers();
                        $('#modalUserForm').modal('hide')
                        $('.modal-backdrop').remove();
                        $(body).removeClass("modal-open");
                    console.log(response)
                }).catch((error)=>{

                    console.log(error.response.data)
                });
            },
            getUsers(){
                let uri ='http://localhost/_dev-php/site1/public/user';
                axios.get(uri).then(({data}) => {
                    (this.users = data.users);
                });
            },
            deleteUser(id) {
                var r = confirm("Delete This User");
                if (r == true) {
                    axios.delete('http://localhost/_dev-php/site1/public/user/'+id, {
                        params: { id: id }
                    })
                        .then((response)=>{
                            this.getUsers();
                            console.log(response)
                        }).catch((error)=>{
                        console.log(error.response.data)
                    });
                } else {

                }


            },
        },
        created(){
            this.getUsers()
        },
        mounted() {
            console.log(this.users);
        },
        filters: {
            capitalize: function (value) {
                if (!value) return ''
                value = value.toString()
                return value.charAt(0).toUpperCase() + value.slice(1)
            }
        }
    }
</script>
