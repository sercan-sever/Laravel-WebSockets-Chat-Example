<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeleteMessageRequest;
use App\Http\Requests\GetChatViewRequest;
use App\Http\Requests\GetMessageRequest;
use App\Http\Requests\SendMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Services\Interfaces\MessageInterface;
use App\Services\Interfaces\UserInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * @param UserInterface $user
     * @param MessageInterface $message
     *
     * @return void
     */
    public function __construct(
        private UserInterface $user,
        private MessageInterface $message
    ) {
        //
    }


    /**
     * @param GetChatViewRequest $request
     *
     * @return JsonResponse
     */
    public function getChatView(GetChatViewRequest $request): JsonResponse
    {
        $user     = $this->user->getById(id: $request->validated('receiverID'));
        $messages = $this->message->getChatMessage(receiverID: $request->validated('receiverID'));

        return response()->json([
            'success' => true,
            'data' => view('components.messages.chat-view', ['user' => $user, 'messages' => $messages])->render()
        ]);
    }


    /**
     * @param SendMessageRequest $request
     *
     * @return JsonResponse
     */
    public function create(SendMessageRequest $request): JsonResponse
    {
        $message = $this->message->create(
            receiverID: $request->validated('receiverID'),
            message: $request->validated('message')
        );

        return response()->json(['success' => !empty($message) ? true : false]);
    }


    /**
     * @param GetMessageRequest $request
     *
     * @return JsonResponse
     */
    public function getMessage(GetMessageRequest $request): JsonResponse
    {
        $message = $this->message->getISenderMessage(
            messageID: $request->validated('messageID'),
            receiverID: $request->validated('receiverID'),
        );

        $data_ = !empty($message) ?
            ['success' => true, 'data' => view('components.messages.update-message-content', ['message' => $message])->render()]
            : ['success' => false];

        return response()->json($data_);
    }


    /**
     * @param GetMessageRequest $request
     *
     * @return JsonResponse
     */
    public function getDeleteMessage(GetMessageRequest $request): JsonResponse
    {
        $message = $this->message->getISenderMessage(
            messageID: $request->validated('messageID'),
            receiverID: $request->validated('receiverID'),
        );

        $data_ = !empty($message) ?
            ['success' => true, 'data' => view('components.messages.delete-message-content', ['message' => $message])->render()]
            : ['success' => false];

        return response()->json($data_);
    }




    /**
     * @param UpdateMessageRequest $request
     *
     * @return JsonResponse
     */
    public function updateMessage(UpdateMessageRequest $request): JsonResponse
    {
        $result = $this->message->update(
            messageID: $request->validated('messageID'),
            receiverID: $request->validated('receiverID'),
            messageContent: $request->validated('update_message')
        );

        return response()->json(['success' => (bool)$result]);
    }


    /**
     * @param DeleteMessageRequest $request
     *
     * @return JsonResponse
     */
    public function deleteMessage(DeleteMessageRequest $request): JsonResponse
    {
        $result = $this->message->delete(
            messageID: $request->validated('messageID'),
            receiverID: $request->validated('receiverID'),
        );

        return response()->json(['success' => (bool)$result]);
    }
}
