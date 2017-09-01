<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2015-12-14
 */

use Net\Bazzline\HttpRequestMockServer\HttpRequestMockServerFactory;

require_once __DIR__ . '/../vendor/autoload.php';

$factory = new HttpRequestMockServerFactory();

$factory->create()->execute();
