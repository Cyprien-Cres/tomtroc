<section class="edit_page">
    <div class="edit_header">
        <a class="edit_link" href="./index.php?action=account">
            <img alt="Logo flêche gauche" src="img/edit/arrow_left_icon.svg">
            <p>retour</p>
        </a>
        <h1>Modifier les informations</h1>
    </div>
    <form role="form" aria-label="Éditer un livre" class="edit_form" method="post" enctype="multipart/form-data">
        <div class="edit_photo">
            <h2>Photo</h2>
            <?php if (empty($book->getPhoto())) : ?>
                <img class="edit_photo_img" src="img/add/add_img_logo.svg" alt="Aucune photo disponible">
            <?php else : ?>
            <img class="edit_photo_img" src="img/books/<?php echo htmlspecialchars($book->getPhoto());?>" alt="Photo du livre">
            <?php endif; ?>
            <p id="file-error" class="error_message hidden" role="alert"></p>
            <label class="edit_photo_label" for="fileToUpload">Modifier la photo</label>
            <input class="edit_file" type="file" name="fileToUpload" id="fileToUpload" accept="image/*">
        </div>
        <div class="edit_inputs">
            <label class="label_form" for="title">Titre</label>
            <input type="text" id="title" class="<?php echo !empty($errorTitle) ? 'input_error' : 'edit_input'; ?>" name="title" value="<?php echo htmlspecialchars($book->getTitle());?>">
            <?php if (!empty($errorTitle)) : ?>
                <p class="error_message" role="alert">
                    <?php echo htmlspecialchars($errorTitle); ?>
                </p>
            <?php endif; ?>
            <label class="label_form" for="author">Auteur</label>
            <input type="text" id="author" class="<?php echo !empty($errorAuthor) ? 'input_error' : 'edit_input'; ?>" name="author" value="<?php echo htmlspecialchars($book->getAuthor());?>">
            <?php if (!empty($errorAuthor)) : ?>
                <p class="error_message" role="alert">
                    <?php echo htmlspecialchars($errorAuthor); ?>
                </p>
            <?php endif; ?>
            <label class="label_form" for="description">Commentaire</label>
            <textarea class="<?php echo !empty($errorDescription) ? 'description_error' : 'description_input'; ?>" id="description" name="description" ><?php echo htmlspecialchars($book->getDescription());?></textarea>
            <?php if (!empty($errorDescription)) : ?>
                <p class="error_message" role="alert">
                    <?php echo htmlspecialchars($errorDescription); ?>
                </p>
            <?php endif; ?>
            <label class="label_form" for="available">Disponibilité</label>
            <select class="available_input" name="available" id="available">
                <option value="1" <?php echo $book->getAvailable() === 1 ? 'selected' : ''; ?>>disponible</option>
                <option value="0" <?php echo $book->getAvailable() === 0 ? 'selected' : ''; ?>>non disponible</option>
            </select>
            <input type="hidden" name="id" value="<?= htmlspecialchars($book->getId()) ?? '';?>">
            <button class="edit_button" type="submit">Valider</button>
        </div>
    </form>
</section>

<script>
    document.getElementById('fileToUpload').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const bookImg = document.querySelector('.edit_photo_img');
        const errorMsg = document.getElementById('file-error');

        errorMsg.textContent = "";
        errorMsg.classList.add('hidden');
        bookImg.classList.remove('img_error');

        const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (file && !allowedTypes.includes(file.type)) {
            this.value = "";
            bookImg.src = "img/add/add_img_logo.svg";
            bookImg.classList.add('img_error');
            errorMsg.textContent = "Le fichier doit être au format JPG, JPEG, PNG ou GIF.";
            errorMsg.classList.remove('hidden');
            return;
        }

        const maxSize = 8 * 1024 * 1024;
        if (file && file.size > maxSize) {
            this.value = "";
            bookImg.src = "img/add/add_img_logo.svg";
            bookImg.classList.add('img_error');
            errorMsg.textContent = "Le fichier est trop volumineux. Maximum 8 Mo.";
            errorMsg.classList.remove('hidden');
            return;
        }

        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(event) {
                bookImg.src = event.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
