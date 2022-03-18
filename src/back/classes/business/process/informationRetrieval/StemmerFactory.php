<?php

/**
 * Class StemmerFactory
 * @author wamania
 */
class StemmerFactory
{
    const LANGS = [
        FrenchStemmer::class     => ['fr', 'fre', 'fra', 'french']
    ];

    /**
     * @throws Exception
     */
    public static function create(string $code): Stemmer
    {
        $code = strtolower($code);

        foreach (self::LANGS as $classname => $isoCodes) {
            if (in_array($code, $isoCodes)) {
                return new $classname;
            }
        }

        throw new Exception(sprintf('Stemmer not found for %s', $code));
    }
}