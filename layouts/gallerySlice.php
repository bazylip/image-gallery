<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gallery</title>
</head>
<body>
    <ul>
        <?php foreach ($images as $image): ?>
            <li><?php echo '<a href="/image/show?imageId=' . substr($image, 0, 1) . 'w">' . '<img src="/image/show?imageId=' . substr($image, 0, -4) . '" /></a>'; ?></li>
        <?php endforeach; ?>
    </ul>

    <a href="/gallery?page=<?= ($this->pageNumber)-1 ?>">Previous page</a>
    <a href="/gallery?page=<?= ($this->pageNumber)+1 ?>">Next page</a>
</body>
</html>