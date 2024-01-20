<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
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
                            <a class="nav-link active" aria-current="page" href="/assignment/view/report_list.php">Report List</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/assignment/view/create_report.php">Create Report</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="d-flex h-100 justify-content-center align-items-center m-3">
        <div class="container">
            <h2 class="text-center mb-4">All Reports</h2>

            <div class="row mb-4">
                <div class="col-md-2">
                    <select id="per-page" class="form-select mt-2">
                        <option value="5" <?php echo $per_page == 5 ? 'selected' : '' ?>>5</option>
                        <option value="10" <?php echo $per_page == 10 ? 'selected' : '' ?>>10</option>
                        <option value="25" <?php echo $per_page == 25 ? 'selected' : '' ?>>25</option>
                        <option value="50" <?php echo $per_page == 50 ? 'selected' : '' ?>>50</option>
                        <option value="100" <?php echo $per_page == 100 ? 'selected' : '' ?>>100</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="text" id="daterange" value="<?php echo $entry_at ?>" class="form-control mt-2" placeholder="Entry Date">
                </div>
                <div class="col-md-2">
                    <select id="entryBy" class="form-select mt-2">
                        <option value="" <?php echo $entry_by == '' ? 'selected' : '' ?>>All</option>
                        <?php foreach ($all_entry_by as $key => $data) { ?>
                            <option value="<?php echo $data['entry_by'] ?>" <?php echo $entry_by == $data['entry_by'] ? 'selected' : '' ?>><?php echo $data['entry_by'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-primary mt-2" id="filterBtn" onclick="filterAndPaginateList('<?php echo $current_page_number; ?>')">Filter</button>
                    <button class="btn btn-danger mt-2" id="filterBtn" onclick="clearFilter()">Clear Filter</button>
                </div>
            </div>
            <div class="table-responsive">
                <?php if (sizeof($reports) > 0) { ?>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Receiprt Id</th>
                                <th scope="col">Buyer</th>
                                <th scope="col">Buyer Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">City</th>
                                <th scope="col">Buyer Ip</th>
                                <th scope="col">Items</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Note</th>
                                <th scope="col">Entry At</th>
                                <th scope="col">Entry By</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reports as $key => $data) { ?>
                                <tr>
                                    <td><?php echo $key + 1; ?></td>
                                    <td><?php echo $data['receipt_id']; ?></td>
                                    <td><?php echo $data['buyer']; ?></td>
                                    <td><?php echo $data['buyer_email']; ?></td>
                                    <td><?php echo $data['phone']; ?></td>
                                    <td><?php echo $data['city']; ?></td>
                                    <td><?php echo $data['buyer_ip']; ?></td>
                                    <td><?php echo $data['items']; ?></td>
                                    <td><?php echo $data['amount']; ?></td>
                                    <td><?php echo $data['note']; ?></td>
                                    <td><?php echo $data['entry_at']; ?></td>
                                    <td><?php echo $data['entry_by']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } else { ?>
                    <p>No data found</p>
                <?php } ?>
            </div>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item <?= ($current_page_number == 1) ? 'disabled' : ''; ?>">
                        <a class="page-link" href="#" onclick="filterAndPaginateList('<?php echo $current_page_number - 1; ?>')" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>

                    <?php for ($i = max(1, $current_page_number - 2); $i <= min($total_pages, $current_page_number + 2); $i++) : ?>
                        <li class="page-item <?= ($i == $current_page_number) ? 'active' : ''; ?>">
                            <a class="page-link" href="#" onclick="filterAndPaginateList('<?php echo $i; ?>')"><?= $i;  ?></a>
                        </li>
                    <?php endfor; ?>

                    <li class="page-item <?= ($current_page_number == $total_pages) ? 'disabled' : ''; ?>">
                        <a class="page-link" href="#" onclick="filterAndPaginateList('<?php echo $current_page_number + 1; ?>')" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.js"></script>
    <script>
        $(document).ready(function() {
            $('input[id="daterange"]').daterangepicker({
                autoUpdateInput: false,
            }, function(start, end, label) {
                $('#daterange').val(start.format('YYYY-MM-DD') + "~" + end.format('YYYY-MM-DD'));
            });
        })

        function filterAndPaginateList(page) {
            let entry_at = $('#daterange').val()
            let entry_by = $('#entryBy').val()

            let per_page = $('#per-page').val()
            let url = '/assignment/show-report?page=' + page;

            if (per_page) {
                url = url + '&per_page=' + per_page
            }
            if (entry_at) {
                url = url + '&entry_at=' + entry_at
            }
            if (entry_by) {
                url = url + '&entry_by=' + entry_by
            }

            window.location.href = url;
        }

        function clearFilter() {
            window.location.href = '/assignment/show-report';
        }
    </script>
</body>

</html>