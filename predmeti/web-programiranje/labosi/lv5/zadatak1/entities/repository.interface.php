<?php
namespace Cat;

// This would probably be an abstract class as repositories can reuse logic. But no need in project as there is just one repository, this is just to meet requirements
interface IRepository {
    public function getAll(): array;

    public function getOne($id): array;

    public function createOrUpdate($data);

    public function delete($id);
}

?>