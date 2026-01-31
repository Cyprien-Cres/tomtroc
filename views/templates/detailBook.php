<section class="detail_page">
    <?php var_dump($book);?>
    <p class="title_detail">Nos livres > <?php echo htmlspecialchars($book->getTitle());?></p>
    <div class="detail_section">
        <div class="detail_photo">
            <img src="img/books/<?php echo htmlspecialchars($book->getPhoto());?>" alt="Photo du livre">
        </div>
        <div class="detail_second_section">
            <h1><?php echo htmlspecialchars($book->getTitle());?></h1>
            <p class="author">par <?php echo htmlspecialchars($book->getAuthor());?></p>
            <div class="detail_line"></div>
            <h2>DESCRIPTION</h2>
            <textarea readonly class="description_book"><?php echo htmlspecialchars($book->getDescription());?></textarea>
            <div class="owner">
                <img src="img/users/<?php echo htmlspecialchars($book->getUserImg());?>" alt="Photo de l'utilisateur">
                <p><?php echo htmlspecialchars($book->getNickname());?></p>
            </div>
            <a href="./index.php?action=<?php echo (isset($_SESSION['user'])) ? 'message' : 'register'; ?>">
                <button class="detail_button">Envoyer un message</button>
            </a>
        </div>
    </div>
</section>