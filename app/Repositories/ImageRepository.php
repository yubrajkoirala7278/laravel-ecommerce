<?php

namespace App\Repositories;

use App\Repositories\Interfaces\ImageRepositoryInterface;
use App\Models\Image;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;

class ImageRepository implements ImageRepositoryInterface
{
    // Method to add images to a model
    public function addImages($model, $images = [], $directory)
    {
        // Save images to the specified directory
        $this->saveImages($model, $images, 'public/images/' . $directory);
        return; // Return nothing
    }

    // Method to save images to storage
    private function saveImages($model, $images, $directory)
    {
        if (!empty($images)) { // Check if there are images to save
            $imageArr = []; // Array to store image objects
            $this->makeDirectory($directory); // Create directory if it doesn't exist
            foreach ($images as $image) {
                $imageNames = $this->makeName($image); // Generate unique filename
                $this->moveImage($image, $directory, $imageNames['saveName'], 1024, 720); // Move and resize image
                // Create a new Image model instance
                $imageModel = new Image();
                // Assign model type (e.g., User, Product, etc.)
                $imageModel->model_type = $model;
                // Assign model ID
                $imageModel->model_id = $model->id;
                // Assign filename
                $imageModel->filename = $imageNames['saveName'];
                // Assign location
                $imageModel->location = $directory;
                // Add image to the array
                $imageArr[] = $imageModel;
            }
            // Save images in the database
            $model->images()->saveMany($imageArr);
        }

        return; // Return nothing
    }

    // Method to move and resize an image
    public function moveImage($image, $directory, $saveName, $width = 544, $height = 356)
    {
        // Read and resize the image
        $image = ImageManager::gd()->read($image);
        $image = $image->resize($width, $height);
        $image = $image->toWebp(70);
        // Store the image in the specified directory
        return Storage::put($directory . '/' . $saveName, $image, [
            'visibility' => 'public',
        ]);
    }

    // Method to generate a unique filename for an image
    public function makeName($image, $type = null)
    {
        // Get the original filename
        $originalName = Str::replace(' ', '-', trim($image->getClientOriginalName()));
        // Limit the filename length
        $NameWithoutExtension = Str::limit(pathinfo($originalName, PATHINFO_FILENAME), 200);
        // Generate a unique save filename
        $saveName = time() . '-' . $NameWithoutExtension . '.' . $image->getClientOriginalExtension();
        return [
            'saveName' => $saveName, // Return the unique filename
            'originalName' => $originalName, // Return the original filename
        ];
    }

    // Method to update images for a model
    public function updateImages($model, $images, $directory, $deletePrevious = false)
    {
        // Check if there are new images to update
        if (!empty($images)) {
            // If deletePrevious flag is set to true, delete previous images
            if ($deletePrevious) {
                $this->deleteImages($model->images); // Delete previous images
            }
            // Make the directory if it doesn't exist
            $this->makeDirectory($directory);
            // Save new images
            $this->saveImages($model, $images, 'public/images/' . $directory);
        }
    }

    // Method to delete images
    public function deleteImages($images)
    {
        foreach ($images as $image) {
            // Delete image from the database
            $image->delete();
            // Delete image from local storage
            $path = $image->location . '/' . $image->filename;
            Storage::delete($path);
        }
    }

    // Method to create a directory if it doesn't exist
    private function makeDirectory($path)
    {
        if (!Storage::exists($path)) {
            Storage::makeDirectory($path);
        }

        return; // Return nothing
    }
}
