<?php

if (!function_exists('custom_logger')) {
    function custom_logger (array $data, $level = 'debug', $channels = '') {
        $defaultChannel = env('LOG_CHANNEL', 'single');
        if (empty($channels)) {
            $channels = $defaultChannel;
        }

        // if channels passed as array, we'll also push to the default channel
        if (!is_array($channels)) {
            $channels = [ $channels ];
        } else {
            // if default doesn't exist, push default.
            if (!in_array($defaultChannel, $channels)) {
                $channels[] = $defaultChannel;
            }
        }

        app('log')->stack($channels)->$level(json_encode($data));
    }
}
