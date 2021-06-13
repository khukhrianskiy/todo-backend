<?php

namespace App\Repositories;

use App\Models\Hashtag;

class MysqlHashtagRepository implements HashtagRepositoryInterface
{
    public function findByName(string $name): ?Hashtag
    {
        return Hashtag::where(['name' => $name])->first();
    }
}
