<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
    <form action="/image/send" method="post" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Title">
        <input type="text" name="author" placeholder="Author">
        <input type="text" name="watermark" placeholder="Watermark" required>
        <input type="file" name="image" required>
        <br/>
        <input type="submit" name="button" value="Send">
    </form>
</body>
</html>
