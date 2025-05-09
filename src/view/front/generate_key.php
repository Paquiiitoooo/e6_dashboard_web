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
    <title>Générer une Clé</title>
    <link rel="stylesheet" href="../../../public/assets/css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

    <?php include '../template/sidebar.php'; ?>

    <div class="main-content">
        <?php include '../template/header.php'; ?>

        <section class="premium-offers">
            <h2>Génération de Clé</h2>

            <?php if (!$premium): ?>
                <p class="alert alert-warning"><?php echo $premium_message; ?></p>
            <?php elseif (!$can_generate_key): ?>
                <p class="alert alert-info"><?php echo $key_generated_message; ?></p>
            <?php else: ?>
                <form method="POST">
                    <button type="submit" name="action" value="generate" class="btn-generate">Générer une clé</button>
                </form>
            <?php endif; ?>

            <?php if ($generated_key): ?>
                <div class="key-display">
                    <h3>Clé générée</h3>
                    <input type="text" id="key-code" value="<?php echo $generated_key; ?>" readonly>
                    <button class="btn-copy" onclick="copyKey()">Copier <i class="fa fa-copy"></i></button>
                </div>
            <?php endif; ?>

            <div class="key-list">
                <h3>Clés générées</h3>
                <?php if (empty($keys)): ?>
                    <p>Aucune clé générée pour le moment.</p>
                <?php else: ?>
                    <ul>
                        <?php foreach ($keys as $key): ?>
                            <li class="key-item">
                                <span class="key-code"><?php echo $key; ?></span>
                                <form method="POST" style="display: flex; align-items: center;">
                                    <input type="hidden" name="key_code" value="<?php echo $key; ?>">
                                    <input type="hidden" name="action" value="delete">
                                    <button type="submit" class="btn-delete"><i class="fa fa-trash"></i></button>
                                </form>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </section>
    </div>

    <script>
        function copyKey() {
            var keyInput = document.getElementById("key-code");
            keyInput.select();
            document.execCommand("copy");
            alert("Clé copiée dans le presse-papier !");
        }
    </script>
</body>
</html>
