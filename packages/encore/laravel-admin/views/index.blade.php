<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ Admin::title() }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="{{ asset("/packages/admin/AdminLTE/bootstrap/css/bootstrap.min.css") }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset("/packages/admin/font-awesome/css/font-awesome.min.css") }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset("/packages/admin/AdminLTE/dist/css/skins/" . config('admin.skin') .".min.css") }}">

    {!! Admin::css() !!}
    <link rel="stylesheet" href="{{ asset("/packages/admin/nestable/nestable.css") }}">
    <link rel="stylesheet" href="{{ asset("/packages/admin/toastr/build/toastr.min.css") }}">
    <link rel="stylesheet" href="{{ asset("/packages/admin/bootstrap3-editable/css/bootstrap-editable.css") }}">
    <link rel="stylesheet" href="{{ asset("/packages/admin/google-fonts/fonts.css") }}">
    <link rel="stylesheet" href="{{ asset("/packages/admin/AdminLTE/dist/css/AdminLTE.min.css") }}">

    <!-- REQUIRED JS SCRIPTS -->
    <script src="{{ asset ("/packages/admin/AdminLTE/plugins/jQuery/jQuery-2.1.4.min.js") }}"></script>
    <script src="{{ asset ("/packages/admin/AdminLTE/bootstrap/js/bootstrap.min.js") }}"></script>
    <script src="{{ asset ("/packages/admin/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js") }}"></script>
    <script src="{{ asset ("/packages/admin/AdminLTE/dist/js/app.min.js") }}"></script>
    <script src="{{ asset ("/packages/admin/jquery-pjax/jquery.pjax.js") }}"></script>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body class="hold-transition {{config('admin.skin')}} {{join(' ', config('admin.layout'))}}">
<div class="wrapper">

    @include('admin::partials.header')

    @include('admin::partials.sidebar')

    <div class="content-wrapper" id="pjax-container">
        @yield('content')
        {!! Admin::script() !!}
    </div>

    @include('admin::partials.footer')

</div>

<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->
<script src="{{ asset ("/packages/admin/AdminLTE/plugins/chartjs/Chart.min.js") }}"></script>
<script src="{{ asset ("/packages/admin/nestable/jquery.nestable.js") }}"></script>
<script src="{{ asset ("/packages/admin/toastr/build/toastr.min.js") }}"></script>
<script src="{{ asset ("/packages/admin/bootstrap3-editable/js/bootstrap-editable.min.js") }}"></script>

{!! Admin::js() !!}

<script>

    function LA() {}
    LA.token = "{{ csrf_token() }}";

    $.fn.editable.defaults.params = function (params) {
        params._token = '{{ csrf_token() }}';
        params._editable = 1;
        params._method = 'PUT';
        return params;
    };

    toastr.options = {
        closeButton: true,
        progressBar: true,
        showMethod: 'slideDown',
        timeOut: 4000
    };

    $.pjax.defaults.timeout = 5000;
    $.pjax.defaults.maxCacheLength = 0;
    $(document).pjax('a:not(a[target="_blank"])', {
        container: '#pjax-container'
    });

    $(document).on('submit', 'form[pjax-container]', function(event) {
        $.pjax.submit(event, '#pjax-container')
    });

    $(document).on("pjax:popstate", function() {

        $(document).one("pjax:end", function(event) {
            $(event.target).find("script[data-exec-on-popstate]").each(function() {
                $.globalEval(this.text || this.textContent || this.innerHTML || '');
            });
        });
    });

    $(document).on('pjax:send', function(xhr) {
        if(xhr.relatedTarget && xhr.relatedTarget.tagName && xhr.relatedTarget.tagName.toLowerCase() === 'form') {
            $submit_btn = $('form[pjax-container] :submit');
            if($submit_btn) {
                $submit_btn.button('loading')
            }
        }
    });

    $(document).on('pjax:complete', function(xhr) {
        if(xhr.relatedTarget && xhr.relatedTarget.tagName && xhr.relatedTarget.tagName.toLowerCase() === 'form') {
            $submit_btn = $('form[pjax-container] :submit');
            if($submit_btn) {
                $submit_btn.button('reset')
            }
        }
    });

    $(function(){
        $('.sidebar-menu li:not(.treeview) > a').on('click', function(){
            var $parent = $(this).parent().addClass('active');
            $parent.siblings('.treeview.active').find('> a').trigger('click');
            $parent.siblings().removeClass('active').find('li').removeClass('active');
        });
    });

</script>
<link rel="stylesheet" href="{{ asset('cropper.min.css') }}">
<script src="{{ asset('cropper.min.js') }}"></script>
<script type="text/javascript">

    $(function() {

        var file, cropper, imageWidth, imageHeight;

        var body = 'body';
        var cropImageModal = '#crop-image-modal';

        var options = {
            minContainerWidth: 0,
            minContainerHeight: 0,
            minCropBoxWidth: 0,
            minCropBoxHeight: 0,
            rotatable: true,
            zoomable: false,
            movable: false,
            cropBoxResizable: false,
            dragMode: 'none',
            responsive: false,
            data: {
                width: 0,
                height: 0
            }
        };

        $(document).find(cropImageModal).on("show.bs.modal", function() {

            var inputImage = $(document).find('input[name="image"][data-croppable="1"]');

            var cropWidth = inputImage.data('crop-width');
            var cropHeight = inputImage.data('crop-height');

            options.data.width = cropWidth;
            options.data.height = cropHeight;
            options.minContainerWidth = imageWidth;
            options.minContainerHeight = imageHeight;

            cropper = new Cropper(document.getElementById('image_cropper'), options);
        });

        $(document).find(cropImageModal).on("hide.bs.modal", function() {
            cropper.destroy();
        });

        $(document).find(body).on("click", ".rotate", function() {
            cropper.rotate($(this).attr("data-option"));
        });

        $(document).find(body).on("click", "#Save", function () {

            $(document)
                .find('.kv-preview-thumb[data-fileindex="0"] .file-preview-image')
                .attr('src', cropper.getCroppedCanvas().toDataURL());

            $(document).find('input[name="cropped_image"]')
                .val(JSON.stringify(cropper.getData()));

            $(document).find(cropImageModal).modal('hide');
        });

        $(document).on("change", 'input[name="image"][data-croppable="1"]', function () {

            file = this.files[0];

            if (!file) {
                return;
            }

            var imagefile = file.type;
            var _URL = window.URL || window.webkitURL;

            var img = new Image();
            img.src = _URL.createObjectURL(file);

            img.onload = function () {

                var match = ["image/jpeg", "image/png", "image/jpg"];

                if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))) {
                    alert('Please Select A valid Image File');
                    return false;
                }

                imageWidth = this.width;
                imageHeight = this.height;

                var modalDialog = $(document).find(cropImageModal).find('.modal-dialog');
                if (this.width > 900) {
                    $(modalDialog).css({'width': "95%"});
                } else {
                    $(modalDialog).removeAttr('style');
                }

                var reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onloadend = function () {
                    $(document).find('#image_cropper').attr('src', "");
                    $(document).find('#image_cropper').attr('src', this.result);
                    $(document).find('#crop-image-modal').modal("show");
                }
            }
        });
    });
</script>
<style type="text/css">
    .cropper-container {
        margin: 0 auto 20px;
    }
    #image_cropper {
        max-width: 100% !important;
    }
    #crop-image-modal .modal-body {
        overflow-x: scroll;
        margin-right: 15px;
    }
    .table td svg {
        width: 20px !important;
        max-height: 20px !important;
        fill: black !important;
    }
</style>

<!-- Modal -->
<div id="crop-image-modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Crop image</h4>
            </div>
            <div class="modal-body">
                <img id="image_cropper" width="100%" src="">
                <p class="text-center">
                    <button type="button" class="btn btn-primary rotate" data-method="rotate" data-option="-30">
                        <i class="fa fa-undo"></i>
                    </button>
                    <button type="button" class="btn btn-primary rotate" data-method="rotate" data-option="30">
                        <i class="fa fa-repeat"></i>
                    </button>
                </p>
            </div>
            <div class="modal-footer">
                <button id="Save" class="btn btn-primary" type="button" value="Save">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>

</div>
</body>
</html>
