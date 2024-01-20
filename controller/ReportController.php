<?php
class ReportController
{
    private $model;
    private $settings;
    public function __construct(ReportModel $model, $settings)
    {
        $this->model = $model;
        $this->settings = $settings;
    }

    /**
     * Will rediret to report creation page
     */
    public function showFormPage()
    {
        include 'view/create_report.php';
    }

    /**
     * Will store report details
     *
     * @return void
     */
    public function storeReportDetails()
    {
        try {
            header('Content-Type: application/json');
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $requested_data = $_POST;
                $validation_error = $this->validateForm($requested_data);

                if (!empty($validation_error)) {
                    echo json_encode([
                        'success' => false,
                        'errors' => $validation_error,
                        'message' => 'Unable to create report!'
                    ]);
                } else {
                    $data = [
                        'amount' => $_POST['amount'],
                        'buyer' => $_POST['buyer'],
                        'receipt_id' => $_POST['receipt_id'],
                        'items' => implode(',', $_POST['items']),
                        'email' => $_POST['email'],
                        'buyer_ip' => $_SERVER['REMOTE_ADDR'],
                        'note' => $_POST['note'],
                        'city' => $_POST['city'],
                        'phone' => $_POST['phone'],
                        'hash_key' => $this->prepareHashKey($_POST['receipt_id']),
                        'entry_at' => $this->getEntryDate(),
                        'entry_by' => $_POST['entry_by'],
                    ];

                    // echo json_encode($data);

                    $result = $this->model->storeData($data);

                    if ($result) {
                        echo json_encode(['success' => true, 'message' => 'Report created successfully!']);
                    } else {
                        echo json_encode(['success' => false, 'message' => 'Unable to store report']);
                    }
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Get method is not allowed']);
            }
        } catch (PDOException $e) {
            // Handle PDOException
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            // You might log the exception, redirect the user, or perform other error handling tasks.
        } catch (Exception $ex) {
            echo json_encode(['success' => false, 'message' => $ex->getMessage()]);
        }
    }

    /**
     * Showing report list In Table
     *
     * @return void
     */
    public function showReportList()
    {
        $entry_at = isset($_GET['entry_at']) ? $_GET['entry_at'] : '';
        $entry_by = isset($_GET['entry_by']) ? $_GET['entry_by'] : '';

        $current_page_number = isset($_GET['page']) ? $_GET['page'] : 1; // Get the current page from the URL, default to 1
        $per_page = isset($_GET['per_page']) ? $_GET['per_page'] : 5; // Replace with your desired number of reports per page
        
        $reports = $this->model->getAllData($entry_at,$entry_by,$per_page,$current_page_number);
        $total_report = $this->model->totalReport();
        $total_pages = ceil($total_report / $per_page);

        $all_entry_by = $this->model->getAllEntryById();
        
        include 'view/report_list.php';
    }


    // Function to check if a string contains XSS code
    public function xssCheck($input)
    {
        $pattern = '/[<>"\'&]/';
        return !preg_match($pattern, $input);
    }

    // Function to validate a string against a regex pattern
    public function validateRegex($input, $pattern)
    {
        return preg_match($pattern, $input);
    }

    // Function to validate the form data
    public function validateForm($data)
    {
        $errors = array();

        $validationRules = [
            'buyer' => ['required' => true, 'maxlength' => 20, 'regex' => '/^[a-zA-Z0-9\s]+$/', 'xssCheck' => true],
            'email' => ['required' => true, 'email' => true],
            'phone' => ['required' => true, 'number' => true],
            'city' => ['required' => true, 'regex' => '/^[a-zA-Z\s]+$/', 'xssCheck' => true],
            'receipt_id' => ['required' => true, 'regex' => '/^[a-zA-Z]+$/', 'xssCheck' => true],
            'amount' => ['required' => true, 'number' => true],
            'entry_by' => ['required' => true, 'number' => true],
            'note' => ['required' => true, 'wordCount' => 30, 'xssCheck' => true],
            'items' => ['required' => true, 'regex' => '/^[a-zA-Z]+$/', 'xssCheck' => true]
        ];

        foreach ($validationRules as $field => $rules) {
            foreach ($rules as $rule => $value) {
                if ($rule == 'required') {
                    if ($field != 'items') {
                        if ($value && empty($data[$field])) {
                            $errors[$field] = implode(' ', explode('_', $field)) . ' is required.';
                            break;
                        }
                    } else {
                        $itemes = $data['items'];
                        for ($i = 0; $i < sizeof($itemes); $i++) {
                            if ($value && empty($itemes[$i])) {
                                $errors['item-' . ($i + 1)] = 'Item name is required';
                                break;
                            }
                        }
                    }
                }
                if ($rule == 'maxlength') {
                    if (strlen($data[$field]) > $value) {
                        $errors[$field] = implode(' ', explode('_', $field)) . ' must be at most ' . $value . ' characters long.';
                        break;
                    }
                }
                if ($rule == 'regex') {
                    if ($field != 'items') {
                        if (!$this->validateRegex($data[$field], $value)) {
                            $errors[$field] = 'Invalid ' . implode(' ', explode('_', $field)) . ' format.';
                            break;
                        }
                    } else {
                        $itemes = $data['items'];
                        for ($i = 0; $i < sizeof($itemes); $i++) {
                            if (!$this->validateRegex($itemes[$i], $value)) {
                                $errors['item_' . ($i + 1)] = 'Invalid item name';
                                break;
                            }
                        }
                    }
                }
                if ($rule == 'xssCheck') {
                    if ($field != 'items') {
                        if (!$this->xssCheck($data[$field])) {
                            $errors[$field] = 'Hey Attacker stay away from us';
                            break;
                        }
                    } else {
                        $itemes = $data['items'];
                        for ($i = 0; $i < sizeof($itemes); $i++) {
                            if (!$this->xssCheck($itemes[$i])) {
                                $errors['item_' . ($i + 1)] = 'Hey Attacker stay away from us';
                                break;
                            }
                        }
                    }
                }
                if ($rule == 'email') {
                    if (!filter_var($data[$field], FILTER_VALIDATE_EMAIL)) {
                        $errors[$field] = 'Invalid email address.';
                        break;
                    }
                }
                if ($rule == 'number') {
                    if (!is_numeric($data[$field])) {
                        $errors[$field] = implode(' ', explode('_', $field)) . ' must be a number.';
                        break;
                    }
                }
                if ($rule == 'wordCount') {
                    if (str_word_count($data[$field]) > $value) {
                        $errors[$field] = implode(' ', explode('_', $field)) . ' must have at most ' . $value . ' words.';
                        break;
                    }
                }
            }
        }

        return $errors;
    }

    /**
     * Will prepar hash key using receipt id and current timestamp as a salt 
     */
    public function prepareHashKey($receipt_id)
    {
        // I am using timestamp as a unique salt, you can use anything, for example, Arraytics
        $current_timestamp = time();
        $salt = strval($current_timestamp);

        $data_to_hash = $receipt_id . $salt;

        // Generate a hash using SHA-512 and encode with base64
        $hash_key = base64_encode(hash('sha512', $data_to_hash, true));

        // Limit the hash key to 255 characters
        $hash_key = substr($hash_key, 0, 255);

        return $hash_key;
    }

    /**
     *  Will return entry date by already set up timezone 
     */
    public function getEntryDate()
    {
        $timezone = new DateTimeZone($this->settings['timezone']); // Replace 'America/New_York' with your desired timezone
        $date = new DateTime('now', $timezone);
        $formattedDate = $date->format('Y-m-d');
        return $formattedDate;
    }
}
