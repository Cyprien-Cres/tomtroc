<?php

class MessagingController
{
    public function showMessaging()
    {
        $id = $_SESSION['user']->getId();

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
        }

        // Quand l'utilisateur ouvre une conversation avec un destinataire
        if (isset($_GET['userRecipient']) && !empty($_GET['userRecipient'])) {
            $userRecipientId = (int) $_GET['userRecipient'];
            $currentUserId = $_SESSION['user']->getId();

            // Marquer les messages de cette conversation comme lus
            $messagingManager->markMessagesAsRead($currentUserId, $userRecipientId);

            // Recalculer le compteur de messages non lus
            $_SESSION['unreadCounter'] = $messagingManager->countUnreadMessages($currentUserId);
        }

        $view = new View("Messagerie - Tom Troc");
        $view->render("messaging" , ['conversations' => $conversations]
            + ['conversationDetail' => $conversationDetail]
            + ['selectedConversation' => $selectedConversation]
            + ['lastConversationUserId' => $lastConversationUserId]);
    }

    public function sendMessage()
    {
        // userSender dans l'URL est en fait le destinataire
        $user_recipient = $_GET['userRecipient'];
        $content = $_POST['content'];
        $user_sender = $_SESSION['user']->getId();

        $messaging = new Messaging([
            'user_recipient' => $user_recipient,
            'user_sender' => $user_sender,
            'content' => $content,
        ]);

        $messagingManager = new MessagingManager();
        $messagingManager->sendMessage($messaging);

        $messagingManager->getAllConversation($user_sender);

        Utils::redirect("messaging&userRecipient=$user_recipient");
    }
}