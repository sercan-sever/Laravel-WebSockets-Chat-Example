<form data-action="{{ route('chat.message.delete') }}" method="POST" id="delete-message-form">
    <input type="hidden" name="messageID" id="message-id" value="{{ $message?->id }}" min="1">
    <input type="hidden" name="receiverID" id="receiver-id" value="{{ $message?->receiver_id }}" min="1">

    <div class="modal-body px-4 py-5 text-center">
        <div class="avatar-sm mb-4 mx-auto">
            <div class="avatar-title bg-primary text-danger bg-opacity-10 font-size-20 rounded-3">
                <i class="mdi mdi-trash-can-outline"></i>
            </div>
        </div>

        <p class="text-muted font-size-16 mb-4" style="color: red;">
            <strong>Geri Almak İstediğinize Emin misiniz ?</strong>
        </p>

        <div class="hstack gap-2 justify-content-center mb-0">
            <button type="submit" class="btn btn-danger">Geri Al</button>
            <button type="button" class="btn btn-secondary cst-delete-modal-close" data-bs-dismiss="modal">Vazgeç</button>
        </div>
    </div>
</form>
