<?php
if (!isset($_SESSION)) {
    session_start();
}

include '../../../config/db.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    die("Vous devez être connecté pour accéder à cette page.");
}

$user_id = $_SESSION['user_id'];

// Récupérer les informations de l'utilisateur
$stmt = $conn->prepare("SELECT username, is_premium FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    die("Utilisateur non trouvé.");
}
?>

<header class="dashboard-header">
    <div class="user-info">
        <p><strong>Nom d'utilisateur :</strong> <?php echo htmlspecialchars($user['username']); ?></p>
        <p><strong>Status :</strong> <?php echo $user['is_premium'] ? 'Premium' : 'Standard'; ?></p>
    </div>
    <div class="header-actions">
        <a href="#" class="download-btn">Télécharger l'application</a>
        <a href="logout.php" class="btn-logout">Se déconnecter</a>
    </div>
</header>