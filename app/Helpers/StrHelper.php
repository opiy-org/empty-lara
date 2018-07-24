<?php
/**
 * Created by PhpStorm.
 * User: alex14v
 * Date: 22.06.18
 * Time: 10:52
 */

namespace App\Helpers;


use Illuminate\Support\Str;

class StrHelper
{

    /**
     * Generate slug from input string
     *
     * @param string $inputstr
     * @return string
     */
    public static function makeSlug(string $inputstr) {
        $inputstr=preg_replace('/[^\w0-9]/u', '', $inputstr);
        $inputstr=Str::slug($inputstr);
        return $inputstr;
    }

}