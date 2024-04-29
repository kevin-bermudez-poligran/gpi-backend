<?php
    $dotenv = Dotenv\Dotenv::createImmutable([dirname(dirname(dirname(__FILE__))),dirname(dirname(dirname(dirname(dirname(__FILE__)))))]);
    $dotenv->load();