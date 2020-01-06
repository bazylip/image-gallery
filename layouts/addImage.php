<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
    <form action="/image/send" method="post" enctype="multipart/form-data">
        <p><input type="text" name="title" placeholder="Title"></p>
        <p><input type="text" name="author" placeholder="Author" value="<?= $this->getUser() ?>"></p>
        <p><input type="text" name="watermark" placeholder="Watermark" required></p>
        <p><input type="file" name="image" required></p>
        <?php
            if($this->isLogged()){
                echo '<p><label><input type="radio" name="privacy" value="public" checked>Public</label>
                        <label><input type="radio" name="privacy" value="private">Private</label></p>';
            }
        ?>
        <br/>
        <p><input type="submit" name="button" value="Send"></p>
    </form>
</body>
</html>
