<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2017-08-31
 */

namespace Net\Bazzline\HttpRequestMockServer\Output;

class JsonOutputStrategy implements OutputStrategyInterface
{
    /**
     * @param mixed $content
     * @return string
     */
    public function getFormattedContent($content)
    {
        return json_encode(
            $content,
            JSON_PRETTY_PRINT
        );
    }

    /**
     * @return string
     */
    public function getContentType()
    {
        return 'Content-Type: application/json';
    }
}