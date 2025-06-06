<?php

function afficherErreur($type)
{
    return match ($type) {
        "email" => "L'email n'est pas valide",
        "pseudo" => "Le pseudo n'est pas valide",
        "pass" => "Les mots de passe ne correspondent pas ou ne sont pas assez long",
    };
}
$error = $_GET["error"] ?? "";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de connexion</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles\styles.css">
</head>
<body>
    <main>
        <form action="requests/traitement.php" method="post" enctype="multipart/form-data">
            <div class="global">
                <h1>Connexion</h1>
                <label for="pseudo">Pseudo</label>
                <input type="text" id="pseudo" name="pseudo" required />

                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="pass" required />

                <label for="confirm_password">Confirmer le mot de passe</label>
                <input type="password" id="confirm_password" name="confirm_pass" required />
                <label for="file">Fichier</label><br>
                <input type="file" name="uploadFile" id="file" accept=".png,.jpg,.jpeg,.gif,.webp,.avif"><br><br>
                <div class="button">
                    <input type="submit" name="submit" value="S'inscrire" />
                </div>
            </div>
      </form>
    </main>
</body>
</html>