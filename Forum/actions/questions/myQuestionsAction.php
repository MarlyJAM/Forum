<?php

require('actions/database.php');

$getAllMyQuestions = $bdd->prepare('SELECT id, title, description FROM questions WHERE id_author = :id_author ORDER BY id DESC');
$getAllMyQuestions->execute(['id_author'=>$_SESSION['id']]);