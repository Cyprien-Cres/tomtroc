<section class="edit_page">
    <a class="edit_link" href="./index.php?action=account">
        <img src="img/edit/arrow_left_icon.svg">
        <p>retour</p>
    </a>
    <h1>Modifier les informations</h1>
    <form class="edit_form" method="post" enctype="multipart/form-data">
        <div class="edit_photo">
            <h2>Photo</h2>
            <img class="edit_photo_img" src="img/books/<?php echo htmlspecialchars($book->getPhoto());?>" alt="Photo du livre">
            <label class="edit_photo_label" for="fileToUpload">Modifier la photo</label>
            <input class="edit_file" type="file" name="fileToUpload" id="fileToUpload" accept="image/*">
        </div>
        <div class="edit_inputs">
            <label class="label_form" for="title">Titre</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($book->getTitle());?>" required>
            <label class="label_form" for="author">Auteur</label>
            <input type="text" id="author" name="author" value="<?php echo htmlspecialchars($book->getAuthor());?>" required>
            <label class="label_form" for="description">Commentaire</label>
            <textarea class="description_input" id="description" name="description" ><?php echo htmlspecialchars($book->getDescription());?></textarea>
            <label class="label_form" for="available">Disponibilité</label>
            <select class="available_input" name="available" id="available">
                <option value="1" <?php echo $book->getAvailable() === 1 ? 'selected' : ''; ?>>disponible</option>
                <option value="0" <?php echo $book->getAvailable() === 0 ? 'selected' : ''; ?>>non disponible</option>
            </select>
            <input type="hidden" name="id" value="<?= htmlspecialchars($book->getId()) ?? '';?>">
            <input type="hidden" name="action" value="updateBook">
            <button class="edit_button" type="submit">Valider</button>
        </div>
    </form>
</section>

<script>
    document.getElementById('fileToUpload').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const userImg = document.querySelector('.edit_photo_img');

        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(event) {
                userImg.src = event.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
