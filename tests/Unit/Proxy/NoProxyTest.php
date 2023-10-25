<?php
namespace CViniciusSDias\GoogleCrawler\Tests\Unit\Proxy;

use PHPUnit\Framework\TestCase;
use CViniciusSDias\GoogleCrawler\Proxy\NoProxyAbstractFactory;
use CViniciusSDias\GoogleCrawler\Exception\InvalidUrlException;
use CViniciusSDias\GoogleCrawler\Exception\InvalidResultException;

class NoProxyTest extends TestCase
{
    public function testUrlFromGoogleSuggestionMustThrowInvalidResultException()
    {
        $this->expectException(InvalidResultException::class);
        $noProxy = new NoProxyAbstractFactory();
        $invalidUrl = 'http://google.com/search?q=Test&num=100&ie=UTF-8&prmd=ivnsla&source=univ&tbm=nws&tbo=u&sa=X&ved=0ahUKEwiF5PS6w6vSAhWJqFQKHQ_wBDAQqAIIKw';
        $noProxy->parseUrl($invalidUrl);
    }

    public function testUrlMustBeCorrectlyParsed()
    {
        $this->expectException(InvalidResultException::class);
        $noProxy = new NoProxyAbstractFactory();
        $validUrl = 'http://google.com//url?q=http://www.speedtest.net/pt/&sa=U&ved=0ahUKEwjYuPbkxqvSAhXFQZAKHdpyAxMQFggUMAA&usg=AFQjCNFR74JMZRVu3EUNUUHa7o_1ETZoiQ';
        $url = $noProxy->parseUrl($validUrl);
        static::assertEquals('http://www.speedtest.net/pt/', $url);
    }

    public function testTryingToGetHttpResponseFromInvalidUrlMustThrowException()
    {
        $this->expectException(InvalidResultException::class);
        $this->expectException(InvalidUrlException::class);
        $noProxy = new NoProxyAbstractFactory();
        $noProxy->getHttpResponse('teste');
    }
}
