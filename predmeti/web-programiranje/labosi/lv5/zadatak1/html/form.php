<?php

require_once '../components/header.php';

$attributes = $catRepository->createEmpty();
if($_GET['id']) {
    $attributes = $catRepository->getOne($_GET['id']);
    // we could throw error here if cat does not exist
}

?>

<div id="container" class="container">
    <form action="form_action.php" method="post" enctype="multipart/form-data" id="main-form">
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
                <div class="col">
                    <label for="age">Image</label>
                    <input type="file" class="form-control" id="image" name="imageHolder" <?php if(!$_GET['id']) { echo 'required'; } ?>>
                    <!-- This field should only be required when adding new cat, no need to re-upload image if it stays the same -->
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php if($_GET['id']) { ?>
                <input type="hidden" name="id" id="id_field" value="<?php echo $_GET['id'] ?>" />
            <?php } ?>
            <!-- Send id to backend if this is edit -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>

<script>
    window.onload = function () {
        // this script is actually useless as html5 validation works this out of the box. Just to fill task requirements
        const fields = ['wins', 'info', 'wins', 'loss', 'age']
        if(!document.getElementById('id_field')) fields.push('image') // image is only required when adding new, not update
        const htmlFields = fields.map(field => document.getElementById(field))
        document.getElementById('main-form').addEventListener('main-form', e => {
            for(const htmlField of htmlFields) {
                if(!htmlField.value) e.preventDefault()
            }
        })
    }
</script>
