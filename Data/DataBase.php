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
    }
?>