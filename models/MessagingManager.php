<?php

class MessagingManager extends AbstractEntityManager
{
    public function getAllConversation(int $user_sender) {
        $sql = "SELECT messages.*, users.nickname as nickname, users.user_img as user_img
        FROM messages
        INNER JOIN users ON users.id = CASE 
            WHEN messages.user_sender = :user_id THEN messages.user_recipient 
            ELSE messages.user_sender 
        END
        INNER JOIN (
            SELECT LEAST(user_sender, user_recipient) as user1,
                GREATEST(user_sender, user_recipient) as user2,
                MAX(created_at) as last_message_date
            FROM messages
            WHERE user_sender = :user_id OR user_recipient = :user_id
            GROUP BY LEAST(user_sender, user_recipient), GREATEST(user_sender, user_recipient)
        ) as latest ON LEAST(messages.user_sender, messages.user_recipient) = latest.user1
            AND GREATEST(messages.user_sender, messages.user_recipient) = latest.user2
            AND messages.created_at = latest.last_message_date
        WHERE messages.user_sender = :user_id OR messages.user_recipient = :user_id
        ORDER BY messages.created_at DESC";

        $result = $this->db->query($sql, ['user_id' => $user_sender]);
        $conversations = [];
        while ($row = $result->fetch()) {
            $conversations[] = new Messaging($row);
        }
        return $conversations;
    }

    public function getConversation(int $user_sender, int $user_recipient) {
        $sql = "SELECT messages.*,
        sender.nickname as nickname,
        sender.user_img as user_img
        FROM messages
        INNER JOIN users as sender ON messages.user_sender = sender.id
        WHERE (user_sender = :user_sender AND user_recipient = :user_recipient)
        OR (user_sender = :user_recipient AND user_recipient = :user_sender)
        ORDER BY created_at ASC";

        $result = $this->db->query($sql, [
            'user_sender' => $user_sender,
            'user_recipient' => $user_recipient
        ]);

        $conversationDetail = [];
        while ($row = $result->fetch()) {
            $conversationDetail[] = new Messaging($row);
        }
        return $conversationDetail;
    }

    public function getLastConversationUserId(int $userId): ?int
    {
        $sql = "SELECT CASE 
                        WHEN user_sender = :userId THEN user_recipient 
                        ELSE user_sender 
                    END as other_user_id
                FROM messages
                WHERE user_sender = :userId OR user_recipient = :userId
                ORDER BY created_at DESC
                LIMIT 1";
        $lastConversationUserId = $this->db->query($sql, ['userId' => $userId]);

        return $lastConversationUserId->fetchColumn() ?: null;
    }

    public function countUnreadMessages(int $userId): int
    {
        $sql = "SELECT COUNT(*) FROM messages WHERE user_recipient = :userId AND is_read = 0";
        $unreadCount = $this->db->query($sql, ['userId' => $userId]);

        return $unreadCount->fetchColumn() ?: 0;
    }

    public function markMessagesAsRead(int $user_recipient, int $user_sender): void
    {
        $sql = "UPDATE messages 
            SET is_read = 1 
            WHERE user_recipient = :user_recipient 
            AND user_sender = :user_sender
            AND is_read = 0";
        $this->db->query($sql, [
            'user_recipient' => $user_recipient,
            'user_sender' => $user_sender
        ]);
    }
    public function sendMessage($messaging) {
        $sql = "INSERT INTO messages (user_sender, user_recipient, content) VALUES (:user_sender, :user_recipient, :content)";
        $this->db->query($sql, [
            'user_sender' => $messaging->getUserSender(),
            'user_recipient' => $messaging->getUserRecipient(),
            'content' => $messaging->getContent()
        ]);
    }
}