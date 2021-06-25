<?php

namespace App\Repository;

use App\Task;

class TaskRepositoryImpl implements TaskRepository
{
    public function findAll()
    {
        return Task::all();
    }

    public function findByID($id)
    {
        try {
            return Task::where('id', $id)->first();
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function save($task)
    {
        try {
            return Task::create([
                'name' => $task->name,
                'completed' => false,
            ]);
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function updateById($id, $task)
    {
        try {
            $oldTask =  Task::where('id', $id)->first();
            if($oldTask != null) {
                Task::where('id', $id)->update([
                        'name' => $task->name,
                        'completed' => $task->completed,
                    ]);
                return Task::where('id', $id)->first();
            } else {
                return null;
            }
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function deleteById($id)
    {
       try {
            $task =  Task::where('id', $id)->first();
            if($task != null) {
                return Task::where('id', $id)->delete();
            } else {
                return null;
            }
       } catch (\Throwable $th) {
            return null;
       }
    }

    public function  findByName($name) {
        try {
            return Task::where('name', $name)->get();
        } catch (\Throwable $th) {
            return [];
        }
    }
}
