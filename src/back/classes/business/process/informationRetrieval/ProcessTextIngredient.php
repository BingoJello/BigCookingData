<?php

/**
 * Class ProcessTextIngredient
 * @brief Prétraitement du texte des différents ingrédients
 * @author arthur mimouni
 */
class ProcessTextIngredient implements ProcessText
{
    /**
     * @var mixed|string
     */
    private $words;
    /**
     * @var mixed|string
     */
    private $token;

    /**
     * ProcessTextIngredient constructor.
     * @param string $words
     * @param string $token
     */
    public function __construct($words='', $token = ' '){
        $this->words = $words;
        $this->token = $token;
    }

    function build()
    {
        $this->tokenize();
        $this->removeStopWords();
        $this->stemmer();
    }

    function tokenize()
    {
        $tokenized_words= array();
        $list_words = array();
        $tok_str = strtok($this->words, $this->token);

        while ($tok_str !== false) {
            $tokenized_words[] = $tok_str;
            $tok_str = strtok($this->token);
        }
        $words_split = $tokenized_words;

        foreach($words_split as $word){
            $tokenized_words = array();
            $tok_str = strtok($word, ' ');
            while ($tok_str !== false) {
                $tokenized_words[] = $tok_str;
                $tok_str = strtok(' ');
            }
            array_push($list_words, $tokenized_words);
        }
        $this->words = $list_words;
    }

    function removeStopWords()
    {
        $stopwords = StopWords::getData();
        $list_words = array();

        foreach($this->words as $word){
            $words_without_stopwords = array();
            foreach($word as $part_word) {
                if (false === in_array($part_word, $stopwords)) {
                    if (strpos($part_word, 'l\'') !== false) {
                        $part_word = str_replace('l\'', "", $part_word);
                    }
                    array_push($words_without_stopwords, $part_word);
                }
            }
            array_push($list_words, $words_without_stopwords);
        }
        $this->words = $list_words;
    }

    function stemmer()
    {
        $stemmer = StemmerFactory::create('fr');
        $list_words = array();

        foreach($this->words as $word){
            $stem_words = array();
            foreach($word as $part_word){
                array_push($stem_words,$stemmer->stem($part_word));
            }
            array_push($list_words, $stem_words);
        }
        $this->words = $list_words;
    }

    /**
     * @return string
     */
    public function getWordsString()
    {
        $words_string = "";
        $index_words = 0;

        foreach($this->words as $word){
            $index_part_words = 0;
            foreach($word as $part_word){
                if($index_part_words == (count($word) - 1)){
                    $words_string.=$part_word;
                }else{
                    $words_string.=$part_word.";";
                }
                $index_part_words++;
            }
            if($index_words != (count($this->words) - 1)) {
                $words_string .= ";;";
            }
            $index_words++;
        }
        return $words_string;
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