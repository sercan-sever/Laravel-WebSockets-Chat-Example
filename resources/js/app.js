import './bootstrap';


// User Active
window.Echo.channel('user-active').listen('.UserActive', (user) => {
    // Son Mesajlaşmalar Alanı Aktiflik Durumu
    $('#chat li[data-id="' + user.id + '"] .cst-status').html(user.status);

    // Mesajlaşma Alanı Aktiflik Durumu
    $('.user-chat .cst-chat-card[data-user="' + user.id + '"] .cst-chat-user-status').html(user.status);
});

// User Passive
window.Echo.channel('user-passive').listen('.UserPassive', (user) => {
    // Son Mesajlaşmalar Alanı Aktiflik Durumu
    $('#chat li[data-id="' + user.id + '"] .cst-status').html(user.status)


    // Mesajlaşma Alanı Aktiflik Durumu
    $('.user-chat .cst-chat-card[data-user="' + user.id + '"] .cst-chat-user-status').html(user.status);
});

// Avatar Update
window.Echo.channel('update-avatar').listen('.UpdateAvatar', (avatar) => {

    // profile avatar
    $('.cst-setting-page[data-setting-user="' + avatar.user + '"] .cst-logo img').attr('src', avatar.avatar);

    // header avatar
    $('#page-header-user-dropdown[data-user-header-avatar="' + avatar.user + '"] img').attr('src', avatar.avatar);

    // chat list header avatar
    $('.cst-chat-list-header-avatar[data-user="' + avatar.user + '"] img').attr('src', avatar.avatar);

    // chat list avatar
    $('.chat-leftsidebar-nav .cst-link[data-id="' + avatar.user + '"] img').attr('src', avatar.avatar);

    // chat content avatar
    $('.user-chat .cst-chat-card[data-user="' + avatar.user + '"] img').attr('src', avatar.avatar);
});


$(document).ready(function () {

    var user = window.document.querySelector('meta[name="id"]').getAttribute('content');

    // Sender Message
    window.Echo.private('sender-message.' + user).listen('.SendMessage', (chat) => {
        if ($('.user-chat .cst-chat-card[data-user="' + chat.sender + '"] ul.cst-add-message .simplebar-content').find('div')) {
            $('.user-chat .cst-chat-card[data-user="' + chat.sender + '"] ul.cst-add-message .simplebar-content').append(chat.senderMessage);
        } else {
            $('.user-chat .cst-chat-card[data-user="' + chat.sender + '"] ul.cst-add-message').append(chat.senderMessage);
        }


        $(".user-chat .simplebar-content-wrapper").animate({ scrollTop: $('.user-chat .simplebar-content-wrapper').prop("scrollHeight") }, "slow");
    });

    window.Echo.private('receiver-message.' + user).listen('.SendMessage', (chat) => {
        if ($('.user-chat .cst-chat-card[data-user="' + chat.receiver + '"] ul.cst-add-message .simplebar-content').find('div')) {
            $('.user-chat .cst-chat-card[data-user="' + chat.receiver + '"] ul.cst-add-message .simplebar-content').append(chat.receiverMessage);
        } else {
            $('.user-chat .cst-chat-card[data-user="' + chat.receiver + '"] ul.cst-add-message').append(chat.receiverMessage);
        }


        $(".user-chat .simplebar-content-wrapper").animate({ scrollTop: $('.user-chat .simplebar-content-wrapper').prop("scrollHeight") }, "slow");
    });


    // Update Message
    window.Echo.private('sender-update-message.' + user).listen('.UpdateMessage', (chat) => {

        $('.user-chat .cst-chat-card[data-user="' + chat.sender + '"] ul li[data-message="' + chat.id + '"]').html(chat.senderMessageUpdate);
    });

    window.Echo.private('receiver-update-message.' + user).listen('.UpdateMessage', (chat) => {

        $('.user-chat .cst-chat-card[data-user="' + chat.receiver + '"] ul li[data-message="' + chat.id + '"]').html(chat.receiverMessageUpdate);
    });


    // Delete Message
    window.Echo.private('sender-delete-message.' + user).listen('.DeleteMessage', (chat) => {

        $('.user-chat .cst-chat-card[data-user="' + chat.sender + '"] ul li[data-message="' + chat.id + '"]').remove();
    });

    window.Echo.private('receiver-delete-message.' + user).listen('.DeleteMessage', (chat) => {

        $('.user-chat .cst-chat-card[data-user="' + chat.receiver + '"] ul li[data-message="' + chat.id + '"]').remove();
    });

});


