<div id="liveAlertPlaceholder"></div>

@section('alert-script')
    <script>
        const alertPlaceholder = document.getElementById('liveAlertPlaceholder')
        const alert = (message, type) => {
            const wrapper = document.createElement('div')
            wrapper.innerHTML = [
                `<div class="alert alert-${type} alert-dismissible fade show" role="alert">`,
                `   <div>${message}</div>`,
                '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
                '</div>'
            ].join('')

            alertPlaceholder.append(wrapper)
        }
    </script>
    <script>
        @if (Session::has('notif.success'))
            alert('{{ Session::get('notif.success') }}', 'success')
        @endif
    </script>
@endsection
