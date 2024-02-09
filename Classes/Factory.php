<?php
    //use Form\QuestionType\{Question, Text, Radio, Checkbox};
    use Models\Album;
    class Factory{
        public static function createQuestions(Array $data): Array{
            // $listeAlbums = [];
            // foreach($data as $question){
            //     $className = "Items\\TypeItem\\".ucfirst($question["type"]);
            //     array_push($listeAlbums, new $className($question["name"], $question["choices"], $question["answer"], $question["text"], $question["type"], $question["score"]));
            // }
            // return $listeAlbums;
        }
        public static function createAlbums(Array $data): Array{
            $listeAlbums = [];
            foreach($data as $album){
                array_push($listeAlbums, new Album($album["id_album"], $album["titre"], $album["dateSortie"], $album["image_album"], $album["nom_groupe"]));
            }
            return $listeAlbums;
        }
    }
?>