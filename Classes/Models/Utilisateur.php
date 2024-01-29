<?php
    declare(strict_types=1);

    namespace Models;
    use Interfaces\RenderInterface;

    class Utilisateur {
        private $id_utilisateur;
        private $login_utilisateur;
        private $password_utilisateur;
        private $nom_utilisateur;
        private $prenom_utilisateur;
        private $ddn_utilisateur;
        private $email_utilisateur;
        private $playlist_personnelle;
        private $playlist_favorite;
        private $groupes_favoris;
    }
?>