INSERT INTO GROUPE (nom_groupe, image_groupe, decription_groupe) VALUES (?, ?, ?);

INSERT INTO ALBUM (titre, image_album, id_groupe, dateSortie) VALUES (?, ?, ?, ?);

INSERT INTO ARTISTE (pseudo_artiste, image_artiste) VALUES (?, ?);

INSERT INTO ALBUM_ARTISTE (id_album, id_artiste) VALUES (?, ?);

INSERT INTO GROUPE_ARTISTE (id_groupe, id_artiste) VALUES (?, ?);

INSERT INTO GENRE (nom_genre) VALUES
    ("Rock"),
    ("Pop"),
    ("Rap"),
    ("Classique"),
    ("Jazz"),
    ("Metal"),
    ("Electro"),
    ("Reggae"),
    ("Funk"),
    ("Soul"),
    ("Country"),
    ("Blues"),
    ("Disco"),
    ("Folk"),
    ("Hip-Hop"),
    ("Punk"),
    ("RnB"),
    ("Techno"),
    ("Variété"),
    ("World");

INSERT INTO ROLE (nom_role) VALUES
    ("Utilisateur"),
    ("Administrateur");

INSERT INTO UTILISATEUR (login_utilisateur, password_utilisateur, nom_utilisateur, prenom_utilisateur, ddn_utilisateur, email_utilisateur, image_utilisateur, id_role) VALUES
    ("admin", "2y$10$07/0jlGYYSSwcRV0cdtw8.pUNM9SJniFA6slOgNtNBQ5UX5NJoeaC", "admin", "admin", "1990-01-01", "administrateur@phposong.com", NULL, 2),
    ("Pixa253lulu", "2y$10$j2k4KQI8QDnikv6T7Mc7YeZpFNu0ERntS9/9s6/xbE0aGw8KrSKNu", "Ludmann", "Dorian", "dorianludm7@gmail.com", NULL, 1);
    ("LutinTag", "2y$10$IYDDKNrDaeYmVNLpQNWpLu/ETu9xCo4h03mRbMqaeO.Sx.KOlE1Qa", "Massuard", "Charles", "lutintagpro@youtube.com", NULL, 1);

INSERT INTO ALBUM_NOTE (id_album, id_utilisateur, note) VALUES (?, ?, ?);

INSERT INTO GENRE_SIMILAIRE (id_genre, id_genre_similaire) VALUES (?, ?);

INSERT INTO PLAYLIST (nom_playlist, description_playlist, public, id_auteur) VALUES (?, ?, ?, ?);

INSERT INTO MUSIQUE (nom_musique, duree, id_groupe, id_album, id_genre) VALUES (?, ?, ?, ?, ?);

INSERT INTO PLAYLIST_MUSIQUE (id_playlist, id_musique) VALUES (?, ?);

INSERT INTO PLAYLIST_NOTE (id_playlist, id_utilisateur, note) VALUES (?, ?, ?);

INSERT INTO PLAYLIST_FAVORIS (id_playlist, id_utilisateur) VALUES (?, ?);

INSERT INTO GROUPE_FAVORIS (id_groupe, id_utilisateur) VALUES (?, ?);
