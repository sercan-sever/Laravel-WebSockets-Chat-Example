@extends('layouts.app')

@section('css')
@endsection

@php
    use App\Enums\ImageTypeEnum;
@endphp

@section('content')
    <div class="row justify-content-center cst-setting-page" data-setting-user="{{ auth()->id() }}">

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Avatarım</h4>

                    <form data-action="{{ route('chat.setting.update.avatar') }}" method="POST" id="cst-setting-avatar-form">

                        <div class="mb-3 mt-1 cst-logo">
                            @include('components.settings.avatar', ['user' => auth()->user()])
                        </div>

                        <div class="mb-3">
                            <label for="avatar" class="form-label">Avatar <span class="cst-danger-color">*</span></label>
                            <small>( {{ ImageTypeEnum::ImageMime->value }} )</small>
                            <input class="form-control" name="avatar" type="file" id="avatar" accept="{{ ImageTypeEnum::ImageMimeAccept->value }}" required>
                        </div>

                        <div class="mt-4 text-center">
                            <button type="submit" class="btn btn-primary btn-rounded waves-effect waves-light mb-2 me-2">
                                <i class="fas fa-undo-alt me-1"></i> Güncelle
                            </button>
                        </div>

                    </form>

                    <h4 class="card-title mb-4 mt-4">Şifre Güncelleme</h4>

                    <form data-action="{{ route('chat.setting.update.password') }}" method="POST" id="cst-setting-password-form">

                        <div class="mb-3">
                            <label class="form-label">Yeni Şifreniz <span class="cst-required">*</span></label>
                            <div class="input-group auth-pass-inputgroup">
                                <input type="password" class="form-control" placeholder="Yeni Şifrenizi Giriniz *" name="password" required minlength="1" aria-label="Password" aria-describedby="password-addon">
                                <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Yeni Şifrenizi Tekrar Giriniz <span class="cst-required">*</span></label>
                            <div class="input-group auth-pass-inputgroup">
                                <input type="password" class="form-control" placeholder="Yeni Şifrenizi Tekrar Giriniz *" name="password_confirmation" required minlength="1" aria-label="Confirmation Password" aria-describedby="password-confirmation">

                                <button class="btn btn-light " type="button" id="password-confirmation"><i class="mdi mdi-eye-outline"></i></button>
                            </div>
                        </div>

                        <div class="mt-4 text-center">
                            <button type="submit" class="btn btn-primary btn-rounded waves-effect waves-light mb-2 me-2">
                                <i class="fas fa-undo-alt me-1"></i> Güncelle
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection


@section('modal')
@endsection

@section('js')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on("submit", "#cst-setting-avatar-form", function(e) {
            e.preventDefault();

            const url = $(this).attr('data-action');

            $(':button').prop('disabled', true);
            $('#waitModel').show();

            $.ajax({
                url: url,
                method: 'POST',
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {

                    if (response.success === false) {

                        Toastify({
                            text: (response.message) ? response.message : "Bir Hata Oluştu Lütfen Sayfayı Yenileyerek Tekrar Deneyiniz !!!",
                            duration: 5000,
                            close: true,
                            stopOnFocus: true,
                            gravity: "top",
                            position: "right",
                            class: "top-right",
                            backgroundColor: "#DC3546",
                        }).showToast();

                    } else {

                        Toastify({
                            text: "Avatar Güncellendi...",
                            duration: 5000,
                            close: true,
                            stopOnFocus: true,
                            gravity: "top",
                            position: "right",
                            class: "top-right",
                            backgroundColor: "#4fbe87",
                        }).showToast();

                        $('#cst-setting-avatar-form .cst-logo .cst-action-btn').remove();
                        $('#cst-setting-avatar-form').trigger("reset");
                    }
                },
                error: function(response) {

                    if (response.status === 422) {

                        $.each(response.responseJSON.errors, function(key, value) {
                            Toastify({
                                text: value[0],
                                duration: 5000,
                                close: true,
                                stopOnFocus: true,
                                gravity: "top",
                                position: "right",
                                class: "top-right",
                                backgroundColor: "#DC3546",
                            }).showToast();
                        });

                    } else {

                        Toastify({
                            text: (response.message) ? response.message : "Bir Hata Oluştu Lütfen Sayfayı Yenileyerek Tekrar Deneyiniz !!!",
                            duration: 5000,
                            close: true,
                            stopOnFocus: true,
                            gravity: "top",
                            position: "right",
                            class: "top-right",
                            backgroundColor: "#DC3546",
                        }).showToast();

                    }

                }
            }).always(function() {
                $('#waitModel').hide();
                $(':button').prop('disabled', false);
            });
        });

        $(document).on("submit", "#cst-setting-password-form", function(e) {
            e.preventDefault();

            const url = $(this).attr('data-action');

            $(':button').prop('disabled', true);
            $('#waitModel').show();

            $.ajax({
                url: url,
                method: 'POST',
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {

                    if (response.success === false) {

                        Toastify({
                            text: (response.message) ? response.message : "Bir Hata Oluştu Lütfen Sayfayı Yenileyerek Tekrar Deneyiniz !!!",
                            duration: 5000,
                            close: true,
                            stopOnFocus: true,
                            gravity: "top",
                            position: "right",
                            class: "top-right",
                            backgroundColor: "#DC3546",
                        }).showToast();

                    } else {

                        Toastify({
                            text: "Şifre Güncellendi...",
                            duration: 5000,
                            close: true,
                            stopOnFocus: true,
                            gravity: "top",
                            position: "right",
                            class: "top-right",
                            backgroundColor: "#4fbe87",
                        }).showToast();

                        Toastify({
                            text: "Yönlendiriliyorsunuz Çıkış Yapılıyor...",
                            duration: 5000,
                            close: true,
                            stopOnFocus: true,
                            gravity: "top",
                            position: "right",
                            class: "top-right",
                            backgroundColor: "#4fbe87",
                        }).showToast();

                        $('#cst-setting-password-form').trigger("reset");

                        window.location.replace("{{ route('chat.logout') }}");
                    }
                },
                error: function(response) {

                    if (response.status === 422) {

                        $.each(response.responseJSON.errors, function(key, value) {
                            Toastify({
                                text: value[0],
                                duration: 5000,
                                close: true,
                                stopOnFocus: true,
                                gravity: "top",
                                position: "right",
                                class: "top-right",
                                backgroundColor: "#DC3546",
                            }).showToast();
                        });

                    } else {

                        Toastify({
                            text: (response.message) ? response.message : "Bir Hata Oluştu Lütfen Sayfayı Yenileyerek Tekrar Deneyiniz !!!",
                            duration: 5000,
                            close: true,
                            stopOnFocus: true,
                            gravity: "top",
                            position: "right",
                            class: "top-right",
                            backgroundColor: "#DC3546",
                        }).showToast();

                    }

                    $('#cst-setting-password-form').trigger("reset");

                }
            }).always(function() {
                $('#waitModel').hide();
                $(':button').prop('disabled', false);
            });
        });
    </script>
@endsection
