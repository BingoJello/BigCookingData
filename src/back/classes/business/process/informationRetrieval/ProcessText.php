<?php


interface ProcessText
{
    function build();
    function tokenize();
    function removeStopWords();
    function stemmer();
    function getWords();

}