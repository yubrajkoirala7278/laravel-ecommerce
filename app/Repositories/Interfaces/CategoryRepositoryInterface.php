<?php

namespace App\Repositories\Interfaces;

Interface CategoryRepositoryInterface{
    public function all();
    public function create($request);
    public function destroy($category);
    public function update($request, $category);
}