<?php

namespace App\Repository;

use App\Task;

interface TaskRepository {

    public function findAll();

    public function findByID(int $id);

    public function save(Task $task);

    public function updateById(int $id, Task $task);

    public function deleteById(int $id);

    public function  findByName($name);
}