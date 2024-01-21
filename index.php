<?php

require_once 'model/ReportModel.php';
require_once 'controller/ReportController.php';

$config = require 'config/database.php';
$settings = require 'config/settings.php';

$pdo = new PDO("mysql:host={$config['host']};dbname={$config['dbname']}", $config['username'], $config['password']);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$model = new ReportModel($pdo);
$controller = new ReportController($model, $settings);

$action = isset($_GET['url']) ? $_GET['url'] : 'store-report';

switch ($action) {
    case 'create-report':
        $controller->showFormPage();
        break;
    case 'store-report':
        $controller->storeReportDetails();
        break;
    case 'show-report':
        $controller->showReportList();
        break;
    default:
        header("HTTP/1.0 404 Not Found");
        echo '404 Not Found';
        break;
}
