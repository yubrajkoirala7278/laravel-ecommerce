<?php

namespace App\Repositories\Interfaces;

Interface BrandRepositoryInterface{
    public function all();
    public function store($request);
    public function destroy($brand);
    public function update($request, $brand);
}