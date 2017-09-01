<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2017-08-31
 */

namespace Net\Bazzline\HttpRequestMockServer;

use Net\Bazzline\HttpRequestMockServer\Content\DefaultContentBuilder;
use Net\Bazzline\HttpRequestMockServer\Content\DefaultProvidedContentHandlerStrategy;
use Net\Bazzline\HttpRequestMockServer\Content\RawProvidedContentHandlerStrategy;
use Net\Bazzline\HttpRequestMockServer\Output\JsonOutputStrategy;
use Net\Bazzline\HttpRequestMockServer\Output\OutputStrategyInterface;
use Net\Bazzline\HttpRequestMockServer\Output\RawOutputStrategy;
use Net\Bazzline\HttpRequestMockServer\Output\XmlOutputStrategy;

class HttpRequestMockServerFactory
{
    const FORMAT_JSON   = 'json';
    const FORMAT_RAW    = 'raw';
    const FORMAT_XML    = 'xml';

    /**
     * @return HttpRequestMockServer
     */
    public function create()
    {
        return new HttpRequestMockServer(
            $this->getDefaultContentBuilder(),
            $this->getDefaultFormat(),
            $this->createListOfFormatToOutputStrategyInterface(),
            $this->createListOfFormatToProvidedContentHandlerStrategyInterface(),
            $this->detectMethod(),
            $this->detectUrl()
        );
    }

    /**
     * @return array
     */
    protected function createListOfFormatToProvidedContentHandlerStrategyInterface()
    {
        $defaultHandler = new DefaultProvidedContentHandlerStrategy();

        return [
            self::FORMAT_JSON   => $defaultHandler,
            self::FORMAT_RAW    => new RawProvidedContentHandlerStrategy(),
            self::FORMAT_XML    => $defaultHandler
        ];
    }

    /**
     * @return array|OutputStrategyInterface[]
     */
    protected function createListOfFormatToOutputStrategyInterface()
    {
        return [
            self::FORMAT_JSON   => new JsonOutputStrategy(),
            self::FORMAT_RAW    => new RawOutputStrategy(),
            self::FORMAT_XML    => new XmlOutputStrategy()
        ];
    }

    /**
     * @return DefaultContentBuilder
     */
    protected function getDefaultContentBuilder()
    {
        return new DefaultContentBuilder();
    }

    /**
     * @return string
     */
    protected function getDefaultFormat()
    {
        return self::FORMAT_JSON;
    }

    /**
     * @return string
     */
    protected function detectMethod()
    {
        return isset($_SERVER['REQUEST_METHOD'])
            ? $_SERVER['REQUEST_METHOD']
            : 'GET';
    }

    /**
     * @return string
     */
    protected function detectUrl()
    {
        return isset($_SERVER['REQUEST_URI'])
            ? $_SERVER['REQUEST_URI']
            : '/';
    }
}