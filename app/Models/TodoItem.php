<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $text
 * @property Hashtag[] $hashtags
 * @property Category[] $categories
 * @property DateTime $end_date
 */
class TodoItem extends Model
{
    use HasFactory;

    public const END_DATE_FORMAT = 'Y-m-d H:i:s';

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'todo_item_categories');
    }

    public function hashtags(): BelongsToMany
    {
        return $this->belongsToMany(Hashtag::class, 'todo_item_hashtags');
    }
}
