<?php
$uploadedFile = '';
$uploadDir = 'uploads/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $uploadFile = $uploadDir . basename($file['name']);

    if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
        $uploadedFile = $uploadFile;
    } else {
        echo "Upload failed.";
    }
}
if (!empty($_GET['delete'])) {
    $fileToDelete = $uploadDir . basename($_GET['delete']);
    if (file_exists($fileToDelete)) {
        unlink($fileToDelete);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP File Upload</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="file" accept=".php, .html" required>
        <input type="submit" value="Upload">
    </form>

    <?php if ($uploadedFile): ?>
        <h2>Uploaded File:</h2>
        <iframe src="<?php echo htmlspecialchars($uploadedFile); ?>" width="100%" height="300"></iframe>
        <script>
            setTimeout(() => {
                window.location.href = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?delete=<?php echo urlencode(basename($uploadedFile)); ?>";
            }, 60000);
        </script>
    <?php endif; ?>
</body>
</html>
