<?php

require_once '../components/header.php';

$attributes = $catRepository->createEmpty();
if($_GET['id']) {
    $attributes = $catRepository->getOne($_GET['id']);
    // we could throw error here if cat does not exist
}

?>

<div id="container" class="container">
    <form>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $attributes['name'] ?>" required>
        </div>
        <div class="form-group">
            <label for="info">Info</label>
            <input type="text" class="form-control" id="info" name="info" value="<?php echo $attributes['info'] ?>" required>
        </div>
        <div class="form-group">
            <div class="form-row">
                <div class="col">
                    <label for="wins">Wins</label>
                    <input type="number" class="form-control" id="wins" name="wins" value="<?php echo $attributes['wins'] ?>" required>
                </div>
                <div class="col">
                    <label for="info">Loss</label>
                    <input type="number" class="form-control" id="loss" name="loss" value="<?php echo $attributes['loss'] ?>" required>
                </div>
                <div class="col">
                    <label for="age">Age</label>
                    <input type="number" class="form-control" id="age" name="age" value="<?php echo $attributes['age'] ?>" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php if($_GET['id']) { ?>
                <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>" />
            <?php } ?>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
