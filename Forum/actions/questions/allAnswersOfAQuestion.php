<?php

require('actions/database.php');

$getAllAnswersOfAQuestion = $bdd-> prepare('SELECT id_author,pseudo_author,id_question,content FROM answers WHERE id_question= :id_question ORDER BY id DESC   ');


$getAllAnswersOfAQuestion->execute(['id_question' => $idOfTheQuestion  ]);