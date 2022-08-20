<footer>
    <div class="container">
        <div class="footer clearfix mb-0 text-muted">
            <div class="float-start">
                <p>2022 &copy; {{ $profile->nama }} </p>
            </div>
        </div>
    </div>
</footer>
<script src="{{ asset('assets/js/app.js') }}"></script>
<script src="{{ asset('assets/js/extensions/datatables.js') }}"></script>
<script src="{{ asset('assets/js/extensions/form-element-select.js') }}"></script>
<script>
    $(function() {
        $.ajax({
            url: 'pos/data_menu',
            type: 'post',
            data: {
                id: ''
            },
            success: function(result) {
                $("#data_menu").html(result);
            }
        })
    })
</script>
