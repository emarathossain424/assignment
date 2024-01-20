<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="/assignment/view/report_list.php">Assignment</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/assignment/view/report_list.php">Report List</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="/assignment/view/create_report.php">Create Report</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="d-flex h-100 justify-content-center align-items-center m-3">
        <div class="container">
            <h2 class="text-center mb-4">Create Report</h2>

            <div class="alert alert-danger alert-dismissible fade" role="alert">
                <strong>Success!</strong> Form subnmitted successfully.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>


            <form class="g-3" id="create-report">
                <div class="row">
                    <div class="col-md-4 mx-auto text-center">
                        <button type="button" class="btn btn-primary mb-2" id="add-item">Add Item</button>
                    </div>
                </div>
                <div id="itme-section">
                    <div class="row">
                        <div class="col-md-1">
                            <label for="item" class="form-label mt-2">Item 1:</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control mt-2" id="item-1" name="items[]" onkeyup="validateItem(1)">
                            <label id="item_1_error" class="error" for="item"></label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div>
                            <label for="buyer" class="form-label mt-2">Buyer:</label>
                            <input type="text" class="form-control" id="buyer" name="buyer">
                            <label id="buyer_error" class="error" for="buyer"></label>
                        </div>
                        <div>
                            <label for="email" class="form-label mt-2">Email:</label>
                            <input type="text" class="form-control" id="email" name="email">
                            <label id="email_error" class="error" for="email"></label>
                        </div>
                        <div>
                            <label for="phone" class="form-label mt-2">Phone:</label>
                            <input type="text" class="form-control" id="phone" name="phone">
                            <label id="phone_error" class="error" for="phone"></label>
                        </div>
                        <div>
                            <label for="city" class="form-label mt-2">City:</label>
                            <input type="text" class="form-control" id="city" name="city">
                            <label id="city_error" class="error" for="city"></label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            <label for="receipt_id" class="form-label mt-2">Receipt Id:</label>
                            <input type="text" class="form-control" id="receipt_id" name="receipt_id">
                            <label id="receipt_id_error" class="error" for="receipt_id"></label>
                        </div>
                        <div>
                            <label for="amount" class="form-label mt-2">Amount:</label>
                            <input type="text" class="form-control" id="amount" name="amount">
                            <label id="amount_error" class="error" for="amount"></label>
                        </div>
                        <div>
                            <label for="entry_by" class="form-label mt-2">Entry By:</label>
                            <input type="text" class="form-control" id="entry_by" name="entry_by">
                            <label id="entry_by_error" class="error" for="entry_by"></label>
                        </div>
                        <div>
                            <label for="note" class="form-label mt-2">Note:</label>
                            <textarea class="form-control" id="note" rows="1" name="note"></textarea>
                            <label id="note_error" class="error" for="note"></label>
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary float-end" id="submit_btn" name="Submit">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            console.log(document.cookie)

            let item = 1

            validateItem(item)

            //Adding new item input field 
            $('#add-item').on('click', function() {
                item++
                let item_html = `<div class="row">
                        <div class="col-md-1">
                            <label for="buyer" class="form-label mt-2">Item ` + item + `:</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control mt-2" id="item-` + item + `" name="items[]" onkeyup="validateItem(` + item + `)">
                            <label id="item_` + item + `_error" class="error" for="item"></label>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-primary delete-btn mt-2" onclick=removeItem(` + item + `)>X</button>
                        </div>
                    </div>`
                $('#itme-section').append(item_html)
                validateItem(item)
            })

            // Adding 880 before phone number if user already not gave it 
            $('#phone').on('change', function() {
                if ($('#create-report').validate().element('#phone')) {
                    var phoneNumber = $('#phone').val();
                    if (!phoneNumber.startsWith('880')) {
                        $('#phone').val('880' + phoneNumber);
                    }
                }
            })

            //Adding custom regex rule for validation
            $.validator.addMethod(
                "regex",
                function(value, element, regexp) {
                    return regexp.test(value);
                }
            );

            //Adding custom xssCheck rule for validation
            $.validator.addMethod(
                "xssCheck",
                function(value, element) {
                    let regx = /[<>"'&]/g
                    return !regx.test(value);
                }
            );

            //Adding custom wordCount rule for validation 
            $.validator.addMethod(
                "wordCount",
                function(value, element, count) {
                    let note = value
                    let word_count = note.split(' ').length

                    return word_count <= count
                }
            );

            //Form validation using jquery
            $('#create-report').validate({
                rules: {
                    buyer: {
                        required: true,
                        maxlength: 20,
                        regex: /^[a-zA-Z0-9\s]+$/,
                        xssCheck: true
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    phone: {
                        required: true,
                        number: true
                    },
                    city: {
                        required: true,
                        regex: /^[a-zA-Z\s]+$/,
                        xssCheck: true
                    },
                    receipt_id: {
                        required: true,
                        regex: /^[a-zA-Z]+$/,
                        xssCheck: true
                    },
                    amount: {
                        required: true,
                        number: true
                    },
                    entry_by: {
                        required: true,
                        number: true
                    },
                    note: {
                        required: true,
                        wordCount: 30,
                        xssCheck: true
                    }
                },
                messages: {
                    buyer: {
                        required: "Please enter a valid buyer name.",
                        maxlength: "Please enter no more than 20 characters.",
                        regex: "Please follow these constraints (only text, spaces, and numbers).",
                        xssCheck: "Hey attacker stay away from us !!!!."
                    },
                    email: {
                        required: "Please enter a valid email address.",
                        email: "Invalid email address."
                    },
                    phone: {
                        required: "Please enter a valid phone number.",
                        number: "Please enter only numbers."
                    },
                    city: {
                        required: "Please enter a valid city name.",
                        regex: "Please follow these constraints (only text and spaces).",
                        xssCheck: "Hey attacker stay away from us !!!!."
                    },
                    receipt_id: {
                        required: "Please enter a valid receipt id.",
                        regex: "Please follow these constraints (only text).",
                        xssCheck: "Hey attacker stay away from us !!!!."
                    },
                    amount: {
                        required: "Please enter a valid amount.",
                        number: "Please enter a valid number."
                    },
                    entry_by: {
                        required: "Please enter the entry by name."
                    },
                    note: {
                        required: "Please enter a valid note.",
                        wordCount: "Please enter no more than 30 words.",
                        xssCheck: "Hey attacker stay away from us !!!!."
                    }
                }
            });

            $('#create-report').submit(function(e) {
                e.preventDefault();

                let is_any_item_empty = false

                // Chcking if any item is empty
                $('input[name="items[]"]').each(function() {
                    var value = $(this).val();
                    if (value.trim() === '') {
                        is_any_item_empty = true
                    }
                });

                //Submit form after successful client side validation
                if (!is_any_item_empty) {

                    let all_cookies = document.cookie

                    if (!all_cookies.includes('isFormSubmetted=true')) {
                        let data = $(this).serialize();

                        $.ajax({
                            type: 'POST',
                            url: '/assignment/index.php',
                            data: data + '&action=store-report',
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire({
                                        title: 'Success',
                                        text: 'Data stored in database successfully!',
                                        icon: 'success',
                                        confirmButtonText: 'OK',
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            document.cookie = `isFormSubmetted=true; max-Age=60`
                                            window.location.href = '/assignment/view/report_list.php'; // Replace with your desired URL
                                        }
                                    });
                                } else {
                                    if (response.hasOwnProperty('errors')) {
                                        let errors = response.errors
                                        for (let key in errors) {
                                            $('#' + key + '_error').text(errors[key])
                                            $('#' + key + '_error').css('display', 'block')
                                        }
                                    }
                                }
                            },
                            error: function(error) {
                                console.log(error.responseText);
                            }
                        });
                    } else {
                        Swal.fire({
                            title: 'Warning',
                            text: 'You cannot submit again within 24 hours. Please clear cookies and try again',
                            icon: 'error',
                            confirmButtonText: 'OK',
                        });
                    }
                }
            });
        });

        /**
         * Remove item from the input field
         */
        function removeItem(item) {
            $('#item-' + item).closest('.row').remove()
        }

        /**
         * validate item fields
         */
        function validateItem(item_number) {
            let item_name = $('#item-' + item_number).val()
            let text_only_regx = /^[a-zA-Z]+$/
            let regx_for_xss_prevent = /[<>"'&]/g

            if (text_only_regx.test(item_name) && !regx_for_xss_prevent.test(item_name)) {
                $('#item_' + item_number + '_error').text('')
            } else {
                $('#item_' + item_number + '_error').text('Invalid item name')
                $('#item_' + item_number + '_error').css('display', 'block')
            }
        }
    </script>
</body>

</html>