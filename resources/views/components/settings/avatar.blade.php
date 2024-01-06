@if (empty($user?->avatar?->image))
    <label for="avatar" class="btn cst-action-btn btn-sm btn-warning">
        <i class="fas fa-pen"></i>
    </label>
@endif
<div class="mb-3 mt-1 cst-logo">
    <img src="{{ $user?->avatar?->getAvatar() }}" alt="#" class="rounded avatar-lg">
</div>
