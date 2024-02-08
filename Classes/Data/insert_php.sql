INSERT INTO GROUPE (id_groupe, nom_groupe, image_groupe, description_groupe) VALUES
    (1, "Alabama Shakes", "Alabama_Shakes.jpg", "Alabama Shakes est un groupe de rock américain, originaire d'Athens, en Alabama. Il est formé en 2009 et composé de Brittany Howard, Zac Cockrell, Heath Fogg et Steve Johnson."),
    (2, "Ryan Adams", "Ryan_Adams_2014.jpg", "Ryan Adams, né David Ryan Adams le 5 novembre 1974 à Jacksonville, en Caroline du Nord, est un auteur-compositeur-interprète, musicien, producteur, poète et peintre américain."),
    (3, "Taylor Swift", "Taylor_Swift_2019_by_Glenn_Francis.jpg", "Taylor Alison Swift, née le 13 décembre 1989 à Reading, en Pennsylvanie, est une auteure-compositrice-interprète et actrice américaine."),
    (4, "The Strokes", "The_Strokes_2019.jpg", "The Strokes est un groupe de rock américain, originaire de New York. Formé en 1998, il est composé de Julian Casablancas, Nick Valensi, Albert Hammond Jr., Nikolai Fraiture et Fabrizio Moretti."),
    (5, "The White Stripes", "The_White_Stripes.jpg", "The White Stripes est un groupe de rock américain, originaire de Détroit, dans le Michigan. Il est formé en 1997 par le guitariste et chanteur Jack White et la batteuse Meg White."),
    (6, "16 Horsepower", "16_Horsepower.jpg", "16 Horsepower est un groupe de rock alternatif américain, originaire de Denver, dans le Colorado. Il est formé en 1992 par David Eugene Edwards, Jean-Yves Tola et Keven Soll."),
    (7, "A Perfect Circle", "A_Perfect_Circle_2018.jpg", "A Perfect Circle est un groupe de rock alternatif américain, originaire de Los Angeles, en Californie. Il est formé en 1999 par le guitariste Billy Howerdel et le chanteur Maynard James Keenan."),
    (8, "AC/DC", "ACDC.jpg", "AC/DC est un groupe de hard rock australo-britannique, originaire de Sydney. Il est formé en 1973 par les frères Angus et Malcolm Young."),
    (9, "Aerosmith", "Aerosmith_2019.jpg", "Aerosmith est un groupe de hard rock américain, originaire de Boston, dans le Massachusetts. Il est formé en 1970 par Steven Tyler, Joe Perry, Tom Hamilton, Joey Kramer et Ray Tabano."),
    (10, "Alice in Chains", "Alice_in_Chains_2013.jpg", "Alice in Chains est un groupe de rock américain, originaire de Seattle, dans l'État de Washington. Il est formé en 1987 par le chanteur Layne Staley et le guitariste Jerry Cantrell."),
    (11, "The Beatles", "The_Beatles_in_America.jpg", "The Beatles est un groupe de rock britannique, originaire de Liverpool, en Angleterre. Il est formé en 1960 et composé de John Lennon, Paul McCartney, George Harrison et Ringo Starr."),
    (12, "The Rolling Stones", "The_Rolling_Stones_2016.jpg", "The Rolling Stones est un groupe de rock britannique, originaire de Londres, en Angleterre. Il est formé en 1962 par le guitariste et leader original Brian Jones, le pianiste Ian Stewart, le chanteur Mick Jagger et le guitariste Keith Richards."),
    (13, "Joan Benz", "Joan_Baez.jpg", "Joan Baez, née le 9 janvier 1941 à Staten Island, New York, est une auteure-compositrice-interprète, musicienne et militante américaine."),
    (14, "Bob Dylan", "Bob_Dylan_-_Azkena_Rock_Festival_2010_2.jpg", "Bob Dylan, né Robert Allen Zimmerman le 24 mai 1941 à Duluth, dans le Minnesota, est un auteur-compositeur-interprète, musicien, peintre et poète américain."),
    (15, "Neil Young", "Neil_Young_2012.jpg", "Neil Young, né le 12 novembre 1945 à Toronto, en Ontario, est un auteur-compositeur-interprète et musicien canadien."),
    (16, "The Doors", "The_Doors_1967.jpg", "The Doors est un groupe de rock américain, originaire de Los Angeles, en Californie. Il est formé en 1965 par Jim Morrison, Ray Manzarek, Robby Krieger et John Densmore."),
    (17, "The Velvet Underground", "The_Velvet_Underground.jpg", "The Velvet Underground est un groupe de rock américain, originaire de New York. Il est formé en 1964 par Lou Reed, Sterling Morrison, John Cale et Angus MacLise."),
    (18, "The Who", "The_Who_1975.jpg", "The Who est un groupe de rock britannique, originaire de Londres, en Angleterre. Il est formé en 1964 par Roger Daltrey, Pete Townshend, John Entwistle et Keith Moon."),
    (19, "The Yardbirds", "The_Yardbirds_1966.jpg", "The Yardbirds est un groupe de rock britannique, originaire de Londres, en Angleterre. Il est formé en 1963 par Keith Relf, Paul Samwell-Smith, Chris Dreja, Jim McCarty et Anthony Topham."),
    (20, "The Kinks", "The_Kinks_1965.jpg", "The Kinks est un groupe de rock britannique, originaire de Londres, en Angleterre. Il est formé en 1964 par Ray Davies, Dave Davies, Pete Quaife et Mick Avory.");

INSERT INTO ALBUM (id_album, titre, image_album, id_groupe, dateSortie) VALUES
    (1, "Sound & Color", "220px-Alabama_Shakes_Album_Cover.jpg", 1, "17/04/2017"),
    (2, "Dark Chords on a Big Guitar", "220px-DarkChords.jpg", 13, "27/09/2003"),
    (3, "Folklore", "220px-Folklore_hp.jpg", 3, "18/05/2010"),
    (4, "Love Is Hell", "220px-Love_Is_Hell.jpg", 2, "15/04/2003"),
    (5, "Orion", "220px-Ryan-adams-orion.jpg", 2, "18/05/2010");

INSERT INTO ARTISTE (pseudo_artiste, image_artiste) VALUES
    ("Brittany Howard", "Brittany_Howard.jpg"),
    ("Zac Cockrell", "Zac_Cockrell.jpg"),
    ("Heath Fogg", "Heath_Fogg.jpg"),
    ("Steve Johnson", "Steve_Johnson.jpg"),
    ("Ryan Adams", "Ryan_Adams_2014.jpg"),
    ("Taylor Swift", "Taylor_Swift_2019_by_Glenn_Francis.jpg"),
    ("Julian Casablancas", "Julian_Casablancas.jpg"),
    ("Nick Valensi", "Nick_Valensi.jpg"),
    ("Albert Hammond Jr.", "Albert_Hammond_Jr.jpg"),
    ("Nikolai Fraiture", "Nikolai_Fraiture.jpg"),
    ("Fabrizio Moretti", "Fabrizio_Moretti.jpg"),
    ("Jack White", "Jack_White_2012.jpg"),
    ("Meg White", "Meg_White.jpg"),
    ("David Eugene Edwards", "David_Eugene_Edwards.jpg"),
    ("Jean-Yves Tola", "Jean-Yves_Tola.jpg"),
    ("Keven Soll", "Keven_Soll.jpg"),
    ("Billy Howerdel", "Billy_Howerdel.jpg"),
    ("Maynard James Keenan", "Maynard_James_Keenan.jpg"),
    ("Angus Young", "Angus_Young.jpg"),
    ("Malcolm Young", "Malcolm_Young.jpg"),
    ("Steven Tyler", "Steven_Tyler.jpg"),
    ("Joe Perry", "Joe_Perry.jpg"),
    ("Tom Hamilton", "Tom_Hamilton.jpg"),
    ("Joey Kramer", "Joey_Kramer.jpg"),
    ("Ray Tabano", "Ray_Tabano.jpg"),
    ("Layne Staley", "Layne_Staley.jpg"),
    ("Jerry Cantrell", "Jerry_Cantrell.jpg"),
    ("John Lennon", "John_Lennon_1969.jpg"),
    ("Paul McCartney", "Paul_McCartney_1964.jpg");

INSERT INTO GROUPE_ARTISTE (id_groupe, id_artiste) VALUES
    ("1", "1"),
    ("1", "2"),
    ("1", "3"),
    ("1", "4"),
    ("2", "5"),
    ("3", "6"),
    ("4", "7"),
    ("4", "8"),
    ("4", "9"),
    ("4", "10"),
    ("4", "11"),
    ("5", "12"),
    ("5", "13"),
    ("6", "14"),
    ("6", "15"),
    ("6", "16"),
    ("7", "17"),
    ("7", "18"),
    ("8", "19"),
    ("8", "20"),
    ("9", "21"),
    ("9", "22"),
    ("9", "23"),
    ("9", "24"),
    ("9", "25"),
    ("10", "26"),
    ("10", "27"),
    ("11", "28"),
    ("11", "29"),
    ("12", "30"),
    ("12", "31"),
    ("13", "32"),
    ("13", "33"),
    ("14", "34"),
    ("14", "35"),
    ("15", "36"),
    ("15", "37"),
    ("16", "38"),
    ("16", "39"),
    ("17", "40"),
    ("17", "41"),
    ("18", "42"),
    ("18", "43"),
    ("19", "44"),
    ("19", "45"),
    ("20", "46"),
    ("20", "47");

INSERT INTO GENRE (nom_genre, image_genre) VALUES
    ("Rock", "genres/rock.png"),
    ("Pop",  "genres/pop.png"),
    ("Rap", "genres/rap.png"),
    ("Classique", "genres/classique.png"),
    ("Jazz", "genres/jazz.png"),
    ("Metal", "genres/metal.png"),
    ("Electro", "genres/electro.png"),
    ("Reggae", "genres/reggae.png"),
    ("Funk", "genres/funk.png"),
    ("Soul", "genres/soul.png"),
    ("Country", "genres/country.png"),
    ("Blues", "genres/blues.png"),
    ("Disco", "genres/disco.png"),
    ("Folk", "genres/folk.png"),
    ("Hip-Hop", "genres/hip-hop.png"),
    ("Punk", "genres/punk.png"),
    ("RnB", "genres/rnb.png"),
    ("Bandes originales", "genres/bandes_originales.png");

INSERT INTO ROLE (nom_role) VALUES
    ("Utilisateur"),
    ("Administrateur");

INSERT INTO UTILISATEUR (id_utilisateur, login_utilisateur, password_utilisateur, nom_utilisateur, prenom_utilisateur, ddn_utilisateur, email_utilisateur, image_utilisateur, id_role) VALUES
    (1, "admin", "8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918", "admin", "admin", "1990-01-01", "administrateur@phposong.com", NULL, 2),
    (2, "Pixa253lulu", "2e44118c06a1d5de31e551f83549ba3d9a421accf98673239ee02e4d56bc4bb1", "Ludmann", "Dorian", "dorianludm7@gmail.com", "2005-19-12", NULL, 1),
    (3, "LutinTag", "52c8658d23223219f1e8e610bcf6896963a694e7cf63cf26eddeb4aef4057868", "Massuard", "Charles", "lutintagpro@youtube.com", "2004-14-06", NULL, 1);

INSERT INTO ALBUM_NOTE (id_album, id_utilisateur, note) VALUES 
    (1, 2, 3),
    (1, 3, 4),
    (2, 2, 5),
    (2, 3, 5),
    (3, 2, 4),
    (3, 3, 2),
    (4, 2, 1),
    (4, 3, 2),
    (5, 2, 3),
    (5, 3, 5);

INSERT INTO GENRE_SIMILAIRE (id_genre, id_genre_similaire) VALUES 
    (1, 2), -- Rock is similar to Pop
    (1, 6), -- Rock is similar to Metal
    (2, 1), -- Pop is similar to Rock
    (2, 15), -- Pop is similar to Hip-Hop
    (3, 15), -- Rap is similar to Hip-Hop
    (3, 17), -- Rap is similar to RnB
    (4, 5), -- Classique is similar to Jazz
    (5, 4), -- Jazz is similar to Classique
    (6, 1), -- Metal is similar to Rock
    (7, 18), -- Electro is similar to Techno
    (8, 10), -- Reggae is similar to Soul
    (9, 10), -- Funk is similar to Soul
    (10, 9), -- Soul is similar to Funk
    (11, 14), -- Country is similar to Folk
    (12, 13), -- Blues is similar to Disco
    (13, 12), -- Disco is similar to Blues
    (14, 11), -- Folk is similar to Country
    (15, 3), -- Hip-Hop is similar to Rap
    (16, 1), -- Punk is similar to Rock
    (17, 3), -- RnB is similar to Rap
    (18, 7), -- Techno is similar to Electro
    (19, 2), -- Variété is similar to Pop
    (20, 14); -- World is similar to Folk

INSERT INTO PLAYLIST (nom_playlist, description_playlist, public, id_auteur) VALUES 
    ("Dorian Playlist1", "This is Dorian's first playlist", true, 2),
    ("Dorian Playlist2", "This is Dorian's second playlist", false, 2),
    ("Charles Playlist1", "This is Charles's first playlist", true, 2),
    ("Charles Playlist2", "This is Charles's second playlist", false, 3);

INSERT INTO MUSIQUE (nom_musique, duree, id_groupe, id_album, id_genre) VALUES
    ("Hold On", "3:46", 1, 1, 1),
    ("Gimme All Your Love", "4:03", 1, 1, 1),
    ("Sound & Color", "3:03", 1, 1, 1),
    ("Don't Wanna Fight", "3:52", 1, 1, 1),
    ("Heartbreaker", "4:01", 2, 2, 2),
    ("New York, New York", "3:47", 2, 2, 2),
    ("Come Pick Me Up", "5:19", 2, 2, 2),
    ("Wrecking Ball", "3:48", 3, 3, 3),
    ("Exile", "4:58", 3, 3, 3),
    ("My Tears Ricochet", "4:15", 3, 3, 3),
    ("Hard to Love", "3:09", 4, 4, 4),
    ("Wish You Were Here", "3:24", 4, 4, 4),
    ("Wonderwall", "4:18", 4, 4, 4),
    ("Call It What You Want", "3:23", 5, 5, 5),
    ("Cruel Summer", "2:58", 5, 5, 5),
    ("August", "4:22", 5, 5, 5);

INSERT INTO PLAYLIST_MUSIQUE (id_playlist, id_musique)
SELECT 1, id_musique
FROM MUSIQUE;

INSERT INTO PLAYLIST_MUSIQUE (id_playlist, id_musique) VALUES
    (2, 5), -- Dorian Playlist2: Heartbreaker
    (2, 6), -- Dorian Playlist2: New York, New York
    (2, 7), -- Dorian Playlist2: Come Pick Me Up
    (3, 8), -- Charles Playlist1: Wrecking Ball
    (3, 9), -- Charles Playlist1: Exile
    (3, 10), -- Charles Playlist1: My Tears Ricochet
    (4, 11), -- Charles Playlist2: Hard to Love
    (4, 12), -- Charles Playlist2: Wish You Were Here
    (4, 13), -- Charles Playlist2: Wonderwall
    (4, 14), -- Charles Playlist2: Call It What You Want
    (4, 15), -- Charles Playlist2: Cruel Summer
    (4, 16); -- Charles Playlist2: August

INSERT INTO PLAYLIST_NOTE (id_playlist, id_utilisateur, note) VALUES
    (1, 2, 8), -- User 2 rates Dorian Playlist1 with a score of 8
    (1, 3, 7), -- User 3 rates Dorian Playlist1 with a score of 7
    (2, 2, 9), -- User 2 rates Dorian Playlist2 with a score of 9
    (2, 3, 8), -- User 3 rates Dorian Playlist2 with a score of 8
    (3, 2, 7), -- User 2 rates Charles Playlist1 with a score of 7
    (3, 3, 8), -- User 3 rates Charles Playlist1 with a score of 8
    (4, 2, 8), -- User 2 rates Charles Playlist2 with a score of 8
    (4, 3, 7); -- User 3 rates Charles Playlist2 with a score of 7

INSERT INTO PLAYLIST_FAVORIS (id_playlist, id_utilisateur) VALUES
    (1, 2), -- Dorian Playlist1 is a favorite of User 2
    (1, 3), -- Dorian Playlist1 is a favorite of User 3
    (2, 2), -- Dorian Playlist2 is a favorite of User 2
    (3, 3), -- Charles Playlist1 is a favorite of User 3
    (4, 2); -- Charles Playlist2 is a favorite of User 2

INSERT INTO GROUPE_FAVORIS (id_groupe, id_utilisateur) VALUES
    (1, 2), -- Alabama Shakes is a favorite of User 2
    (1, 3), -- Alabama Shakes is a favorite of User 3
    (2, 2), -- Ryan Adams is a favorite of User 2
    (3, 3), -- Taylor Swift is a favorite of User 3
    (4, 2), -- The Strokes is a favorite of User 2
    (5, 3); -- The White Stripes is a favorite of User 3
