<?php
namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

/**
 * Interface RepositoryInterface
 * @package App\Repository
 */
interface RepositoryInterface {
    /**
     * Get All objects in an Entity 
     * @return Entity List
     */
    public function findAll();
}