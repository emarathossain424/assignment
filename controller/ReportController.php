<?php
class ReportController
{
    private $model;

    public function __construct(ReportModel $model)
    {
        $this->model = $model;
    }


    /**
     * Will store report details
     *
     * @return void
     */
    public function storeReportDetails()
    {
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
            ];

            $result = $this->model->storeData($data);

            if ($result) {
                echo json_encode(['success' => true, 'message' => 'Report created successfully!']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Unable to store report']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Get method is not allowed']);
        }
    }

    /**
     * Showing report list In Table
     *
     * @return void
     */
    public function showReportList()
    {
        $reports = $this->model->getAllData();
        include 'view/report_list.php';
    }
}
