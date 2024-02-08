INSERT INTO GROUPE (nom_groupe, image_groupe, description_groupe) VALUES
    ("Adèle Castillon", "groupes_artistes/adele_castillon.jpg", "Adèle Castillon");

INSERT INTO ALBUM (titre, image_album, id_groupe, dateSortie) VALUES
    ("PRD", "Cover/PRD.jpg", 1, "2021-01-01");

INSERT INTO ARTISTE (pseudo_artiste, image_artiste) VALUES
    ("Adèle Castillon", "groupes_artistes/adele_castillon.jpg");

INSERT INTO GROUPE_ARTISTE (id_groupe, id_artiste) VALUES
    ("1", "1");

INSERT INTO GENRE (nom_genre, image_genre) VALUES
    ("Rock", "genres/rock.png"),
    ("Pop",  "genres/pop.png"),
    ("Classique", "genres/classique.png"),
    ("Jazz", "genres/jazz.png"),
    ("Metal", "genres/metal.png"),
    ("Bandes originales", "genres/bandes_originales.png"),
    ("Electro", "genres/electro.png"),
    ("Reggae", "genres/reggae.png"),
    ("Funk", "genres/funk.png"),
    ("Soul", "genres/soul.png"),
    ("Country", "genres/country.png"),
    ("Blues", "genres/blues.png"),
    ("Disco", "genres/disco.png"),
    ("Folk", "genres/folk.png"),
    ("Punk", "genres/punk.png"),
    ("Hip-Hop", "genres/hip-hop.png"),
    ("RnB", "genres/rnb.png"),
    ("Rap", "genres/rap.png");

INSERT INTO ROLE (nom_role) VALUES
    ("Utilisateur"),
    ("Administrateur");

INSERT INTO UTILISATEUR (id_utilisateur, login_utilisateur, password_utilisateur, nom_utilisateur, prenom_utilisateur, ddn_utilisateur, email_utilisateur, image_utilisateur, id_role) VALUES
    (1, "admin", "8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918", "admin", "admin", "1990-01-01", "administrateur@phposong.com", NULL, 2),
    (2, "Pixa253lulu", "2e44118c06a1d5de31e551f83549ba3d9a421accf98673239ee02e4d56bc4bb1", "Ludmann", "Dorian", "dorianludm7@gmail.com", "2005-19-12", NULL, 1),
    (3, "LutinTag", "52c8658d23223219f1e8e610bcf6896963a694e7cf63cf26eddeb4aef4057868", "Massuard", "Charles", "lutintagpro@youtube.com", "2004-14-06", NULL, 1);

INSERT INTO GENRE_SIMILAIRE (id_genre, id_genre_similaire) VALUES
    (1, 2),  -- Rock is similar to Pop
    (3, 4),  -- Classique is similar to Jazz
    (5, 6),  -- Metal is similar to Bandes originales
    (7, 8),  -- Electro is similar to Reggae
    (9, 10), -- Funk is similar to Soul
    (11, 12),-- Country is similar to Blues
    (13, 14),-- Disco is similar to Folk
    (15, 16),-- Punk is similar to Hip-Hop
    (17, 18);-- RnB is similar to Rap
    

INSERT INTO PLAYLIST (nom_playlist, description_playlist, public, id_auteur) VALUES 
    ("Dorian Playlist1", "This is Dorian's first playlist", true, 2),
    ("Dorian Playlist2", "This is Dorian's second playlist", false, 2),
    ("Charles Playlist1", "This is Charles's first playlist", true, 2),
    ("Charles Playlist2", "This is Charles's second playlist", false, 3);

INSERT INTO MUSIQUE (nom_musique, duree, id_groupe, id_album, id_genre, url_musique) VALUES
    ("Alabama", "3:34", 1, 1, 2, "https://audio.jukehost.co.uk/X3NaYsB1Sc08ziSROSmXq0cHuvmAXHIn"),
    ("C'est drôle", "2:57", 1, 1, 2, "https://audio.jukehost.co.uk/S7SU27M9nTGLOwRLPdH7VT7Oqi2nvtAwé"),
    ("Doliprane", "2:46", 1, 1, 2, "https://audio.jukehost.co.uk/bzsXL9swuzwNl2NjWc2zNyaWWJmwaO1e"),
    ("Gabrielle", "3:02", 1, 1, 2, "https://audio.jukehost.co.uk/VybOSPqfOdzrWX0hPZuPxEJyMF638GXN"),
    ("Impala", "2:10", 1, 1, 2, "https://audio.jukehost.co.uk/QdmSJD67hXRQDnsgvbYhYM7xym7mcNJq"),
    ("Je t'aime", "2:19", 1, 1, 2, "https://audio.jukehost.co.uk/omJyhhKfuoYbKiZo4hbY3tr58GemEKuo"),
    ("Novembre", "2:38", 1, 1, 2, "https://audio.jukehost.co.uk/UQ7v2YVjpjNtVtFwU47z9caiR1a0vyp4"),
    ("Partir", "2:50", 1, 1, 2, "https://audio.jukehost.co.uk/gBWJXM1KAe30X0DvYmUYdwUdTSXb1XHs"),
    ("Petite Fille", "2:16", 1, 1, 2, "https://audio.jukehost.co.uk/1PQTgNzxmiV8ty85j0yJncF6DYZAkqkw"),
    ("PRD", "3:03", 1, 1, 2, "https://audio.jukehost.co.uk/eoC0mzmWIEgzZL96JZtPitUMl6bzlQhs"),
    ("Promis", "3:02", 1, 1, 2, "https://audio.jukehost.co.uk/D22hiosnmAf9Zrdy4KFyfBIMHW2T9GIa"),
    ("Rêve", "3:09", 1, 1, 2, "https://audio.jukehost.co.uk/kvz9UZDkjNnjkDYyiR574V8w5eehJUGy"),
    ("Sensations", "2:42", 1, 1, 2, "https://audio.jukehost.co.uk/Ih7CEkrMhE5vmTehoHZfvcOXSco6w4p0"),
    ("Souvenirs", "2:59", 1, 1, 2, "https://audio.jukehost.co.uk/XuXQljPdYR8YO0Za1nggCe8GL0eaq0m8");

