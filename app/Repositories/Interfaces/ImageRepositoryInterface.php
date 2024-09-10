<?php

namespace App\Repositories\Interfaces;

Interface ImageRepositoryInterface{
    public function addImages($model, $images = [], $directory);
    public function deleteImages($images);
    public function updateImages($model, $images, $directory, $deletePrevious = false);
}