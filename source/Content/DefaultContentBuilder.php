<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2017-08-31
 */

namespace Net\Bazzline\HttpRequestMockServer\Content;

class DefaultContentBuilder
{
    /**
     * @param array $listOfSupportedFormat
     * @param string $method
     * @param string $parsedUrl
     * @param array $query
     * @param string $url
     * @return array
     */
    public function build(
        array $listOfSupportedFormat,
        $method,
        $parsedUrl,
        array $query,
        $url
    ) {
        return [
            'date_time'     => date('Y-m-d H:i:s'),
            'description'   => [
                'This http request mock server simple returns the called url and some information.',
                '',
                'There are three query arguments supported:',
                '   content="content as [json|raw|xml] urlencoded string //@link http://php.net/manual/en/function.urlencode.php"',
                '   format=[' . implode('|', $listOfSupportedFormat) . ']',
                '   status_code=500" will return a status code of 500',
            ],
            'headers'       => apache_request_headers(),
            'method'        => $method,
            'parsed_url'    => $parsedUrl,
            'query'         => $query,
            'url'           => rawurlencode($url)
        ];
    }
}