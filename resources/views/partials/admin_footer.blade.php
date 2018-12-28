<footer class="sticky-footer">
    <div class="container">
        <div class="text-center">
            <small>Copyright &copy; Dev-PHP <?php echo date('Y'); ?> | {{\Tremby\LaravelGitVersion\GitVersionHelper::getNameAndVersion()}}</small>
        </div>
    </div>
</footer>
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fa fa-angle-up"></i>
</a>

<!-- Bootstrap core JavaScript-->
<script async>
    var ENVIRONMENT = "{{ App::environment() }}";
</script>
<script src={{asset("vendor/jquery/jquery.min.js")}}></script>
<script src="{{ asset('js/libs/moment.js') }}"></script>
<script src={{asset("vendor/bootstrap/js/bootstrap.bundle.min.js")}}></script>
<!-- Core plugin JavaScript-->
<script src={{asset("vendor/jquery-easing/jquery.easing.min.js")}}></script>
<script src="{{asset('js/app.js')}}"></script>
<!-- Custom scripts for all pages-->
<script src={{asset("js/admin.js")}}></script>
<script src={{asset("js/ga.js")}}></script>

@stack('scripts')
