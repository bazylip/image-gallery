<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gallery</title>
</head>
<body>
    <ul>
        <?php foreach ($images as $image): ?>
            <li>
                <?php $id = substr($image, 0, strlen($image)-5); ?>
                <?php echo '<a href="/image/show?imageId=' . $id . 'w">' . '<img src="/image/show?imageId=' . $id . 't" /></a>'; ?>
                <?php echo '<p>Tytuł: ' . $this->getTitle($id) . '</p>'?>
				<?php echo '<p>Autor: ' . $this->getAuthor($id) . '</p>'?>
            </li>
        <?php endforeach; ?>
    </ul>

    <?php if ($this->pageNumber > 0) echo '<a href="/gallery?page=' . strval(($this->pageNumber)-1) . '">Previous page</a>' ?>
    <?php if ($this->pageNumber < $this->maxPageNumber) echo '<a href="/gallery?page=' . strval(($this->pageNumber)+1) . '">Next page</a>' ?>
</body>
</html>