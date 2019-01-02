<template>
    <div class="col-md-3">
        <!-- Categories Widget -->
        <div class="card my-4">
            <h5 class="card-header">Categories</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <ul class="list-unstyled mb-0">
                            <li>
                                <a href="https://github.com/dreboard/laravel_mvc/tree/master/app/Http/Controllers">Controllers</a>
                            </li>
                            <li>
                                <a href="https://github.com/dreboard/laravel_mvc/tree/master/app/Http/Requests">Validation</a>
                            </li>
                            <li>
                                <a href="#">Security</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <ul class="list-unstyled mb-0">
                            <li>
                                <a href="https://github.com/dreboard/laravel_mvc/tree/master/app">Database</a>
                            </li>
                            <li>
                                <a href="https://github.com/dreboard/laravel_mvc/tree/master/app/Http/Middleware">Middleware</a>
                            </li>
                            <li>
                                <a href="https://github.com/dreboard/laravel_mvc/tree/master/app/Http">HTTP</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Side Widget -->
        <div class="card my-4">
            <h5 class="card-header">Tech Used</h5>
            <div class="card-body">
                <ul>

                    <li>Laravel 5.7</li>
                    <li>Bootstrap 4</li>
                    <li>PHP 7.3</li>
                    <li>VueJS</li>
                    <li>Node/NPM</li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                url: 'http://localhost/_dev-php/site1/public/',
                techs: [],
                tech: {
                    laravel: '',
                    bootstrap: '',
                    php: '',
                    js_front: '',
                    js_tech: '',
                }
            }
        },
        mounted(){
            this.getFrontLinks()

        },
        methods: {
            getFrontLinks(){

                axios.get('http://localhost/_dev-php/site1/public/links')
                    .then(function (response) {
                        // handle success
                        console.log(response);
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
                    .then(function () {
                        // always executed
                    })
            }
        }
    }
</script>
