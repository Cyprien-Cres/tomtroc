<section class="edit_page">
    <div class="edit_header">
        <a class="edit_link" href="./index.php?action=account">
            <img alt="Logo flêche gauche" src="img/edit/arrow_left_icon.svg">
            <p>retour</p>
        </a>
        <h1>Ajouter un livre</h1>
    </div>
    <form method="post" role="form" aria-label="Ajouter un livre" class="edit_form" enctype="multipart/form-data">
        <div class="edit_photo">
            <h2>Photo</h2>
            <img class="add_photo_img" src="img/add/add_img_logo.svg" alt="Ajouter une photo">
            <p id="file-error" class="error_message hidden" role="alert"></p>
            <label class="edit_photo_label" for="fileToUpload">Modifier la photo</label>
            <input class="edit_file" type="file" name="fileToUpload" id="fileToUpload" accept="image/*">
        </div>
        <div class="edit_inputs">
            <label class="label_form" for="title">Titre</label>
            <input type="text" id="title" name="title" class="<?php echo !empty($errorTitle) ? 'input_error' : 'edit_input'; ?>">
            <?php if (!empty($errorTitle)) : ?>
                <p class="error_message" role="alert">
                    <?php echo htmlspecialchars($errorTitle); ?>
                </p>
            <?php endif; ?>
            <label class="label_form" for="author">Auteur</label>
            <input type="text" id="author" name="author" class="<?php echo !empty($errorAuthor) ? 'input_error' : 'edit_input'; ?>">
            <?php if (!empty($errorAuthor)) : ?>
                <p class="error_message" role="alert">
                    <?php echo htmlspecialchars($errorAuthor); ?>
                </p>
            <?php endif; ?>
            <label class="label_form" for="description">Commentaire</label>
            <textarea class="<?php echo !empty($errorDescription) ? 'description_error' : 'description_input'; ?>" id="description" name="description" ></textarea>
            <?php if (!empty($errorDescription)) : ?>
                <p class="error_message" role="alert">
                    <?php echo htmlspecialchars($errorDescription); ?>
                </p>
            <?php endif; ?>
            <label class="label_form" for="available">Disponibilité</label>
            <select class="available_input" name="available" id="available">
                <option value="1">disponible</option>
                <option value="0">non disponible</option>
            </select>
            <button class="edit_button" type="submit">Valider</button>
        </div>
    </form>
</section>

<script>
    document.getElementById('fileToUpload').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const userImg = document.querySelector('.add_photo_img');
        const errorMsg = document.getElementById('file-error');

        errorMsg.textContent = "";
        errorMsg.classList.add('hidden');
        userImg.classList.remove('img_error'); // Reset bordure image

        const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (file && !allowedTypes.includes(file.type)) {
            this.value = "";
            userImg.src = "img/add/add_img_logo.svg";
            userImg.classList.add('img_error'); // Bordure rouge sur l'image
            errorMsg.textContent = "Le fichier doit être au format JPG, JPEG, PNG ou GIF.";
            errorMsg.classList.remove('hidden');
            return;
        }

        const maxSize = 8 * 1024 * 1024;
        if (file && file.size > maxSize) {
            this.value = "";
            userImg.src = "img/add/add_img_logo.svg";
            userImg.classList.add('img_error'); // Bordure rouge sur l'image
            errorMsg.textContent = "Le fichier est trop volumineux. Maximum 8 Mo.";
            errorMsg.classList.remove('hidden');
            return;
        }

        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(event) {
                userImg.src = event.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>