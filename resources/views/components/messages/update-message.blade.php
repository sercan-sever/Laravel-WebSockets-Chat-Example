@if (is_bool($value))
    @if ($value === true)
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
    @else
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
    @endif
@endif
