<?php

require_once 'models/Config.php';

session_start();

session_destroy();

header('Location: '.Config::getSiteUrl());