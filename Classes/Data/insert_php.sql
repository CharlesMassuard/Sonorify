INSERT INTO GROUPE (nom_groupe, image_groupe, description_groupe) VALUES
    ("Adèle Castillon", "groupes_artistes/adele_castillon.jpg", "Adèle Castillon"),
    ("Vidéoclub", "groupes_artistes/videoclub.png", "Vidéoclub"),
    ("TagadaJones", "groupes_artistes/tagadajones.jpg", "TagadaJones"),
    ("Hans Zimmer", "groupes_artistes/hanszimmer.jpg", "Hans Zimmer"),
    ("Avicii", "groupes_artistes/avicii.jpg", "Avicii");

INSERT INTO ALBUM (titre, image_album, id_groupe, dateSortie) VALUES
    ("Plaisir Risque Dépendance", "Cover/PRD.jpg", 1, "20-10-2023"),
    ("Euphories", "Cover/Euphories.jpg", 2, "29-01-2021"),
    ("La peste & le choléra", "Cover/LaPesteEtLeCholera.jpeg", 3, "03-03-2017"),
    ("Inception", "Cover/Inception.jpg", 4, "21-07-2010"),
    ("True", "Cover/True.jpg", 5, "16-09-2013");

INSERT INTO ARTISTE (pseudo_artiste, image_artiste) VALUES
    ("Adèle Castillon", "groupes_artistes/adele_castillon.jpg");

INSERT INTO GROUPE_ARTISTE (id_groupe, id_artiste) VALUES
    ("1", "1"),
    ("2", "1");

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
    -- PRD
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
    ("Souvenirs", "2:59", 1, 1, 2, "https://audio.jukehost.co.uk/XuXQljPdYR8YO0Za1nggCe8GL0eaq0m8"),
    -- Euphories
    ("808", "2:57", 2, 2, 2, "https://audio.jukehost.co.uk/Kv05SqT6wAKgCuB90TLAc3kj0muzFzKO"),
    ("Amour Plastique", "3:45", 2, 2, 2, "https://audio.jukehost.co.uk/wVHxQCHmPouUT5P48UWQ7RAptb6qylpw"),
    ("En nuit", "3:41", 2, 2, 2, "https://audio.jukehost.co.uk/OFv7K7OeD6Q3eTCSuKgmiEXXnh9U0r8v"),
    ("Enfance 80", "3:40", 2, 2, 2, "https://audio.jukehost.co.uk/sHVvg00YUK6ulEPEdI32xC2hO8ILDWCL"),
    ("Euphories", "3:29", 2, 2, 2, "https://audio.jukehost.co.uk/amtRaGfPH8uB4mQrIJZWis6aGZMH0cds"),
    ("Mai", "3:35", 2, 2, 2, "https://audio.jukehost.co.uk/57AySJwqQvpGA3ULW9TzQG6N2Y59bVO9"),
    ("Petit monde", "3:28", 2, 2, 2, "https://audio.jukehost.co.uk/knjlc0uY1V0F53Va2Cps1JOkNtwM7jg2"),
    ("Polaroids", "3:07", 2, 2, 2, "https://audio.jukehost.co.uk/WCrxGpObXMiqHMiU8WSMyOvEcBd6bjNH"),
    ("Roi", "3:42", 2, 2, 2, "https://audio.jukehost.co.uk/Po43nYEcNVJmlLt7bHlAI6b7dfCMnY1d"),
    ("SMS", "3:52", 2, 2, 2, "https://audio.jukehost.co.uk/ICYVr0DucwhWFwmbY5XDs28DKGj9jolL"),
    ("Suricate (ODZ)", "3:13", 2, 2, 2, "https://audio.jukehost.co.uk/aSFl3YhXmBCK0Y1ZL4WlHbO7eHn6RGVV"),
    ("Trois Jours", "3:58", 2, 2, 2, "https://audio.jukehost.co.uk/FyCk24ieJDvsdAiyVK6GVdOmTB3Vn2Xa"),
    ("What Are You So Afraid Of", "2:27", 2, 2, 2, "https://audio.jukehost.co.uk/w4a3NOpNDOKpfaEndPhyX5NZoSEejL6g"),
    -- La peste & le choléra
    ("Enfant des rues", "3:50", 3, 3, 15, "https://audio.jukehost.co.uk/cwhiMaE6gQFrg1L2bKxf4Ycy6PmJsucW"),
    ("Envers et contre tous", "3:24", 3, 3, 15, "https://audio.jukehost.co.uk/rh7FQbYwASEKbhjN6xkqEnZhj5d0e5sT"),
    ("Guns", "4:05", 3, 3, 15, "https://audio.jukehost.co.uk/88jCc3XVwkCYdogFqWVMlNHEgavWN8RT"),
    ("Je suis démocratie", "3:49", 3, 3, 15, "https://audio.jukehost.co.uk/CtgXOYfDbTIxDF5uJHgewWSkOUMDlYC6"),
    ("La peste et le choléra", "4:05", 3, 3, 15, "https://audio.jukehost.co.uk/4y4ZVF0mc2s39pgI6ghyKy5Bs8zSabCx"),
    ("Le monde tourne à l'envers", "3:29", 3, 3, 15, "https://audio.jukehost.co.uk/HpOYA4vLYKqQN1nnmntu2z0HgZ5cTvt7"),
    ("Le point de non-retour", "3:55", 3, 3, 15, "https://audio.jukehost.co.uk/XSO3uZxl6yuZ9sARNCBUxxXMRrAeqi4j"),
    ("Mort aux cons", "4:01", 3, 3, 15, "https://audio.jukehost.co.uk/5DLyWsHXQetgWpGCEeYyBaWUfkRCtK0b"),
    ("Pas de futur", "3:32", 3, 3, 15, "https://audio.jukehost.co.uk/8RFDHFbPRSb8mC8I9TV1412Rs1PwT9ro"),
    ("Pertes et fracas", "3:55", 3, 3, 15, "https://audio.jukehost.co.uk/DcP9ZF00BnDhVk9yo0z0UaoRQJAWPdTq"),
    ("Vendredi 13", "4:10", 3, 3, 15, "https://audio.jukehost.co.uk/rbQNDULOd9iiv69JbSP5IOcTPl8rgm0F"),
    -- Inception
    ("528491", "2:23", 4, 4, 6, "https://audio.jukehost.co.uk/KEnMsupOkSS8SAT5DYKCXSaP29M0K9Kd"),
    ("Dream is Collapsing", "2:23", 4, 4, 6, "https://audio.jukehost.co.uk/67G120mY8SBUCA1bi4mOqi1fTypTVOKI"),
    ("Dream Within a Dream", "5:04", 4, 4, 6, "https://audio.jukehost.co.uk/yPcxonkmzksOPQ9PqzKDRoTDpDG5pt9f"),
    ("Half Remembered Dream", "1:11", 4, 4, 6, "https://audio.jukehost.co.uk/gl62bEq6tS7WPNchkWLovDflRhbKpQKq"),
    ("Mombasa", "4:54", 4, 4, 6, "https://audio.jukehost.co.uk/dpl7UBHTM1TXh7eTA6BgypSKvkQFVvL5"),
    ("Old Souls", "7:44", 4, 4, 6, "https://audio.jukehost.co.uk/17FIb3ei2rztLnj2uq45DexGLUGkiQl1"),
    ("One Simple Idea", "2:28", 4, 4, 6, "https://audio.jukehost.co.uk/DKBabTV9C7l2lPeINKaEjuSRLSTVMMLc"),
    ("Paradox", "3:25", 4, 4, 6, "https://audio.jukehost.co.uk/KlEjkWP5m7uZlEtiEJF3dYm34XSR9qqx"),
    ("Radical Notion", "3:42", 4, 4, 6, "https://audio.jukehost.co.uk/l1ieTlcuUEknuLaPakrsu4cJQCIePr72"),
    ("Time", "4:35", 4, 4, 6, "https://audio.jukehost.co.uk/Ej7t6M2dZrALJ4V6qASG5hn9L2Al2ggr"),
    ("Waiting for a Train", "9:50", 4, 4, 6, "https://audio.jukehost.co.uk/FyD0JWeFU1a8BJpN7qufX1mws5mxDE73"),
    ("We Built Our Own World", "1:55", 4, 4, 6, "https://audio.jukehost.co.uk/sWIaSXc1jHtrnKZBuBThQarxuv5vPnnS"),
    -- True
    ("Addicted to You", "2:28", 5, 5, 14, "https://audio.jukehost.co.uk/1k1wMunSTVoilcT7iANkOATjFKYytEYn"),
    ("All You Need Is Love", "6:21", 5, 5, 14, "https://audio.jukehost.co.uk/BeJoa8XkXyxvKzmu5eDKQ2PIK4e53P1l"),
    ("Always On The Run", "4:55", 5, 5, 14, "https://audio.jukehost.co.uk/btF0L8NOxf9fwkkmayOzx8hZUDSeUGCp"),
    ("Canyions", "7:29", 5, 5, 14, "https://audio.jukehost.co.uk/c1CZ44zrkIV36tMoo3BslXQfBv5d3eEB"),
    ("Dear Boy", "7:59", 5, 5, 14, "https://audio.jukehost.co.uk/EBp1Pkw2TlMiksQxqFLFtvdN5NLK4PwV"),
    ("EDOM", "8:15", 5, 5, 14, "https://audio.jukehost.co.uk/djk4VZDicIYLOYIZnZPD4S6IEhWiPrMd"),
    ("Heart Upon My Sleeve", "4:43", 5, 5, 14, "https://audio.jukehost.co.uk/pLmOIXk9KHsTTPo0D7WQ67uMMB8sU7if"),
    ("Hey Brother", "4:15", 5, 5, 14, "https://audio.jukehost.co.uk/f1QElcg00IlJ89xWaVODQ3oMwo6SdX0X"),
    ("Hope There's Someone", "6:21", 5, 5, 14, "https://audio.jukehost.co.uk/mOBuMtgb2H6U8uKPWcRxhrp0xajRhnz9"),
    ("Lay Me Down", "5:00", 5, 5, 14, "https://audio.jukehost.co.uk/V8IArx4BkF5FKlMvisg5ZFFmzfzfbz3h"),
    ("Liar Liar", "3:58", 5, 5, 14, "https://audio.jukehost.co.uk/lKpJOxqTXliKMRSHo5qMgd0iViiRL5l7"),
    ("Long Road To Hell", "3:42", 5, 5, 14, "https://audio.jukehost.co.uk/Y5fx4ecEqj2jqZ9v4mt8EwPAaYGsUauc"),
    ("Shame On Me", "4:13", 5, 5, 14, "https://audio.jukehost.co.uk/sSpTCJgbWI1PolBklU31H6J8ur1PRV8u"),
    ("Wake Me Up", "4:07", 5, 5, 14, "https://audio.jukehost.co.uk/mFhcvlmttkr3uL4RxGBWgo3nIJOwnE9b"),
    ("You Make Me", "3:53", 5, 5, 14, "https://audio.jukehost.co.uk/av0T271NIq4an2Fz3gdiv2WEl3Hydbm0");

INSERT INTO MUSIQUE_NOTE (id_musique, id_utilisateur, note) VALUES
    (64, 1, 4);