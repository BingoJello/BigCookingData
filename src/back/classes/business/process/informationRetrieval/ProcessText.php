<?php

/**
 * Interface ProcessText
 * @author arthur mimouni
 */
interface ProcessText
{
    function build();
    function tokenize();
    function removeStopWords();
    function stemmer();
    function getWords();

}