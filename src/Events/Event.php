<?php

namespace Brooke1220\WebmanFavorite\Events;

use Illuminate\Database\Eloquent\Model;

class Event
{
    public Model $favorite;

    public function __construct(Model $favorite)
    {
        $this->favorite = $favorite;
    }
}
