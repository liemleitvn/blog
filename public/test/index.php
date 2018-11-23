<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<form method="post" name="test">
    <input name="title">
    <input name="keyword">
    <button type="submit">Submit</button>
    <div>
        You just submitted title = <?php echo $_POST['title']?>

    </div>
</form>
</body>
</html>