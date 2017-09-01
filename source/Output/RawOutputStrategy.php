<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2017-08-31
 */

namespace Net\Bazzline\HttpRequestMockServer\Output;

class RawOutputStrategy implements OutputStrategyInterface
{
    /**
     * @param mixed $content
     * @return mixed
     */
    public function getFormattedContent($content)
    {
        return var_export(
            $content,
            true
        );
    }

    /**
     * @return string
     */
    public function getContentType()
    {
        return 'Content-Type: application/text';
    }
}