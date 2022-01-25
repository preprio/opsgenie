<?php

return [
    'key' => env('OPSGENIE_KEY'),
    'service' => env('OPSGENIE_SERVICE'),
    'prefix' => env('OPSGENIE_PREFIX', null),
    'tags' => env('OPSGENIE_TAGS', null),
];
