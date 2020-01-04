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

    <?php if ($this->pageNumber > 0) echo '<a href="/gallery?page=' . strval(($this->pageNumber)-1) . '">Previous page</a>' ?>
    <?php if ($this->pageNumber < $this->maxPageNumber) echo '<a href="/gallery?page=' . strval(($this->pageNumber)+1) . '">Next page</a>' ?>
</body>
</html>