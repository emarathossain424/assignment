<?php

require_once 'config/database.php';
require_once 'model/FormModel.php';
require_once 'controller/FormController.php';

//Setup database
$pdo = new PDO("mysql:host={$config['host']};dbname={$config['dbname']}", $config['username'], $config['password']);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$model = new OrderModel($pdo);
$controller = new OrderController($model);

// Check if the form is submitted
$controller->storeOrderDetails();

// Display order creation page
include 'view/create_order.php';

// Display order list
$controller->showOrderList();
