<?php 
    namespace Data;
    class DataBase{
        private $file_db;
        public function __construct(){
            $this->file_db=new \PDO('sqlite:Data/PHPOSONG.sqlite');
            $this->file_db->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_WARNING);
        }
        public function createTable(){
            $this->file_db->exec("CREATE TABLE IF NOT EXISTS GROUPE ( 
                id_groupe INTEGER PRIMARY KEY AUTOINCREMENT,
                nom_groupe TEXT,
                decription_groupe TEXT)");
            $this->file_db->exec("CREATE TABLE IF NOT EXISTS ALBUM ( 
                id_album INTEGER PRIMARY KEY AUTOINCREMENT,
                titre TEXT,
                image_album TEXT,
                id_artiste INTEGER,
                dateSortie DATE,
                FOREIGN KEY (id_artiste) REFERENCES ARTISTE(id_artiste))");
            $this->file_db->exec("CREATE TABLE IF NOT EXISTS ARTISTE ( 
                id_artiste INTEGER PRIMARY KEY AUTOINCREMENT,
                nom_artiste TEXT,
                image_artiste TEXT,
                prenom_artiste TEXT)");
            $this->file_db->exec("CREATE TABLE IF NOT EXISTS ALBUM_ARTISTE (
                id_album INTEGER,
                id_artiste INTEGER,
                PRIMARY KEY (id_album, id_artiste),
                FOREIGN KEY (id_album) REFERENCES ALBUM(id_album),
                FOREIGN KEY (id_artiste) REFERENCES ARTISTE(id_artiste))");
            $this->file_db->exec("CREATE TABLE IF NOT EXISTS GROUPE_ARTISTE (
                id_groupe INTEGER,
                id_artiste INTEGER,
                PRIMARY KEY (id_groupe, id_artiste),
                FOREIGN KEY (id_groupe) REFERENCES GROUPE(id_groupe),
                FOREIGN KEY (id_artiste) REFERENCES ARTISTE(id_artiste))");
            $this->file_db->exec("CREATE TABLE IF NOT EXISTS GENRE (
                id_genre INTEGER PRIMARY KEY AUTOINCREMENT,
                nom_genre TEXT)");
            $this->file_db->exec("CREATE TABLE IF NOT EXISTS UTILISATEUR ( 
                id_utilisateur INTEGER PRIMARY KEY AUTOINCREMENT,
                login_utilisateur TEXT,
                password_utilisateur TEXT,
                nom_utilisateur TEXT,
                prenom_utilisateur TEXT,
                ddn_utilisateur DATE,
                email_utilisateur TEXT)");
            $this->file_db->exec("CREATE TABLE IF NOT EXISTS ALBUM_NOTE (
                id_album INTEGER,
                id_utilisateur INTEGER,
                note INTEGER,
                PRIMARY KEY (id_album, id_utilisateur),
                FOREIGN KEY (id_album) REFERENCES ALBUM(id_album),
                FOREIGN KEY (id_utilisateur) REFERENCES UTILISATEUR(id_utilisateur))");
            $this->file_db->exec("CREATE TABLE IF NOT EXISTS GENRE_SIMILAIRE (
                id_genre INTEGER,
                id_genre_similaire INTEGER,
                PRIMARY KEY (id_genre, id_genre_similaire),
                FOREIGN KEY (id_genre) REFERENCES GENRE(id_genre),
                FOREIGN KEY (id_genre_similaire) REFERENCES GENRE(id_genre))");
            
            $this->file_db->exec("CREATE TABLE IF NOT EXISTS PLAYLIST (
                id_playlist INTEGER PRIMARY KEY AUTOINCREMENT,
                nom_playlist TEXT,
                description_playlist TEXT,
                public BOOLEAN,
                id_auteur INTEGER,
                FOREIGN KEY (id_auteur) REFERENCES PLAYLIST(id_utilisateur)
                )");
            $this->file_db->exec("CREATE TABLE IF NOT EXISTS MUSIQUE (
                id_musique INTEGER PRIMARY KEY AUTOINCREMENT,
                nom_musique TEXT,
                duree TIME,
                id_groupe INTEGER,
                id_album INTEGER,
                id_genre INTEGER,
                FOREIGN KEY (id_groupe) REFERENCES GROUPE(id_groupe),
                FOREIGN KEY (id_genre) REFERENCES GENRE(id_genre),
                FOREIGN KEY (id_album) REFERENCES ALBUM(id_album)
                )");
            $this->file_db->exec("CREATE TABLE IF NOT EXISTS PLAYLIST_MUSIQUE (
                id_playlist INTEGER,
                id_musique INTEGER,
                PRIMARY KEY (id_playlist, id_musique),
                FOREIGN KEY (id_playlist) REFERENCES PLAYLIST(id_playlist),
                FOREIGN KEY (id_musique) REFERENCES MUSIQUE(id_musique))");
            $this->file_db->exec("CREATE TABLE IF NOT EXISTS PLAYLIST_NOTE (
                id_playlist INTEGER,
                id_utilisateur INTEGER,
                note INTEGER,
                PRIMARY KEY (id_playlist, id_utilisateur),
                FOREIGN KEY (id_playlist) REFERENCES PLAYLIST(id_playlist),
                FOREIGN KEY (id_utilisateur) REFERENCES UTILISATEUR(id_utilisateur))");
            $this->file_db->exec("CREATE TABLE IF NOT EXISTS PLAYLIST_FAVORIS (
                id_playlist INTEGER,
                id_utilisateur INTEGER,
                PRIMARY KEY (id_playlist, id_utilisateur),
                FOREIGN KEY (id_playlist) REFERENCES PLAYLIST(id_playlist),
                FOREIGN KEY (id_utilisateur) REFERENCES UTILISATEUR(id_utilisateur))");
            $this->file_db->exec("CREATE TABLE IF NOT EXISTS GROUPE_FAVORIS (
                id_groupe INTEGER,
                id_utilisateur INTEGER,
                PRIMARY KEY (id_groupe, id_utilisateur),
                FOREIGN KEY (id_groupe) REFERENCES GROUPE(id_groupe),
                FOREIGN KEY (id_utilisateur) REFERENCES UTILISATEUR(id_utilisateur))");
        }
        public function getAlbums(){
            return $this->file_db->query('SELECT * from ALBUM');
        }
        public function getGenres(){
            return $this->file_db->query('SELECT * from GENRE');
        }
        public function getArtistes(){
            return $this->file_db->query('SELECT * from ARTISTE');
        }
        public function getAlbumsArtistes(){
            return $this->file_db->query('SELECT * from ALBUM_ARTISTE');
        }
        public function getAlbumsGenres(){
            return $this->file_db->query('SELECT * from ALBUM_GENRE');
        }
        public function getAlbumsArtistesGenres(){
            return $this->file_db->query('SELECT * from ALBUM_ARTISTE natural join ALBUM_GENRE');
        }
        public function getAlbumsById($id){
            return $this->file_db->query('SELECT * from ALBUM where id_album='.$id);
        }
        public function getArtistesById($id){
            return $this->file_db->query('SELECT * from ARTISTE where id_artiste='.$id);
        }
        public function getGenresById($id){
            return $this->file_db->query('SELECT * from GENRE where id_genre='.$id);
        }
        public function getAlbumsArtistesByIdAlbum($id){
            return $this->file_db->query('SELECT * from ALBUM_ARTISTE where id_album='.$id);
        }
        public function getAlbumsArtistesByIdArtiste($id){
            return $this->file_db->query('SELECT * from ALBUM_ARTISTE where id_artiste='.$id);
        }
        public function insertFavorisPlaylist($id_playlist,$id_utilisateur){
            $insert="INSERT INTO PLAYLIST_FAVORIS (id_playlist, id_utilisateur) VALUES (:id_playlist, :id_utilisateur)";
            $stmt=$this->file_db->prepare($insert);
            $stmt->bindParam(':id_playlist',$id_playlist);
            $stmt->bindParam(':id_utilisateur',$id_utilisateur);
            $stmt->execute();
        }
        public function insertFavoriteGroupe($id_groupe,$id_utilisateur){
            $insert="INSERT INTO GROUPE_FAVORIS (id_groupe, id_utilisateur) VALUES (:id_groupe, :id_utilisateur)";
            $stmt=$this->file_db->prepare($insert);
            $stmt->bindParam(':id_groupe',$id_groupe);
            $stmt->bindParam(':id_utilisateur',$id_utilisateur);
            $stmt->execute();
        }
    }
    $database=new DataBase();
    $database->createTable();
?>