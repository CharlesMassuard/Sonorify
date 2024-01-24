<?php 
    namespace Data;
    class DataBase{
        private $file_db;
        public function __construct(){
            $this->file_db=new \PDO('sqlite:Question.sqlite');
            $this->file_db->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_WARNING);
        }
        public function createTable(){
            $this->file_db->exec("CREATE TABLE IF NOT EXISTS ALBUM ( 
                id_album INTEGER PRIMARY KEY AUTOINCREMENT,
                titre TEXT,
                image TEXT,
                id_artiste INTEGER,
                dateSortie DATE)");
            $this->file_db->exec("CREATE TABLE IF NOT EXISTS ARTISTE ( 
                id_artiste INTEGER PRIMARY KEY AUTOINCREMENT,
                nom TEXT,
                prenom TEXT)");
            $this->file_db->exec("CREATE TABLE IF NOT EXISTS ALBUM_ARTISTE (
                id_album INTEGER,
                id_artiste INTEGER,
                PRIMARY KEY (id_album, id_artiste),
                FOREIGN KEY (id_album) REFERENCES ALBUM(id_album),
                FOREIGN KEY (id_artiste) REFERENCES ARTISTE(id_artiste))");
            $this->file_db->exec("CREATE TABLE IF NOT EXISTS GENRE (
                id_genre INTEGER PRIMARY KEY AUTOINCREMENT,
                nom TEXT)");
            $this->file_db->exec("CREATE TABLE IF NOT EXISTS ALBUM_GENRE (
                id_album INTEGER,
                id_genre INTEGER,
                PRIMARY KEY (id_album, id_genre),
                FOREIGN KEY (id_album) REFERENCES ALBUM(id_album),
                FOREIGN KEY (id_genre) REFERENCES GENRE(id_genre))");
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
    }
?>