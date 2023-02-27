<?php
return [
    'enable' => true,

    /**
     *  Database Connection
     */
    'database_connection' => 'mysql',

    /**
     * Use uuid as primary key.
     */
    'uuids' => false,

    /*
     * User tables foreign key name.
     */
    'user_foreign_key' => 'user_id',

    /*
     * Table name for favorites records.
     */
    'favorites_table' => 'favorites',

    /*
     * Model name for favorite record.
     */
    'favorite_model' => \Brooke1220\WebmanFavorite\Favorite::class,

    /**
     * Model name for user
     */
    'user_model' => \plugin\yuxun\app\model\User::class,
];