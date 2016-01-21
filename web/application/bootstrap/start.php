<?php

use Concrete\Core\Application\Application;

/**
 * ----------------------------------------------------------------------------
 * Instantiate concrete5
 * ----------------------------------------------------------------------------
 */
$app = new Application();

/**
 * ----------------------------------------------------------------------------
 * Detect the environment based on the hostname of the server
 * ----------------------------------------------------------------------------
 */
$app->detectEnvironment(
    array(
        'local' => array(
            'local'
        ),
        'stage' => array(
            'stage01.focusfortythree.com'
        ),
        'production' => array(
            'prod01.focusfortythree.com'
        )
    )
);

return $app;
