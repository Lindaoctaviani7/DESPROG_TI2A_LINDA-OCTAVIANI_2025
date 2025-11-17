<!DOCTYPE html>
<html>
<head>
    <title>Multiupload dokumen</title>
</head>
<body>
    <h2>unggah dokumen</h2>
    <form action="proses_upload.php" method="post" enctype="multipart/form-date">
        <input type="file" name="files[]" multiple="multiple" accept=".jpg, .png, .jpeg">
        <input type="submit" value="Unggah">
    </form>
</body>
</html>