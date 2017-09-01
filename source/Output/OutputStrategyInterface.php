<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2017-08-31
 */

namespace Net\Bazzline\HttpRequestMockServer\Output;

use InvalidArgumentException;

interface OutputStrategyInterface
{
    /**
     * @param mixed $content
     * @return string
     * @throws InvalidArgumentException
     */
    public function getFormattedContent($content);

    /**
     * @return string
     */
    public function getContentType();
}