<?php
// Connexion à la base de données
$dsn = 'mysql:host=localhost;dbname=nom_de_votre_base_de_données';
$username = 'votre_nom_utilisateur';
$password = 'votre_mot_de_passe';

try {
    $pdo = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    die('Erreur de connexion : ' . $e->getMessage());
}

// Récupération des données du formulaire
$email = $_POST['email'];
$mot_de_passe = $_POST['mot_de_passe'];

// Requête SQL pour récupérer l'utilisateur correspondant à l'email fourni
$sql = "SELECT * FROM utilisateurs WHERE email = :email";
$stmt = $pdo->prepare($sql);
$stmt->execute(['email' => $email]);
$user = $stmt->fetch();

// Vérification du mot de passe
if ($user && password_verify($mot_de_passe, $user['mot_de_passe'])) {
    echo 'Connexion réussie !';
    // Vous pouvez rediriger l'utilisateur vers une page de bienvenue, par exemple
    // header('Location: bienvenue.php');
} else {
    echo 'Email ou mot de passe incorrect.';
}
?>
