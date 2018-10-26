<template>
    <div class="col-md-9">
        <!-- Portfolio Item Heading -->
        <h1 class="my-3">Laravel MVC Portfolio</h1>
        <p></p>
        <h3 class="my-3">Project Details</h3>
        <p>This is a project management site that allows you to create and track development issues along with projects and subtasks to demonstrate my proficiency with the laravel framework.</p>

        <p>The list below outlines some of the advanced features used to create the site along with links to the repository for code review.</p>
        <p></p>

        <table class="table reviewTbl">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Section</th>
                <th scope="col">Code</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">Registering Events & Listeners</th>
                <td><a href="https://github.com/dreboard/laravel_mvc/blob/master/app/Listeners/LogNewSiteListner.php">Link</a> </td>
            </tr>
            <tr>
                <th scope="row">Custom Log Channels</th>
                <td><a href="https://github.com/dreboard/laravel_mvc/blob/master/config/logging.php">Link</a> </td>
            </tr>
            <tr>
                <th scope="row">Unit Testing</th>
                <td><a href="https://github.com/dreboard/laravel_mvc/blob/master/tests/Unit/ProjectTest.php">Link</a> </td>
            </tr>
            <tr>
                <th scope="row">Model Repositories</th>
                <td><a href="https://github.com/dreboard/laravel_mvc/tree/master/app/Repositories">Link</a> </td>
            </tr>
            <tr>
                <th scope="row">Custom Responses & Validations</th>
                <td><a href="https://github.com/dreboard/laravel_mvc/tree/master/app/Http/Requests">Link</a> </td>
            </tr>
            <tr>
                <th scope="row">Guards & Policies</th>
                <td><a href="https://github.com/dreboard/laravel_mvc/tree/master/app/Policies">Link</a> </td>
            </tr>
            <tr>
                <th scope="row">Helpers</th>
                <td><a href="https://github.com/dreboard/laravel_mvc/tree/master/app/Helpers">Link</a> </td>
            </tr>
            <tr>
                <th scope="row">Service Classes</th>
                <td><a href="https://github.com/dreboard/laravel_mvc/tree/master/app/Services">Link</a> </td>
            </tr>
            <tr>
                <th scope="row">Model Relationships</th>
                <td><a href="https://github.com/dreboard/laravel_mvc/blob/master/app/Project.php">Link</a> </td>
            </tr>
            <tr>
                <th scope="row">Mailables</th>
                <td><a href="https://github.com/dreboard/laravel_mvc/tree/master/app/Mail">Link</a> </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {}
</script>