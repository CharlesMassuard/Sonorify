<?php
    namespace Data;

    class Provider{
        public $path;

        public function __construct($path){
            $this->path = $path;
        }

        public function getData() {
            $data = file_get_contents($this->path);
            $lines = explode("\n", $data);
            $albums = [];
            $currentAlbum = [];
        
            foreach ($lines as $line) {
                $line = trim($line);
                if (strpos($line, '- by:') === 0) {
                    if (!empty($currentAlbum)) {
                        $albums[] = $currentAlbum;
                    }
                    $currentAlbum = [];
                    list($key, $value) = explode(': ', substr($line, 2), 2);
                    $currentAlbum[trim($key)] = trim($value);
                } else if (!empty($line)) {
                    list($key, $value) = explode(': ', $line, 2);
                    if ($key === 'genre') { #Cas spécial vu que le genre est le seul qui peut être une liste
                        $value = is_array($value) ? $value : explode(', ', trim($value, '[]'));
                    }
                    $currentAlbum[trim($key)] = is_string($value) ? trim($value) : $value;
                }
            }
        
            if (!empty($currentAlbum)) {
                $albums[] = $currentAlbum;
            }
        
            return $albums;                                                                                                                                                                                    
        }
    }
?>