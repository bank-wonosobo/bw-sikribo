@section('content-loader')
<div  class="pageLoader" id="pageLoader">
    <div class="d-flex align-items-center justify-content-center h-100 w-100">
        <div class="loader"></div>
    </div>
</div>
@endsection

@section('js-loader')
<script>
    (function () {
        var showLoader = function () {
            $('#pageLoader').show();
        };

        var hideLoader = function () {
            $('#pageLoader').hide();
        };

        $(window).on('beforeunload', showLoader);
        $(window).on('pageshow', hideLoader);
        $(window).on('load', hideLoader);
        $(hideLoader);
    })();
</script>
@endsection
