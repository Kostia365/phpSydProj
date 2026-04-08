<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;

require_once __DIR__ . '/bootstrap.php';
$entityManager = require_once __DIR__ . '/bootstrap.php';


return new SingleManagerProvider($entityManager);