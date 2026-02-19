<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ajouter un produit</title>
    <link rel="stylesheet" href="/css/sidebar.css">
    <link rel="stylesheet" href="/css/form_add.css">
</head>
<body>
    <?php 
    $message = $message ?? '';
    $messageType = $messageType ?? '';
    include '../../includes/sidebar.php'; 
    ?>
    <div class="form_add_content">
        <div class="h-add">
            <h1>Ajouter un nouveau produit</h1>
        <a href="../pages/service.php" class="back-link">Voir tous les produits</a>
        </div>
        <p class="subtitle">Remplissez le formulaire pour ajouter un produit à la boutique</p>
        
        
        <?php if ($message): ?>
            <div class="message <?php echo $messageType; ?>">
                <?php echo $message; ?>
                <?php if ($messageType === 'success'): ?>
                    <br><small>Redirection vers la page des services...</small>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <form action="add_produits.php" method="POST" enctype="multipart/form-data" id="productForm">
            <div class="form-add">
                <label for="nom">Nom du produit <span class="required">*</span></label>
                <input type="text" 
                       id="nom" 
                       name="nom" 
                       placeholder="Ex: Logo restaurant moderne" 
                       value="<?php echo isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : ''; ?>"
                       required>
            </div>

            <div class="form-add">
                <label for="type">Catégorie <span class="required">*</span></label>
                <select name="type" id="type" required>
                    <option value="">Sélectionnez une catégorie</option>
                    <option value="logo" <?php echo (isset($_POST['type']) && $_POST['type'] === 'logo') ? 'selected' : ''; ?>>Logo</option>
                    <option value="affiche" <?php echo (isset($_POST['type']) && $_POST['type'] === 'affiche') ? 'selected' : ''; ?>>Affiche</option>
                    <option value="flyer" <?php echo (isset($_POST['type']) && $_POST['type'] === 'flyer') ? 'selected' : ''; ?>>Flyer</option>
                </select>
            </div>

            <div class="form-add">
                <label for="description">Description</label>
                <textarea id="description" 
                          name="description" 
                          placeholder="Décrivez le produit en quelques lignes..."><?php echo isset($_POST['description']) ? htmlspecialchars($_POST['description']) : ''; ?></textarea>
            </div>

            <div class="form-add">
                <label for="prix">Prix (FCFA) <span class="required">*</span></label>
                <input type="number" 
                       id="prix" 
                       name="prix" 
                       placeholder="Ex: 5000" 
                       min="0" 
                       step="100"
                       value="<?php echo isset($_POST['prix']) ? htmlspecialchars($_POST['prix']) : ''; ?>"
                       required>
                <div class="input-hint">Prix en francs CFA (minimum: 0)</div>
            </div>

            <div class="form-add">
                <label for="image">Image du produit <span class="required">*</span></label>
                <div class="file-input-wrapper">
                    <div class="file-input-button" id="fileInputButton">
                        <i class="fas fa-cloud-upload-alt"></i> Choisir une image
                    </div>
                    <input type="file" 
                           id="image" 
                           name="image" 
                           accept="image/jpeg,image/png,image/gif,image/webp"
                           required>
                </div>
                <div class="allowed-formats">
                    <i class="fas fa-info-circle"></i>
                    Formats acceptés : JPG, PNG, GIF, WEBP (max 5 Mo)
                </div>
                <div class="file-info" id="fileInfo">
                    <i class="fas fa-file-image"></i> 
                    <span id="fileName"></span> - 
                    <span id="fileSize"></span>
                </div>
            </div>

            <div class="image-preview" id="imagePreview">
                <img src="" alt="Aperçu de l'image">
            </div>

            <button type="submit">Ajouter le produit</button>
        </form>

       
    </div>

    <script>

    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const fileInfo = document.getElementById('fileInfo');
        const fileName = document.getElementById('fileName');
        const fileSize = document.getElementById('fileSize');
        const preview = document.getElementById('imagePreview');
        const previewImg = preview.querySelector('img');
        
        if (file) {

            fileName.textContent = file.name;
            

            const size = file.size;
            if (size < 1024) {
                fileSize.textContent = size + ' o';
            } else if (size < 1024 * 1024) {
                fileSize.textContent = (size / 1024).toFixed(2) + ' Ko';
            } else {
                fileSize.textContent = (size / (1024 * 1024)).toFixed(2) + ' Mo';
            }
            
            fileInfo.classList.add('show');
            

            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                preview.classList.add('show');
            }
            reader.readAsDataURL(file);
            

            const allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/jpg'];
            if (!allowedTypes.includes(file.type)) {
                alert('Type de fichier non autorisé. Veuillez sélectionner une image (JPG, PNG, GIF, WEBP)');
                this.value = '';
                fileInfo.classList.remove('show');
                preview.classList.remove('show');
            }
            
            // Vérifier la taille (5 Mo max)
            if (file.size > 5 * 1024 * 1024) {
                alert('Le fichier est trop volumineux. Taille maximum : 5 Mo');
                this.value = '';
                fileInfo.classList.remove('show');
                preview.classList.remove('show');
            }
        } else {
            fileInfo.classList.remove('show');
            preview.classList.remove('show');
        }
    });

    // Validation du formulaire
    document.getElementById('productForm').addEventListener('submit', function(e) {
        const nom = document.getElementById('nom').value.trim();
        const type = document.getElementById('type').value;
        const prix = parseFloat(document.getElementById('prix').value);
        const image = document.getElementById('image').files[0];

        if (!nom) {
            e.preventDefault();
            alert('Veuillez saisir le nom du produit');
            return;
        }

        if (!type) {
            e.preventDefault();
            alert('Veuillez sélectionner une catégorie');
            return;
        }

        if (isNaN(prix) || prix < 0) {
            e.preventDefault();
            alert('Veuillez saisir un prix valide');
            return;
        }

        if (!image) {
            e.preventDefault();
            alert('Veuillez sélectionner une image');
            return;
        }
    });

    // Style pour le bouton de fichier au survol
    const fileInput = document.getElementById('image');
    const fileButton = document.getElementById('fileInputButton');
    
    fileInput.addEventListener('mouseenter', function() {
        fileButton.style.transform = 'translateY(-2px)';
        fileButton.style.boxShadow = '0 10px 20px rgba(102, 126, 234, 0.3)';
    });
    
    fileInput.addEventListener('mouseleave', function() {
        fileButton.style.transform = 'translateY(0)';
        fileButton.style.boxShadow = 'none';
    });
    </script>

        </form>
    </div>
</body>
</html>