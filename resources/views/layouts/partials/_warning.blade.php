<div class='container'>
    @isset($error)
            <div class="alert alert-danger fade show" role="alert">
                {!! $error !!}
            </div>
    @endisset

    @isset($success)
            <div class="alert alert-success fade show" role="alert">
                {!! $success !!}
            </div>
    @endisset
</div>
 