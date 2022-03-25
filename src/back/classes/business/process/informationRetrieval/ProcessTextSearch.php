<?php

/**
 * Class Searching
 * @author arthur mimouni
 */
class ProcessTextSearch implements ProcessText
{
    private $words;
    private $token;

    public function __construct($words='', $token = ' '){
        $this->words = $words;
        $this->token = $token;
    }

    public function build(){
        $this->tokenize();
        $this->removeStopWords();
        $this->stemmer();
    }

    public function tokenize(){
        $tokenized_words= array();
        $tok_str = strtok($this->words, $this->token);
        while ($tok_str !== false) {
            $tokenized_words[] = $tok_str;
            $tok_str = strtok($this->token);
        }
        $this->words = $tokenized_words;
    }

    public function removeStopWords(){
        $stopwords = StopWords::getData();
        $words_without_stopwords = array();

        foreach($this->words as $word){
            if(false === in_array($word, $stopwords)){
                if (strpos($word, 'l\'') !== false) {
                    $word = str_replace('l\'',"",$word);
                }
                array_push($words_without_stopwords, $word);
            }
        }
        $this->words = $words_without_stopwords;
    }

    public function stemmer(){
        $stemmer = StemmerFactory::create('fr');
        $stem_words = array();
        foreach($this->words as $word){
            array_push($stem_words,$stemmer->stem($word));
        }
        $this->words = $stem_words;
    }

    /**
     * @return mixed
     */
    public function getWords()
    {
        return $this->words;
    }

    /**
     * @param mixed|string $words
     */
    public function setWords($words)
    {
        $this->words = $words;
    }

    /**
     * @return mixed|string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param mixed|string $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }
}