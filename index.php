<?php
// index.php

// require_once 'config/database.php';
require_once 'model/ReportModel.php';
require_once 'controller/ReportController.php';

$config = require 'config/database.php';

$pdo = new PDO("mysql:host={$config['host']};dbname={$config['dbname']}", $config['username'], $config['password']);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$model = new ReportModel($pdo);
$controller = new ReportController($model);

// Retrieve the action from the request body
$action = isset($_POST['action']) ? $_POST['action'] : 'showReportList';

switch ($action) {
    case 'store-report':
        $controller->storeReportDetails();
        break;
    case 'showFormData':
        $controller->showReportList();
        break;
    default:
        $controller->showReportList();
}
