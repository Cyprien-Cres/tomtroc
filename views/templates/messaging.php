<section class="messaging">
    <div class="conversations_list" role="heading">
        <h1>Messagerie</h1>
        <?php foreach ($conversations as $conversation): ?>
            <?php
            $isActive = isset($_GET['userRecipient']) && ($_GET['userRecipient'] == $conversation->getUserSender()
                            || $_GET['userRecipient'] == $conversation->getUserRecipient());
            ?>
            <a role="link" aria-label="Conversation" class="conversation_item <?php echo $isActive ? 'active' : ''; ?>"
               href="./index.php?action=messaging&userRecipient=<?php
                    if ($conversation->getUserSender() == $_SESSION['user']->getId()) {
                         echo $conversation->getUserRecipient();
                    } else {
                         echo $conversation->getUserSender();
                    }
                    ?>">
                <img src="img/users/<?php echo $conversation->getUserImg() ?>" alt="Avatar de l'utilisateur">
                <div class="conversation_details" aria-label="Conversation details">
                    <div class="conversation_info">
                        <p class="conversation_info_nickname"><?php echo $conversation->getNickname() ?></p>
                        <p><?php echo date('H:i', strtotime($conversation->getCreatedAt())); ?></p>
                    </div>
                    <p class="conversation_last_message"><?php echo $conversation->getContent(); ?></p>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
    <div class="conversation">
        <div class="user_sender" >
            <img src="img/users/<?php echo $selectedConversation->getUserImg() ?>" alt="Avatar de l'utilisateur">
            <p><?php echo $selectedConversation->getNickname() ?></p>
        </div>
        <div class="conversation_messages" aria-label="Details de la conversation">
            <?php foreach ($conversationDetail as $message): ?>
                <div class="<?php echo ($message->getUserSender() == $selectedConversation->getUserSender()) ? 'received' : 'sent'; ?>">
                    <div class="received_details">
                        <img src="img/users/<?php echo $message->getUserImg() ?>" alt="Avatar de l'utilisateur">
                        <p class="message_time"><?php echo date('m/d H:i', strtotime($message->getCreatedAt())); ?></p>
                    </div>
                    <div class="message_bubble">
                        <p><?php echo $message->getContent(); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <form method="POST" class="message_form" role="form" aria-label="Envoi de message">
            <label class="hidden_label"  for="send_message">Message</label>
            <textarea type="text" id="send_message" name="content" placeholder="Tapez votre message ici"></textarea>
            <input type="hidden" name="action" value="sendMessage">
            <button type="submit">Envoyer</button>
        </form>
    </div>
</section>