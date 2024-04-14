<script>
    let type;
    let icon;
    let message;
</script>
@if (session()->has('message'))
    <script>
        let session = {!! json_encode(session('message')) !!};
        if (session.status === 'success') {
            type = 'success'
            icon = 'fa fa-fw fa-check me-1';
        } else if (session.status === 'error') {
            type = 'danger'
            icon = 'fa fa-times me-1';
        } else {
            type = 'info'
            icon = 'fa fa-exclamation me-1';
        }
        message = session.description
    </script>
    @php
        session()->forget('success');
    @endphp
@endif

<script>
    jQuery(
        function () {
            if (type && icon && message) {
                console.log(type, icon, message)
                Dashmix.helpers('jq-notify', {
                    type: type,
                    icon: icon,
                    message: message
                });
            }
        });
</script>
