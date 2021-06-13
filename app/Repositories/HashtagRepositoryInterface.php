<?php

namespace App\Repositories;

use App\Models\Hashtag;

interface HashtagRepositoryInterface
{
    public function findByName(string $name): ?Hashtag;

}