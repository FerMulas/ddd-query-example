<?php

use Zend\Stdlib\ArrayUtils;
use Zend\Stdlib\Glob;

$cachedConfigFile = __DIR__ . '/../data/cache/app_config.php';

$config = [];
if (is_file($cachedConfigFile)) {
    $config = json_decode(file_get_contents($cachedConfigFile), true);
} else {
    foreach (Glob::glob(__DIR__ . '/autoload/{{,*.}global,{,*.}local}.php', Glob::GLOB_BRACE) as $file) {
        $config = ArrayUtils::merge($config, include $file);
    }

    if (isset($config['config_cache_enabled']) && $config['config_cache_enabled'] === true) {
        file_put_contents($cachedConfigFile, json_encode($config));
    }
}

return new \ArrayObject($config, \ArrayObject::ARRAY_AS_PROPS);
