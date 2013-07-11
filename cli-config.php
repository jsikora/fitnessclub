<?php

/**
 * File to execute the doctrine command.
 */

require_once "bootstrap.php";

return \Doctrine\Orm\Tools\Console\ConsoleRunner::createHelperSet($entityManager);

