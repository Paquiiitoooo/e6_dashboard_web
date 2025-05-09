<?php
    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php");
        exit();
    }
    
    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    
    function generateKey() {
        return bin2hex(random_bytes(16)); // Génère une clé aléatoire
    }
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['generate_key'])) {
        if ($user['is_premium']) {
            $key = generateKey();
            $stmt = $conn->prepare("INSERT INTO `keys` (key_code, user_id) VALUES (?, ?)");
            $stmt->bind_param("si", $key, $user_id);
            $stmt->execute();
            echo "<div class='alert success'>Clé générée: $key</div>";
        } else {
            echo "<div class='alert error'>Vous devez être premium pour générer une clé.</div>";
        }
    }

    //Generate Key Page
    // Vérifier si l'utilisateur est connecté et premium
    if (!isset($_SESSION['user_id'])) {
        die("Vous devez être connecté pour accéder à cette page.");
    }

    $user_id = $_SESSION['user_id'];
    $sql = "SELECT is_premium, key_generated, username FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($is_premium, $key_generated, $username);
    $stmt->fetch();
    $stmt->close();

    $premium = ($is_premium == 1);
    $can_generate_key = ($key_generated == 0);
    $premium_message = $premium ? "" : "Vous devez être premium pour générer une clé.";
    $key_generated_message = $can_generate_key ? "" : "Vous avez déjà généré une clé.";

    $generated_key = null;

    // Gestion du formulaire (génération ou suppression de clé)
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['action']) && $_POST['action'] == 'generate' && $premium && $can_generate_key) {
            $key_code = generateKey();
            $insert_sql = "INSERT INTO `keys` (key_code, user_id) VALUES (?, ?)";
            $stmt = $conn->prepare($insert_sql);
            $stmt->bind_param("si", $key_code, $user_id);

            if ($stmt->execute()) {
                $stmt->close();
                $update_sql = "UPDATE users SET key_generated = 1 WHERE id = ?";
                $stmt_update = $conn->prepare($update_sql);
                $stmt_update->bind_param("i", $user_id);
                $stmt_update->execute();
                $stmt_update->close();
                $generated_key = $key_code;
            }
        } elseif (isset($_POST['action']) && $_POST['action'] == 'delete') {
            $key_code = $_POST['key_code'];
            $delete_sql = "DELETE FROM `keys` WHERE key_code = ? AND user_id = ?";
            $stmt_delete = $conn->prepare($delete_sql);
            $stmt_delete->bind_param("si", $key_code, $user_id);

            if ($stmt_delete->execute()) {
                $update_sql = "UPDATE users SET key_generated = 0 WHERE id = ?";
                $stmt_update = $conn->prepare($update_sql);
                $stmt_update->bind_param("i", $user_id);
                $stmt_update->execute();
                $stmt_update->close();
            }
        }
    }

    // Récupérer les clés générées
    $sql_keys = "SELECT key_code FROM `keys` WHERE user_id = ?";
    $stmt_keys = $conn->prepare($sql_keys);
    $stmt_keys->bind_param("i", $user_id);
    $stmt_keys->execute();
    $result_keys = $stmt_keys->get_result();
    $keys = [];
    while ($row = $result_keys->fetch_assoc()) {
        $keys[] = $row['key_code'];
    }
    $stmt_keys->close();

    // Stocker les infos utilisateur pour le header
    $user = [
        'username' => $username,
        'is_premium' => $is_premium
    ];


    // Premium Page
    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php");
        exit();
    }
    
    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirm_upgrade'])) {
        // Mise à jour du statut premium
        $stmt = $conn->prepare("UPDATE users SET is_premium = 1 WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
    
        // Rediriger pour recharger la page et afficher la mise à jour
        header("Location: premium.php");
        exit();
    }
?>