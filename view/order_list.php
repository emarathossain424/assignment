<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Data</title>
</head>
<body>
    <h2>Form Data</h2>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Email</th>
        </tr>
        <?php foreach ($formData as $data): ?>
            <tr>
                <td><?php echo $data['name']; ?></td>
                <td><?php echo $data['email']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
