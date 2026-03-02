<section class="detail_page">
    <p class="title_detail">Nos livres > <?php echo htmlspecialchars($book->getTitle());?></p>
    <div class="detail_section">
        <div class="detail_photo">
            <img src="img/books/<?php echo htmlspecialchars($book->getPhoto());?>" alt="Photo du livre">
        </div>
        <div class="detail_second_section">
            <h1><?php echo htmlspecialchars($book->getTitle());?></h1>
            <p class="author">par <?php echo htmlspecialchars($book->getAuthor());?></p>
            <div class="detail_line"></div>
            <label for="description_book">DESCRIPTION</label>
            <textarea readonly id="description_book" class="description_book"><?php echo htmlspecialchars($book->getDescription());?></textarea>
            <a class="owner" href="./index.php?action=publicAccount&idUser=<?php echo htmlspecialchars($book->getUserId());?>">
                <img src="img/users/<?php echo htmlspecialchars($book->getUserImg());?>" alt="Photo de l'utilisateur">
                <p><?php echo htmlspecialchars($book->getNickname());?></p>
            </a>
            <a class="detail_button"
               href="./index.php?action=<?php echo (isset($_SESSION['user'])) ? 'messaging' : 'register'; ?>&userRecipient=<?php echo htmlspecialchars($book->getUserId());?>">
                Envoyer un message
            </a>
        </div>
    </div>
</section>