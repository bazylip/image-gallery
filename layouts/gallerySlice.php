<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gallery</title>
</head>
<body>
    <form action=<?= get_class($this) == 'GallerySliceView' ? "/session/saveChoice?page=".$this->pageNumber : "/session/forgetChoice?page=".$this->pageNumber?> method="post">
        <ul>
            <?php foreach ($images as $image): ?>
                <li>
                    <?php $id = substr($image, 0, strlen($image)-5); ?>
                    <?php echo '<a href="/image/show?imageId=' . $id . 'w">' . '<img src="/image/show?imageId=' . $id . 't" /></a>'; ?>
                    <?php echo '<p>Tytuł: ' . $this->getTitle($id) . '</p>'?>
                    <?php echo '<p>Autor: ' . $this->getAuthor($id) . '</p>'?>
                    <?= (isset($_SESSION['picks']) && in_array($id, $_SESSION['picks']) && get_class($this) == 'GallerySliceView') ? '<input type="checkbox" name="picks[]" value="'. $id .'" checked>' : '<input type="checkbox" name="picks[]" value="'. $id .'">' ?>
                </li>
            <?php endforeach; ?>

        </ul>
        <?= get_class($this) == 'GallerySliceView' ? '<input type="submit" name="button" value="Remember checked images">' : '<input type="submit" name="button" value="Forget checked images">' ?>
    </form>
    <?php
    if(get_class($this) == 'GallerySliceView'){
        if ($this->pageNumber > 0) echo '<a href="/gallery?page=' . strval(($this->pageNumber)-1) . '">Previous page</a>';
        if ($this->pageNumber < $this->maxPageNumber) echo '<a href="/gallery?page=' . strval(($this->pageNumber)+1) . '">Next page</a>';
    }else{
		if ($this->pageNumber > 0) echo '<a href="/gallery/selected?page=' . strval(($this->pageNumber)-1) . '">Previous page</a>';
		if ($this->pageNumber < $this->maxPageNumber) echo '<a href="/gallery/selected?page=' . strval(($this->pageNumber)+1) . '">Next page</a>';
	}
    ?>
</body>
</html>