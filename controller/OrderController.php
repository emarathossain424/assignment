<?php

use OrderModel;
// controller/FormController.php

class OrderController
{
    private $model;

    public function __construct(OrderModel $model)
    {
        $this->model = $model;
    }


    /**
     * Will store order details
     *
     * @return void
     */
    public function storeOrderDetails()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
            ];

            $result = $this->model->storeData($data);

            if ($result) {
                header("Location: index.php");
                exit;
            } else {
                echo "Error saving form data";
            }
        }
    }

    /**
     * Showing Order list In Table
     *
     * @return void
     */
    public function showOrderList()
    {
        $orders = $this->model->getAllData();
        include 'view/order_list.php';
    }
}
