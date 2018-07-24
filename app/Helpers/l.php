<?php
/**
 * Logs helper
 *
 */

namespace App\Helpers;

use Illuminate\Support\Facades\Log;

class l
{
    /**
     * Exception
     *
     * @param object $class
     * @param \Exception $exception
     * @param string $message
     */
    public static function exc($class, \Exception $exception, string $message = '')
    {
        Log::error(class_basename($class) . ': ' . $message . ' ' . $exception->getMessage() . "\n" . $exception->getFile() . ' ' . $exception->getLine());

        if (app()->bound('sentry')) {
            app('sentry')->captureException($exception);
        }
    }


    /**
     * Exception
     *
     * @param string $msg
     * @param \Exception $exception
     * @param string $message
     */
    public static function excnc($msg='Exc: ', \Exception $exception, string $message = '')
    {
        Log::error($msg . ': ' . $message . ' ' . $exception->getMessage() . "\n" . $exception->getFile() . ' ' . $exception->getLine());
    }

    /**
     * Error
     *
     * @param object $class
     * @param string $message
     */
    public static function error($class, string $message)
    {
        Log::error(class_basename($class) . ': ' . $message);
    }

    /**
     * Debug
     *
     * @param string $message
     * @param mixed|null $var
     * @param object|null $class
     */
    public static function debug(string $message = '', $var=null, $class = null)
    {
        if ($class) {
            Log::debug(class_basename($class) . ': ' . $message . print_r($var, true));
        } else {
            Log::debug($message . print_r($var, true));
        }
    }

}