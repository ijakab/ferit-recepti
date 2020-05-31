<?php
namespace Cat;

class CatView {
    private $repository;

    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    function displayFighters() {
        $cats = $this->repository->getAll();
        foreach ($cats as $cat) {
            $this->displayFighter($cat);
        }
    }

    function displayFighter($cat) {
        ?>
        <div class="col-md-4 mb-1">
            <div class="fighter-box"
                 data-info = '{
                                "id": <?php echo $cat['id']?>,
                                "name": "<?php echo $cat['name']?>" ,
                                "age" : <?php echo $cat['age']?>,
                                "catInfo": "<?php echo $cat['info']?>",
                                "record" : {
                                    "wins":  <?php echo $cat['wins']?>,
                                    "loss": <?php echo $cat['loss']?>
                                }
                            }'>
                <img src="<?php echo $cat['image']?>" alt="<?php echo $cat['name']?>" width="150" height="150">
                <a href="form.php?id=<?php echo $cat['id'] ?>" class="btn btn-sm btn-light edit-btn cat-form">Edit</a>
                <a href="delete.php?id=<?php echo $cat['id'] ?>" class="btn btn-sm btn-danger delete-btn cat-form">Delete</a>
            </div>
        </div>
        <?php
    }
}

?>