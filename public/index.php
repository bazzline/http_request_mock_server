<?php

/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2015-12-14
 */

//begin of dependencies
$buildDefaultContent    = false;
$content                = [];
$defaultFormat          = 'json';
$listOfSupportedFormat  = [
    'json'  => true,
    'raw'   => true,
    'xml'   => true
];
$method                 = isset($_SERVER['REQUEST_METHOD'])
        ? $_SERVER['REQUEST_METHOD']
        : 'GET';
$query                  = [];
$url                    = isset($_SERVER['REQUEST_URI'])
        ? $_SERVER['REQUEST_URI']
        : '/';
//end of dependencies

//begin of business logic
//  begin of parsing the sent data
$parsedUrl  = parse_url($url);  //@see: https://secure.php.net/manual/en/function.parse-url.php

if (isset($parsedUrl['query'])) {
    parse_str($parsedUrl['query'], $query);
}

if (isset($query['format'])) {
    $format = strtolower($query['format']);

    if (!isset($listOfSupportedFormat[$format])) {
        $format = $defaultFormat;
    }
} else {
    $format = $defaultFormat;
}

//@link http://php.net/manual/en/function.filter-input.php
//@link http://php.net/manual/en/filter.filters.php
if (isset($query['content'])) {
    if ($format === 'raw') {
        $content = filter_var(
            $query['content'],
            FILTER_SANITIZE_STRING
        );
    } else {
        $content = filter_var(
            $query['content'],
            FILTER_SANITIZE_URL
        );
    }
} else {
    $buildDefaultContent = true;
}

if (isset($query['status_code'])) {
    http_response_code((int) $query['status_code']);
}
//  end of parsing the sent data

//  begin of content building
if ($buildDefaultContent) {
    $content['date_time']   = date('Y-m-d H:i:s');
    $content['description'] = [
        'This rest server simple returns the called url and some informations.',
        '',
        'There are three query arguments supported:',
        '   content="content as [json|raw|xml] urlencoded string //@link http://php.net/manual/en/function.urlencode.php"',
        '   format=[json|raw|xml]',
        '   status_code=500" will return a status code of 500',
    ];
    $content['headers']     = apache_request_headers();
    $content['method']      = isset($_SERVER['REQUEST_METHOD'])
        ? $_SERVER['REQUEST_METHOD']
        : 'GET';
    $content['query']       = $query;
    $content['parsed_url']  = $parsedUrl;
    $content['url']         = rawurlencode($url);
}
//  end of content building

//  begin of the output
switch ($format) {
    case 'json':
        header('Content-Type: application/json');
        echo json_encode(
            $content,
            JSON_PRETTY_PRINT
        );
        break;
    case 'raw':
        header('Content-Type: application/text');
        echo var_export(
            $content,
            true
        );
        break;
    case 'xml':
        header('Content-Type: application/xml;charset=UTF-8');
        echo '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' . PHP_EOL;
        echo '<xml>' . PHP_EOL;
        if (is_array($content)) {
            foreach ($content as $subject => $data) {
                echo '    <' . $subject . '>' . PHP_EOL;
                if (is_array($data)) {
                    foreach ($data as $index => $line) {
                        echo '        <data index="' . $index . '"><![CDATA[' . $line . ']]></data>' . PHP_EOL;
                    }
                } else {
                    echo '        <data><![CDATA[' . $data . ']]></data>' . PHP_EOL;
                }
                echo '    </' . $subject . '>' . PHP_EOL;
            }
        } else {
            echo $content . PHP_EOL;
        }
        echo '</xml>';
        break;
}
//  end of the output
//end of business logic
