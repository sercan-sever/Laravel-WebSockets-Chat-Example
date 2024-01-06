<form data-action="{{ route('chat.message.update') }}" method="POST" id="update-model-form">
    <input type="hidden" name="messageID" id="message-id" value="{{ $message?->id }}" min="1">
    <input type="hidden" name="receiverID" id="receiver-id" value="{{ $message?->receiver_id }}" min="1">

    <div class="modal-body px-4 py-5 text-center">

        <p class="text-muted font-size-16 mb-4">
            <strong>Mesajınızı Düzenleyebilirsiniz...</strong>
        </p>

        <div class="row align-items-center mb-4">
            <div class="col">
                <div class="position-relative">
                    <textarea class="form-control chat-input cst-send-message-textarea" id="update-message" name="update_message" placeholder="Mesajınızı Giriniz...">{!! $message?->message !!}</textarea>
                </div>
            </div>
        </div>

        <div class="hstack gap-2 justify-content-center mb-0">
            <button type="button" class="btn btn-danger btn-rounded waves-effect waves-light cst-update-modal-close">
                <i class="fas fa-times me-1"></i> Vazgeç
            </button>
            <button type="submit" class="btn btn-primary btn-rounded waves-effect waves-light">
                <i class="fas fa-undo-alt me-1"></i> Güncelle
            </button>
        </div>
    </div>
</form>
<script>
    $(document).ready(function() {
        CKEDITOR.replace('update_message', {
            customConfig: "{{ asset('backend/js/ckeditor/clear-editor-config.js') }}",
            height: 100,
            editorplaceholder: 'Mesajınızı Giriniz...',
        });
    });
</script>
