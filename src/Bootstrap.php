<?php

namespace Brooke1220\WebmanFavorite;

use Brooke1220\WebmanFavorite\Events\Favorited;
use Brooke1220\WebmanFavorite\Events\Unfavorited;

class Bootstrap implements \Webman\Bootstrap
{
    public static function start($worker)
    {
        Favorite::getEventDispatcher()->listen(
            Favorited::class,
            function(Favorited $event){
                \Webman\Event\Event::emit(Favorited::class, $event);
            }
        );

        Favorite::getEventDispatcher()->listen(
            Unfavorited::class,
            function(Unfavorited $event){
                \Webman\Event\Event::emit(Unfavorited::class, $event);
            }
        );
    }
}