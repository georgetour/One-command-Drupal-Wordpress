#!/usr/bin/env php
<?php

require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Console\Application;
use Console\Project;

/**
* Author: George Tourtinakis <george@besmartbesimple.com>
*/

$app = new Application('Console App', 'v1.0.0');
$app -> add(new Project());
$app -> run();