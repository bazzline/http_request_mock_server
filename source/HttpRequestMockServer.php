<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2017-08-31
 */

namespace Net\Bazzline\HttpRequestMockServer;

use Net\Bazzline\HttpRequestMockServer\Content\DefaultContentBuilder;
use Net\Bazzline\HttpRequestMockServer\Content\ProvidedContentHandlerStrategyInterface;
use Net\Bazzline\HttpRequestMockServer\Output\OutputStrategyInterface;

class HttpRequestMockServer
{
    /** @var string */
    private $defaultFormat;

    /** @var array|ProvidedContentHandlerStrategyInterface[] */
    private $listOfFormatToProvidedContentHandlerStrategyInterface;

    /** @var array|OutputStrategyInterface */
    private $listOfFormatToOutputStrategyInterface;

    /** @var string */
    private $method;

    /** @var DefaultContentBuilder */
    private $defaultContentBuilder;

    /** @var string */
    private $url;

    /**
     * HttpRequestMockServer constructor.
     *
     * @param DefaultContentBuilder $defaultContentBuilder
     * @param string $defaultFormat
     * @param array|OutputStrategyInterface[] $listOfFormatToOutputStrategyInterface
     * @param array|ProvidedContentHandlerStrategyInterface[] $listOfFormatToProvidedContentHandlerStrategyInterface
     * @param string $method
     * @param string $url
     */
    public function __construct(
        DefaultContentBuilder $defaultContentBuilder,
        $defaultFormat,
        array $listOfFormatToOutputStrategyInterface,
        array $listOfFormatToProvidedContentHandlerStrategyInterface,
        $method,
        $url
    ) {
        $this->defaultContentBuilder                                    = $defaultContentBuilder;
        $this->defaultFormat                                            = $defaultFormat;
        $this->listOfFormatToOutputStrategyInterface                    = $listOfFormatToOutputStrategyInterface;
        $this->listOfFormatToProvidedContentHandlerStrategyInterface    = $listOfFormatToProvidedContentHandlerStrategyInterface;
        $this->method                                                   = $method;
        $this->url                                                      = $url;
    }

    public function execute()
    {
        //begin of dependencies
        $defaultContentBuilder                                  = $this->defaultContentBuilder;
        $defaultFormat                                          = $this->defaultFormat;
        $listOfFormatToOutputStrategyInterface                  = $this->listOfFormatToOutputStrategyInterface;
        $listOfFormatToProvidedContentHandlerStrategyInterface  = $this->listOfFormatToProvidedContentHandlerStrategyInterface;
        $method                                                 = $this->method;
        $query                                                  = [];
        $url                                                    = $this->url;
        //end of dependencies

        //begin of business logic
        //  begin of parsing the sent data
        $parsedUrl  = parse_url($url);  //@see: https://secure.php.net/manual/en/function.parse-url.php

        if (isset($parsedUrl['query'])) {
            parse_str($parsedUrl['query'], $query);
        }

        if (isset($query['format'])) {
            $format = strtolower($query['format']);

            if (!isset($listOfFormatToOutputStrategyInterface[$format])) {
                $format = $defaultFormat;
            }
        } else {
            $format = $defaultFormat;
        }
        if (isset($query['status_code'])) {
            //@todo - implement validation if status code is allowed?
            http_response_code((int) $query['status_code']);
        }
        //  end of parsing the sent data

        //  begin of content building
        //@link http://php.net/manual/en/function.filter-input.php
        //@link http://php.net/manual/en/filter.filters.php
        if (isset($query['content'])) {
            $contentHandlerStrategy = $listOfFormatToProvidedContentHandlerStrategyInterface[$format];

            $content = $contentHandlerStrategy->handle($query['content']);
        } else {
            $content = $defaultContentBuilder->build(
                array_keys($listOfFormatToOutputStrategyInterface),
                $method,
                $parsedUrl,
                $query,
                $url
            );
        }
        //  end of content building

        //  begin of the output
        $outputStrategy = $listOfFormatToOutputStrategyInterface[$format];

        header($outputStrategy->getContentType());
        echo $outputStrategy->getFormattedContent($content);
        //  end of the output
        //end of business logic
    }
}