<?php

// SI QUELQU'UN SE REND SUR CETTE PAGE AUTREMENT QU'EN POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../index.php");
    die;
}

// ON VA VERIFIER SI L'UTILISATEUR PROVIENT BIEN DU FORMULAIRE
if (!isset($_POST["submit"])) {
    header("Location: ../index.php?fytytf");
    die;
}

// L'UTILISATEUR EST BIENVEILLANT
// SI LE PSEUDO FAIT MOINS DE 2 CARACTERES
if (strlen(trim($_POST['pseudo'])) < 2) {
    header("Location: ../index.php?error=pseudo");
    die;
}
// SI L'EMAIL N'EST PAS UN EMAIL
// $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
// if (!$email) {
//     header("Location: ../index.php?error=email");
//     die;
// }
// SI LES MOTS DE PASSE NE CORRESPONDENT PAS OU SI INFERIEUR A 4 CARACTERES
// if ($_POST["pass"] != $_POST["confirm_pass"] || strlen(trim($_POST["pass"])) < 4) {
//     header("Location: ../index.php?error=pass");
//     die;
// }

// Sécurise l'entrée
// $email = trim($_POST['email']);

// Vérifie si l'email est valide
// if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//     // Redirige avec un message d'erreur
//     header("Location: index.php?erreur=1");
//     exit;
// }

// Si tout est bon
// echo "<p style='color: green;'>Merci ! Votre adresse e-mail <strong>" . htmlspecialchars($email) . "</strong> est valide.</p>";

// Si les mots de passe ne correspondent pas ou si interieur à 8 caractères
if ($_POST["pass"] == $_POST["confirm_pass"] && strlen(trim($_POST["pass"])) > 7) {
    $passLetters = str_split($_POST["pass"]);
    $uppercases = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "À", "É", "È", "Ù", "Ê", "Ô", "Ì", "Ï", "Ÿ", "Ç"];
    $numbers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 0];
    $checkUppercase = false;
    $checkNumber = false;

    foreach ($passLetters as $passLetter) {
        if (in_array($passLetter, $uppercases)) {
            $checkUppercase = true;
            break;
        }
    }
    foreach ($passLetters as $passLetter) {
        if (in_array($passLetter, $numbers)) {
            $checkNumber = true;
            break;
        }
    }
    if (!$checkUppercase || !$checkNumber) {
        header("Location: ../index.php?error=pass_sans_chiffres");
        die;
    }
} else {
    // SI LES MOTS DE PASSE NE CORRESPONDENT PAS OU SI INFERIEUR A 8 CARACTERES
    header("Location: ../index.php?error=pass");
    die;
}

echo "Bien joué !";

// Traitement de l'image
$file = $_FILES["uploadFile"];
var_dump($file);

// Si le fichier a autre chose que 0 en erreur
if ($file["error"] !== 0) {
    header("Location: ../index.php?error=file");
    die;
}

// On vérifie la taille du fichier
if ($file["size"] < 1 || $file["size"] > 2_000_000) {
    header("Location: ../index.php?error=file");
    die;
}

// On vérifie l'extension si autorisée : .png, .jpg, .jpeg, .gif, .webp, .avif
$allowedExtensions = ["png", "jpg", "jpeg", "gif", "webp", "avif"];
$fileDecompose = explode (".", $file["name"]);
$extension = end($fileDecompose);
var_dump($extension);

// On va génèrer un nom au hasard "non-trouvable"
$filename = bin2hex(random_bytes(20)) . time() . ".$extension";
// "machintruchjza10z245e240254222365.jpg

// On déplace le fichier temp dans notre dossier final (uploads)
if(move_uploaded_file($file["tmp_name"], "../uploads/$filename")) {
    echo "L'image a été importée";
}
