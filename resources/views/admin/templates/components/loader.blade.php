@section('content-loader')
<div  class="pageLoader" id="pageLoader">
    <div class="d-flex align-items-center justify-content-center h-100 w-100">
        <div class="loader"></div>
    </div>
</div>
@endsection

@section('js-loader')
<script>
    $(window).on('beforeunload', function(){

        $('#pageLoader').show();

    });

    $(function () {

        $('#pageLoader').hide();
    })
</script>
@endsection

