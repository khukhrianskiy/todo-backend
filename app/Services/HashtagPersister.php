<?php

namespace App\Services;

use App\Models\Hashtag;

class HashtagPersister
{
    public function create(string $hashtagName): Hashtag
    {
        $hashtag = new Hashtag();
        $hashtag->name = $hashtagName;

        $hashtag->save();

        return $hashtag;
    }
}