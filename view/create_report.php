<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
            <form class="row g-3" id="create_report">
                <div class="col-md-6">
                    <label for="buyer" class="form-label mt-2">Buyer:</label>
                    <input type="text" class="form-control" id="buyer" name="buyer">

                    <label for="email" class="form-label mt-2">Email:</label>
                    <input type="email" class="form-control" id="email" name="email">

                    <label for="phone" class="form-label mt-2">Phone:</label>
                    <input type="text" class="form-control" id="phone" name="phone">

                    <label for="city" class="form-label mt-2">City:</label>
                    <input type="text" class="form-control" id="city" name="city">
                </div>
                <div class="col-md-6">
                    <label for="receipt_id" class="form-label mt-2">Receipt Id:</label>
                    <input type="number" class="form-control" id="receipt_id" name="receipt_id">

                    <label for="amount" class="form-label mt-2">Amount:</label>
                    <input type="number" class="form-control" id="amount" name="amount">

                    <label for="entry_by" class="form-label mt-2">Entry By:</label>
                    <input type="number" class="form-control" id="entry_by" name="entry_by">

                    <label for="note" class="form-label mt-2">Note:</label>
                    <textarea class="form-control" id="note" rows="1"></textarea>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#create_report').submit(function(e) {
                e.preventDefault();

                let data = $(this).serialize();
                console.log(data);

                $.ajax({
                    type: 'POST',
                    url: '/assignment/index.php',
                    data: data + '&action=store-report',
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
</body>

</html>