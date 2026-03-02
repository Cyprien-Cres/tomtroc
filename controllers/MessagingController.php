<?php

class MessagingController
{
    public function showMessaging()
    {
        $id = $_SESSION['user']->getId();
        $selectedConversation = null;

        $messagingManager = new MessagingManager();
        $conversations = $messagingManager->getAllConversation($id);

        $lastConversationUserId = null;
        if (isset($_SESSION['user'])) {
            $lastConversationUserId = $messagingManager->getLastConversationUserId($_SESSION['user']->getId());
        }

        $conversationDetail = $messagingManager->getConversation(isset($_GET['userRecipient']) ? (int)$_GET['userRecipient'] : 0, $id);


        if (isset($_GET['userRecipient'])) {
            $userRecipientId = (int)$_GET['userRecipient'];
            foreach ($conversations as $conversation) {
                if ($conversation->getUserSender() === $userRecipientId ||
                    $conversation->getUserRecipient() === $userRecipientId) {
                    $selectedConversation = $conversation;
                    break;
                }
            }

            if ($selectedConversation === null) {
                $userManager = new UserManager();
                $recipient = $userManager->getUserById($userRecipientId);
                if ($recipient) {
                    $selectedConversation = new Messaging([
                        'user_sender'    => $userRecipientId,
                        'user_recipient' => $id,
                        'nickname'       => $recipient->getNickname(),
                        'user_img'       => $recipient->getUserImg(),
                        'content'        => '',
                        'created_at'     => date('Y-m-d H:i:s'),
                    ]);
                }
            }
        }

        if (isset($_GET['userRecipient']) && !empty($_GET['userRecipient'])) {
            $userRecipientId = (int) $_GET['userRecipient'];
            $currentUserId = $_SESSION['user']->getId();

            $messagingManager->markMessagesAsRead($currentUserId, $userRecipientId);

            $_SESSION['unreadCounter'] = $messagingManager->countUnreadMessages($currentUserId);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $user_recipient = Utils::request("userRecipient");
            $content = Utils::request("content");
            $user_sender = $_SESSION['user']->getId();

            $this->sendMessage($user_recipient, $content, $user_sender);

            Utils::redirect("messaging&userRecipient=$user_recipient");
            return;
        }

        $view = new View("Messagerie - Tom Troc");
        $view->render("messaging" , ['conversations' => $conversations]
            + ['conversationDetail' => $conversationDetail]
            + ['selectedConversation' => $selectedConversation]
            + ['lastConversationUserId' => $lastConversationUserId]);
    }

    public function sendMessage(int $user_recipient, string $content, int $user_sender)
    {

        $messaging = new Messaging([
            'user_recipient' => $user_recipient,
            'user_sender' => $user_sender,
            'content' => $content,
        ]);

        $messagingManager = new MessagingManager();
        $messagingManager->sendMessage($messaging);
    }
}