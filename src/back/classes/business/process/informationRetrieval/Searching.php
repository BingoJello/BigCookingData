<?php

/**
 * Class Searching
 * @author arthur mimouni
 */
class Searching
{
    private $keyword;

    public function __construct(){

    }
    public function build($words, $token = ' '){
        $this->keyword = $this->removeStopWords($this->tokenize($words, $token));
        $this->keyword = $this->stemmer($this->keyword);
    }

    private function tokenize($words, $token = ' '){
        $tokenized_words= array();
        $tok_str = strtok($words, $token);
        while ($tok_str !== false) {
            $tokenized_words[] = $tok_str;
            $tok_str = strtok($token);
        }
        return $tokenized_words;
    }

    private function removeStopWords($words){
        $stopwords = StopWords::getData();
        $words_without_stopwords = array();

        foreach($words as $word){
            if(false === in_array($word, $stopwords)){
                if (strpos($word, 'l\'') !== false) {
                    $word = str_replace('l\'',"",$word);
                }
                array_push($words_without_stopwords, $word);
            }
        }
        return $words_without_stopwords;
    }

    private function stemmer($words){
        $stemmer = StemmerFactory::create('fr');
        $keywords = array();
        foreach($words as $word){
            array_push($keywords,$stemmer->stem($word));
        }
        return $keywords;
    }

    /**
     * @return mixed
     */
    public function getKeyword()
    {
        return $this->keyword;
    }

    /**
     * @param mixed $keyword
     */
    public function setKeyword($keyword): void
    {
        $this->keyword = $keyword;
    }
}