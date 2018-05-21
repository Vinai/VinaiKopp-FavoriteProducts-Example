<?php

declare(strict_types = 1);

namespace VinaiKopp\FavoriteProducts\Block;

use Magento\Catalog\Block\Product\AwareInterface as ProductAwareInterface;
use Magento\Framework\UrlInterface as UrlBuilder;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context as TemplateContext;
use PHPUnit\Framework\TestCase;

/**
 * @covers \VinaiKopp\FavoriteProducts\Block\AddToFavoritesTest
 */
class AddToFavoritesTest extends TestCase
{
    /**
     * @var UrlBuilder|\PHPUnit_Framework_MockObject_MockObject
     */
    private $mockUrlBuilder;

    private function createFavoritesBlock(): AddToFavorites
    {
        /** @var TemplateContext|\PHPUnit_Framework_MockObject_MockObject $stubContext */
        $stubContext = $this->getMockBuilder(TemplateContext::class)
            ->disableOriginalConstructor()
            ->getMock();
        $stubContext->method('getUrlBuilder')->willReturn($this->mockUrlBuilder);
        
        return new AddToFavorites($stubContext);
    }

    protected function setUp()
    {
        $this->mockUrlBuilder = $this->createMock(UrlBuilder::class);
    }

    public function testExtendsTemplateBlock()
    {
        $this->assertInstanceOf(Template::class, $this->createFavoritesBlock());
    }

    public function testImplementsProductAwareInterface()
    {
        $this->assertInstanceOf(ProductAwareInterface::class, $this->createFavoritesBlock());
    }

    public function testReturnsRestEndpointUrl()
    {
        $this->mockUrlBuilder->expects($this->once())->method('getDirectUrl')
            ->with('rest/V1/vinaikopp/favoriteproducts/')
            ->willReturn('http://example.com/foo');
        
        $this->assertSame('http://example.com/foo', $this->createFavoritesBlock()->getApiUpdateUrl());
    }
}
