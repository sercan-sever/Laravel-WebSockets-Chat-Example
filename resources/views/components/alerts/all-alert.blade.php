@if (session()->has('alert-success-toast'))
    <script>
        Toastify({
            text: "{!! session()->get('alert-success-toast') !!}",
            duration: 5000,
            close: true,
            stopOnFocus: true,
            gravity: "top",
            position: "right",
            class: "top-right",
            backgroundColor: "#4fbe87",
        }).showToast();
    </script>
@endif

@if (session()->has('alert-error-toast'))
    <script>
        Toastify({
            text: "{!! session()->get('alert-error-toast') !!}",
            duration: 5000,
            close: true,
            stopOnFocus: true,
            gravity: "top",
            position: "right",
            class: "top-right",
            backgroundColor: "#DC3546",
        }).showToast();
    </script>
@endif


@if (session()->has('alert-success-swal'))
    <script>
        Swal.fire({
            title: 'İşlem Başarılı...',
            text: "{!! session()->get('alert-success-swal') !!}",
            icon: 'success',
            confirmButtonText: 'Tamam',
        });
    </script>
@endif

@if (session()->has('alert-error-swal'))
    <script>
        Swal.fire({
            title: 'Tekrar Deneyiniz...',
            text: "{!! session()->get('alert-error-swal') !!}",
            icon: 'error',
            confirmButtonText: 'Tamam',
        });
    </script>
@endif


@if ($errors->any())
    <script>
        @foreach ($errors->all() as $error)
            Toastify({
                text: "{{ $error }}",
                duration: 4000,
                close: true,
                stopOnFocus: true,
                gravity: "top",
                position: "right",
                class: "top-right",
                backgroundColor: "#DC3546",
            }).showToast();
        @endforeach
    </script>
@endif
