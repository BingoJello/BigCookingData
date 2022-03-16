<?php


class Searching
{
    private $keyword;

    public function __construct($words){
        $this->keyword = $this->removeStopWords($this->tokenize($words));
    }

    public function tokenize($words){
        $tokenized_words= array();
        $tok_str = strtok($words, ' ');
        while ($tok_str !== false) {
            $tokenized_words[] = $tok_str;
            $tok_str = strtok(' ');
        }
        return $tokenized_words;
    }
    public function removeStopWords($words){
        $stopwords = StopWords::getData();
        $words_without_stopwords = array();

        foreach($words as $word){
            if(false == in_array($word, $stopwords)){
                array_push($words_without_stopwords, $word);
            }
        }
        return $words_without_stopwords;
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