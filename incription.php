<?php
// Connexion à la base de données
$dsn = 'mysql:host=localhost;dbname=INMD';
$username = 'root';
$password = 'root';

try {
    $pdo = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    die('Erreur de connexion : ' . $e->getMessage());
}

// Récupération des données du formulaire
$nom = $_POST['nom'];
$email = $_POST['email'];
$mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT); // Hachage du mot de passe

// Préparation de la requête SQL d'insertion
$sql = "INSERT INTO utilisateurs (nom, email, mot_de_passe) VALUES (:nom, :email, :mot_de_passe)";
$stmt = $pdo->prepare($sql);

// Exécution de la requête
if ($stmt->execute(['nom' => $nom, 'email' => $email, 'mot_de_passe' => $mot_de_passe])) {
    echo 'Inscription réussie !';
} else {
    echo 'Erreur lors de l\'inscription.';
}
// Redirection vers la page d'accueil
header('Location: index.html');
exit;
?>
