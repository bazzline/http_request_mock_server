<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2017-08-31
 */

namespace Net\Bazzline\HttpRequestMockServer\Content;

interface ProvidedContentHandlerStrategyInterface
{
    /**
     * @param string $providedContent
     * @return string
     */
    public function handle($providedContent);
}