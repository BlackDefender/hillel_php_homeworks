<?php

require_once 'models/Config.php';

session_start();

unset($_SESSION['user']);

header('Location: '.Config::getSiteUrl());