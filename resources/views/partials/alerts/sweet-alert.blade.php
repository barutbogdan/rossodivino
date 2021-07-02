@if(Session::has('swal'))
    @php
        $toastr     = Session::get('swal');
        $title      = array_get($toastr->get('title'), 0, '');
        $type       = array_get($toastr->get('type'), 0, 'success');
        $message    = array_get($toastr->get('message'), 0, '');
    @endphp
    <script type="text/javascript">
        $(function () {
            $(document).ready(function() {
                swal('{{ $title }}', '{{ $message }}', '{{ $type }}');
            });
        });
    </script>
@endif