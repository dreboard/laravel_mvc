<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Dev-PHP <?php echo date('Y'); ?> | {{\Tremby\LaravelGitVersion\GitVersionHelper::getNameAndVersion()}}</p>
    </div>
    <!-- /.container -->
</footer>

<!-- Bootstrap core JavaScript -->
<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script>
    $( document ).ready(function() {
        $('table.reviewTbl a').attr({ target: "_blank" });
    });
</script>

</body>

</html>