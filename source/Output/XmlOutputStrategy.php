<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2017-08-31
 */

namespace Net\Bazzline\HttpRequestMockServer\Output;

class XmlOutputStrategy implements OutputStrategyInterface
{
    /**
     * @param mixed $content
     * @return string
     */
    public function getFormattedContent($content)
    {
        $xml = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' . PHP_EOL;
        $xml .= '<xml>' . PHP_EOL;
        if (is_array($content)) {
            foreach ($content as $subject => $data) {
                $xml .= '    <' . $subject . '>' . PHP_EOL;
                if (is_array($data)) {
                    foreach ($data as $index => $line) {
                        $xml .= '        <data index="' . $index . '"><![CDATA[' . $line . ']]></data>' . PHP_EOL;
                    }
                } else {
                    $xml .= '        <data><![CDATA[' . $data . ']]></data>' . PHP_EOL;
                }
                $xml .= '    </' . $subject . '>' . PHP_EOL;
            }
        } else {
            $xml .= $content . PHP_EOL;
        }
        $xml .= '</xml>';

        return $xml;
    }

    /**
     * @return string
     */
    public function getContentType()
    {
        return 'Content-Type: application/xml;charset=UTF-8';
    }
}