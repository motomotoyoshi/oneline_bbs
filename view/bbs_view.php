<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ひとこと掲示板</title>
</head>

<body>
    <h1>ひとこと掲示板</h1>
    <form action="bbs.php" method="post">
        <?php if (count($errors)) : ?>
            <ul class="error_list">
                <?php foreach ($errors as $error) : ?>
                    <li>
                        <?php echo htmlspecialchars($error, ENT_QUOTES, 'utf-8') ?>
                    </li>
                <?php endforeach ?>
            </ul>
        <?php endif; ?>
        name: <input type="text" name="name" id=""><br />
        comment: <input type="text" name="comment" id=""><br />
        <input type="submit" name="submit" value="submit">
    </form>

    <?php if (count($posts) > 0) : ?>
        <ul>
            <?php foreach ($posts as $post) : ?>
                <li>
                    <?php echo htmlspecialchars($post['name'], ENT_QUOTES, 'UTF-8'); ?>:
                    <?php echo htmlspecialchars($post['comment'], ENT_QUOTES, 'UTF-8'); ?>
                    - <?php echo htmlspecialchars($post['created_at'], ENT_QUOTES, 'UTF-8'); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>

</html>