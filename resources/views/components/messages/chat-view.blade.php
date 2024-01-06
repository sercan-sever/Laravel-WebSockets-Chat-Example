<div class="card cst-chat-card" data-user="{{ $user?->id }}">
    <div class="p-4 border-bottom">
        <div class="row">
            <div class="col-md-4 col-9">
                <div class="d-flex">
                    <div class="flex-shrink-0 align-self-center me-3">
                        <img src="{{ $user?->avatar?->getAvatar() }}" class="rounded-circle avatar-xs" alt="">
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="font-size-15 mb-1">{{ $user?->name }}</h5>
                        <p class="text-muted mb-0 cst-chat-user-status">{!! $user?->getStatusHtml(enum: auth()->user()->status) !!}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-3">
                <ul class="list-inline user-chat-nav text-end mb-0">
                    <li class="list-inline-item">
                        <div class="dropdown">
                            <button class="btn btn-soft-danger cst-chat-view-close" type="button" style="border-radius: 50%;height: 40px;width: 40px;font-size: 16px;">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </div>


    <div>
        <div class="chat-conversation p-3">
            <ul class="list-unstyled mb-0 cst-add-message" data-simplebar style="max-height: 486px;">
                @foreach ($messages as $chat)
                    @if (auth()->id() === $chat?->sender_id)
                        <li class="right" data-message="{{ $chat?->id }}">
                            <div class="conversation-list">
                                <div class="dropdown">

                                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </a>

                                    <div class="dropdown-menu">
                                        <button type="button" class="dropdown-item cst-update" data-receiver="{{ $chat?->receiver_id }}" data-message="{{ $chat?->id }}">Düzenle</button>
                                        <button type="button" class="dropdown-item cst-delete" data-receiver="{{ $chat?->receiver_id }}" data-message="{{ $chat?->id }}">Geri Al</button>
                                    </div>
                                </div>
                                <div class="ctext-wrap">
                                    <div class="conversation-name">Siz</div>
                                    <p>
                                        {!! $chat?->message !!}
                                    </p>

                                    @if ($chat?->comparingUpdatedTimestamps())
                                        <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> {!! $chat?->getUpdateHour() !!}</p>
                                        <p class="chat-time mb-0 text-danger">Düzenlendi...</p>
                                    @else
                                        <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> {!! $chat?->getCreateHour() !!}</p>
                                    @endif
                                </div>
                            </div>
                        </li>
                    @else
                        <li data-message="{{ $chat?->id }}">
                            <div class="conversation-list">

                                <div class="ctext-wrap">
                                    <div class="conversation-name">{{ $chat?->sender?->name }}</div>
                                    <p>
                                        {!! $chat?->message !!}
                                    </p>
                                    @if ($chat?->comparingUpdatedTimestamps())
                                        <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> {!! $chat?->getUpdateHour() !!}</p>
                                        <p class="chat-time mb-0 text-danger">Düzenlendi...</p>
                                    @else
                                        <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> {!! $chat?->getCreateHour() !!}</p>
                                    @endif
                                </div>

                            </div>
                        </li>
                    @endif
                @endforeach

            </ul>
        </div>
        <div class="p-3 chat-input-section">
            <form data-action="{{ route('chat.send.message') }}" method="POST" id="send-message-form">
                <input type="hidden" name="receiverID" value="{{ $user?->id }}">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="position-relative">
                            <textarea class="form-control chat-input cst-send-message-textarea" id="chat-message" name="message" placeholder="Mesajınızı Giriniz..." required></textarea>
                        </div>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary btn-rounded chat-send w-md waves-effect waves-light">
                            <span class="d-none d-sm-inline-block me-2">Gönder</span> <i class="mdi mdi-send"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>

    </div>

</div>


<script>
    $(document).ready(function() {
        CKEDITOR.replace('message', {
            customConfig: "{{ asset('backend/js/ckeditor/clear-editor-config.js') }}",
            height: 100,
            editorplaceholder: 'Mesajınızı Giriniz...',
        });

        $(".user-chat .simplebar-content-wrapper").animate({
            scrollTop: $('.user-chat .simplebar-content-wrapper').prop("scrollHeight")
        }, "slow");
    });
</script>
