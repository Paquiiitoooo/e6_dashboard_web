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
    <title>Devenir Premium</title>
    <link rel="stylesheet" href="../../../public/assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <?php include '../template/sidebar.php'; ?>

        <div class="main-content">
            <?php include '../template/header.php'; ?>

            <section class="premium-offers">
                <h2>Choisissez votre offre Premium</h2>
                <div class="offer-cards">
                    <!-- Offre 1 -->
                    <div class="offer-card" data-offer="1">
                        <h3>Offre 1</h3>
                        <p>Accès complet aux fonctionnalités pendant 1 mois.</p>
                        <p><strong>€10</strong> / mois</p>
                        <button class="btn-select-offer">Choisir cette offre</button>
                    </div>

                    <!-- Offre 2 -->
                    <div class="offer-card" data-offer="2">
                        <h3>Offre 2</h3>
                        <p>Accès complet aux fonctionnalités pendant 3 mois.</p>
                        <p><strong>€25</strong> / 3 mois</p>
                        <button class="btn-select-offer">Choisir cette offre</button>
                    </div>

                    <!-- Offre 3 -->
                    <div class="offer-card" data-offer="3">
                        <h3>Offre 3</h3>
                        <p>Accès complet aux fonctionnalités pendant 6 mois.</p>
                        <p><strong>€40</strong> / 6 mois</p>
                        <button class="btn-select-offer">Choisir cette offre</button>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- Modal de confirmation -->
    <div class="modal-overlay" id="modal-overlay">
        <div class="modal">
            <p>Êtes-vous sûr de vouloir souscrire à cette offre ?</p>
            <form action="premium.php" method="POST">
                <input type="hidden" name="offer_id" id="offer-id">
                <div>                
                    <button type="submit" name="confirm_upgrade" class="btn-primary">Confirmer</button>
                    <button type="button" class="btn-cancel" id="close-modal">Annuler</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Script pour gérer l'affichage du modal et la sélection d'une offre
        $(document).ready(function() {
            $('.btn-select-offer').on('click', function() {
                var offerId = $(this).closest('.offer-card').data('offer');
                $('#offer-id').val(offerId); // On envoie l'ID de l'offre au modal
                $('#modal-overlay').fadeIn(); // Affiche le modal
            });

            $('#close-modal').on('click', function() {
                $('#modal-overlay').fadeOut(); // Cache le modal
            });
        });
    </script>
</body>
</html>