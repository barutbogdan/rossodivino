@if ($message = Session::get('success'))
    <div class="popup-wrapper">
        <div class="alert alert-success fade in">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <div class="popup-info">
                <h4 class="status">
                    <i class="icon fa fa-check"></i>Success!
                </h4>
                <strong>{{ $message }}</strong>
            </div>
        </div>
    </div>
@endif


@if ($message = Session::get('error'))
    <div class="popup-wrapper">
        <div class="alert alert-danger fade in">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <div class="popup-info">
                <h4>
                    <i class="icon fa fa-ban"></i> Error!
                </h4>
                <strong>{{ $message }}</strong>
            </div>
        </div>
    </div>
@endif


@if ($message = Session::get('warning'))
    <div class="popup-wrapper">
        <div class="alert alert-warning fade in">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <div class="popup-info">
                <h4>
                    <i class="icon fa fa-warning"></i> Warning!
                </h4>
                <strong>{{ $message }}</strong>
            </div>
        </div>
    </div>
@endif


@if ($message = Session::get('info'))
    <div class="popup-wrapper">
        <div class="alert alert-info fade in">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <div class="popup-info">
                <h4>
                    <i class="icon fa fa-info"></i> Info!
                </h4>
                <strong>{{ $message }}</strong>
            </div>
        </div>
    </div>
@endif


@if (!empty($errors) && $errors->any())
    <div class="popup-wrapper">
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <div class="popup-info">
                Please check the form below for errors
            </div>
        </div>
    </div>
@endif

