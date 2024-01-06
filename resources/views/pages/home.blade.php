@extends('layouts.app')


@section('css')
@endsection


@section('content')
    <div class="d-lg-flex">
        <div class="chat-leftsidebar me-lg-4">
            <div class="">
                <div class="py-4 border-bottom">
                    <div class="d-flex">
                        <div class="flex-shrink-0 align-self-center cst-chat-list-header-avatar me-3" data-user="{{ auth()->id() }}">
                            <img src="{{ auth()->user()?->avatar?->getAvatar() }}" class="avatar-xs rounded-circle" alt="">
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="font-size-15 mb-1">{{ auth()->user()->name }}</h5>
                            <p class="text-muted mb-0">{!! auth()->user()->getStatusHtml(enum: auth()->user()->status) !!}</p>
                        </div>
                    </div>
                </div>


                <div class="chat-leftsidebar-nav">
                    <ul class="nav nav-pills nav-justified">
                        <li class="nav-item">
                            <div data-bs-toggle="tab" aria-expanded="true" class="nav-link active" style="cursor: pointer;">
                                <i class="bx bx-chat font-size-20 d-sm-none"></i>
                                <span class="d-none d-sm-block">Sohbetlerim</span>
                            </div>
                        </li>
                    </ul>
                    <div class="tab-content py-4">
                        <div class="tab-pane show active" id="chat">
                            <div>
                                <h5 class="font-size-14 mb-3">Son Mesajlaşmalar</h5>
                                <ul class="list-unstyled chat-list" data-simplebar style="max-height: 410px;">
                                    @foreach ($users as $user)
                                        @continue($user?->id == auth()->id())
                                        <li class="cst-link" data-id="{{ $user?->id }}">
                                            <div class="cst-chat-card">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 align-self-center me-3">
                                                        <img src="{{ $user?->avatar?->getAvatar() }}" class="rounded-circle avatar-xs">
                                                    </div>

                                                    <div class="flex-grow-1 overflow-hidden">
                                                        <h5 class="text-truncate font-size-14 mb-1">{{ $user?->name }}</h5>
                                                        <p class="text-muted mb-0 cst-status">{!! $user?->getStatusHtml(enum: $user?->status) !!}</p>
                                                    </div>

                                                    <div>
                                                        <div class="dropdown chat-noti-dropdown active">
                                                            <button class="btn" type="button">
                                                                <i class="bx bx-bell bx-tada"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="w-100 user-chat">
            @include('components.messages.default-view')
        </div>

    </div>
@endsection


@section('modal')
    @include('components.modals.update')

    @include('components.modals.delete')
@endsection


@section('js')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $('.cst-link').click(function(e) {
            e.preventDefault();

            const receiverID = $(this).attr('data-id');
            $('.cst-link').removeClass('active');
            $(this).addClass('active');

            $(':button').prop('disabled', true);
            $('#waitModel').show();


            $.ajax({
                url: "{{ route('chat.view') }}",
                data: {
                    "receiverID": receiverID,
                },
                type: 'POST',
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

                        $(".user-chat").html(response.data);

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

                    $('.cst-link').removeClass('active');
                }
            }).always(function() {
                $('#waitModel').hide();
                $(':button').prop('disabled', false);
            });


        });


        $(document).on("click", ".user-chat .cst-chat-view-close", function(e) {
            e.preventDefault();
            $('.cst-link').removeClass('active');
            $(".user-chat").html(`{!! view('components.messages.default-view')->render() !!}`);
        });


        $(document).on("submit", "#send-message-form", function(e) {
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

                        $('#send-message-form').trigger("reset");
                        for (instance in CKEDITOR.instances) {
                            CKEDITOR.instances[instance].setData('');
                        }

                        Toastify({
                            text: "Mesaj Gönderildi...",
                            duration: 5000,
                            close: true,
                            stopOnFocus: true,
                            gravity: "bottom",
                            position: "left",
                            class: "bottom-left",
                            backgroundColor: "#4fbe87",
                        }).showToast();
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


        // GET UPDATE MESSAGE CONTENT
        $(document).on("click", ".user-chat .cst-update", function(e) {
            e.preventDefault();

            const receiverID = $(this).attr('data-receiver');
            const messageID = $(this).attr('data-message');

            $(':button').prop('disabled', true);
            $('#waitModel').show();

            $.ajax({
                url: "{{ route('chat.get.message') }}",
                method: 'POST',
                data: {
                    "messageID": messageID,
                    "receiverID": receiverID,
                },
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

                        $('#cst-update-model .modal-content').html(response.data);

                        $('#cst-update-model').modal('show');
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

                    $('.user-chat #cst-update-model').modal('hide');

                }
            }).always(function() {
                $('#waitModel').hide();
                $(':button').prop('disabled', false);
            });
        });

        $(document).on("click", "#cst-update-model .modal-content .cst-update-modal-close", function(e) {
            e.preventDefault();

            $('#cst-update-model').modal('hide');

            $('#cst-update-model .modal-content').html('');
        });

        $(document).on("submit", "#update-model-form", function(e) {
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
                            text: "Mesaj Güncellendi...",
                            duration: 5000,
                            close: true,
                            stopOnFocus: true,
                            gravity: "bottom",
                            position: "left",
                            class: "bottom-left",
                            backgroundColor: "#4fbe87",
                        }).showToast();

                        $('#cst-update-model').modal('hide');
                        $('#cst-update-model .modal-content').html('');
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



        // GET DELETE MESSAGE CONTENT
        $(document).on("click", ".user-chat .cst-delete", function(e) {
            e.preventDefault();

            const receiverID = $(this).attr('data-receiver');
            const messageID = $(this).attr('data-message');

            $(':button').prop('disabled', true);
            $('#waitModel').show();

            $.ajax({
                url: "{{ route('chat.get.delete.message') }}",
                method: 'POST',
                data: {
                    "messageID": messageID,
                    "receiverID": receiverID,
                },
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

                        $('#cst-delete-model .modal-content').html(response.data);

                        $('#cst-delete-model').modal('show');
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

                    $('.user-chat #cst-delete-model').modal('hide');

                }
            }).always(function() {
                $('#waitModel').hide();
                $(':button').prop('disabled', false);
            });
        });

        $(document).on("click", "#cst-delete-model .modal-content .cst-delete-modal-close", function(e) {
            e.preventDefault();

            $('#cst-delete-model').modal('hide');

            $('#cst-delete-model .modal-content').html('');
        });

        $(document).on("submit", "#delete-message-form", function(e) {
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
                            text: "Mesaj Geri Alındı...",
                            duration: 5000,
                            close: true,
                            stopOnFocus: true,
                            gravity: "bottom",
                            position: "left",
                            class: "bottom-left",
                            backgroundColor: "#4fbe87",
                        }).showToast();

                        $('#cst-delete-model').modal('hide');
                        $('#cst-delete-model .modal-content').html('');
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
    </script>
@endsection
