@extends('auth.auth_main')

@section('content')
<div class="authincation h-100">
    <div class="container h-100">
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-md-6">
                <div class="error-page">
                    <div class="error-inner text-center">
                        <div class="dz-error" data-text="403">403</div>
                        <h4 class="error-head"><i class="fa fa-times-circle text-danger"></i> Forbidden Error!</h4>
                        <p class="error-head">You do not have permission to access this page.</p>
                        <div>
                            <button onclick="history.back()" class="btn btn-secondary">Back to previous page</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
