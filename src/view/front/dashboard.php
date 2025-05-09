<?php
session_start();
require '../../../config/db.php';
require __DIR__ . '../../../controller/queryController.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
    <link rel="stylesheet" href="../../../public/assets/css/style.css">
</head>
<body>
    <div class="dashboard-wrapper">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <h2>Tableau de bord</h2>
            </div>
            <ul class="sidebar-menu">
                <li><a href="dashboard.php">Accueil</a></li>
                <li class="active"><a href="premium.php">Devenir Premium</a></li>
                <li><a href="generate_key.php">Générer une clé</a></li>
                <ul class="nav-bottom">
                    <li><a href="dashboard.php">Mention Légales</a></li>
                    <li class="active"><a href="premium.php">CGV</a></li>
                    <li><a href="generate_key.php">CGU</a></li>
                </ul>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
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

            <section class="recent-keys">
                <h2>Clés générées récemment</h2>
                <?php
                $stmt = $conn->prepare("SELECT key_code, DATE_FORMAT(created_at, '%d/%m/%y') AS created_at  FROM `keys` WHERE user_id = ? ORDER BY created_at DESC LIMIT 5");
                $stmt->bind_param("i", $user_id);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    echo "<ul>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<li><strong>{$row['key_code']}</strong> (Généré le {$row['created_at']})</li>";
                    }
                    echo "</ul>";
                } else {
                    echo "<p>Aucune clé générée récemment.</p>";
                }
                ?>
            </section>
        </div>
    </div>
</body>
</html>