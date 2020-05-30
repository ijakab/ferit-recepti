<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Heroku App</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

<div class="container text-center">
    <h1>Heroku Todo App</h1>

    <form action="#" class="form mb-3">
        <input name="todoText" type="text"/>
        <input name="submit" type="submit" value="Submit" class="btn btn-primary"/>
    </form>

    <ul class="table">
        <?php
        require "./controller/DbHandler.php";

        use Db\DbHandler;

        $db = new DbHandler();
        $result = $db->select("SELECT id,message FROM todo");
        ?>

        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <li class="card py-3">
                    <i class="text-right pr-3" id="<?= $row["id"]; ?>" class="icon icon-x">X</i>
                    <?= $row["message"] ?>
                </li>
            <?php endwhile; ?>
        <?php endif; ?>
    </ul>
</div>

<script src="app.js"></script>
</body>
</html>