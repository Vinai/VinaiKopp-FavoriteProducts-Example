<?php declare(strict_types = 1);

namespace VinaiKopp\FavoriteProducts\Model;

use PHPUnit\Framework\TestCase;
use VinaiKopp\FavoriteProducts\Api\FavoriteProductsRepositoryInterface;

/**
 * @covers \VinaiKopp\FavoriteProducts\Model\FavoriteProductsRepositoryTest
 */
class FavoriteProductsRepositoryTest extends TestCase
{
    /**
     * @var FavoriteProductsSession|\PHPUnit_Framework_MockObject_MockObject
     */
    private $mockSession;

    private function createRepository(): FavoriteProductsRepository
    {
        return new FavoriteProductsRepository($this->mockSession);
    }

    protected function setUp()
    {
        $this->mockSession = $this->getMockBuilder(FavoriteProductsSession::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testImplementsFavoriteProductsRepositoryInterface()
    {
        $this->assertInstanceOf(FavoriteProductsRepositoryInterface::class, $this->createRepository());
    }

    public function testReturnsTheSkusStoredInTheSession()
    {
        $favoriteSkus = ['foo', 'bar', 'baz'];
        $this->mockSession->method('getFavoriteSkus')->willReturn($favoriteSkus);
        $this->assertSame($favoriteSkus, $this->createRepository()->getSkus());
    }

    public function testAddsSkuToSession()
    {
        $this->mockSession->expects($this->once())->method('addFavoriteSku')->with('foo');
        $this->createRepository()->addBySku('foo');
    }

    public function testRemovesSkuFromSession()
    {
        $this->mockSession->expects($this->once())->method('removeFavoriteSku')->with('bar');
        $this->createRepository()->removeBySku('bar');
    }
}
