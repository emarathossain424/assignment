<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container bg-secondary-subtle">
        <div class="p-5">
            <h2 class="text-left mb-4">Create Order</h2>
            <form method="post" action="index.php" class="row g-3">
                <div class="col-md-6">
                    <label for="amount" class="form-label mt-2"><strong>Amount:</strong></label>
                    <input type="number" class="form-control" id="amount" name="amount">

                    <label for="buyer" class="form-label mt-2"><strong>Buyer:</strong></label>
                    <input type="text" class="form-control" id="buyer" name="buyer">

                    <label for="receipt_id" class="form-label mt-2"><strong>Receipt Id:</strong></label>
                    <input type="number" class="form-control" id="receipt_id" name="receipt_id">

                    <label for="email" class="form-label mt-2"><strong>Email:</strong></label>
                    <input type="email" class="form-control" id="email" name="email">

                    <label for="note" class="form-label mt-2"><strong>Note:</strong></label>
                    <textarea class="form-control" id="note" rows="3"></textarea>

                    <label for="city" class="form-label mt-2"><strong>City:</strong></label>
                    <input type="text" class="form-control" id="city" name="city">

                    <label for="phone" class="form-label mt-2"><strong>Phone:</strong></label>
                    <input type="text" class="form-control" id="phone" name="phone">

                    <label for="entry_by" class="form-label mt-2"><strong>Entry By:</strong></label>
                    <input type="number" class="form-control" id="entry_by" name="entry_by">

                    <button type="submit" class="btn btn-primary btn-block mt-2">Submit</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>