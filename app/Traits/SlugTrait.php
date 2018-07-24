<?php
/**
 * Created by PhpStorm.
 * User: alex14v
 * Date: 22.06.18
 * Time: 11:14
 */

namespace App\Traits;


use App\Helpers\StrHelper;

trait SlugTrait
{

    public static function boot()
    {
        parent::boot();

        static::creating(function ($item) {
            $name_attr = $item->name_attr ? $item->name_attr : 'name';

            if (!$item->slug) {
                $item->slug = StrHelper::makeSlug($item->$name_attr);
            }

            $count = static::whereRaw("slug='{$item->slug}' OR slug LIKE '{$item->slug}-%'")->count();

            if ($count) {
                $item->slug = "{$item->slug}-{$count}";
            }
        });
    }

}