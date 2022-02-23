<?php
  //header('Location: ./src/front/www/index.php');
  //exit();
require('src/back/classes/test/TestSuggestion.php');

$test_suggestion = new TestSuggestion();
$test_suggestion->testRecommendation();

?>