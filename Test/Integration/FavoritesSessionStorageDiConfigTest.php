<?php

declare(strict_types = 1);

namespace VinaiKopp\FavoriteProducts;

use Magento\Framework\ObjectManager\ConfigInterface as ObjectManagerConfig;
use Magento\Framework\Session\Storage as SessionStorage;
use Magento\TestFramework\ObjectManager;
use VinaiKopp\FavoriteProducts\Model\FavoriteProductsSession;

class FavoritesSessionStorageDiConfigTest extends \PHPUnit_Framework_TestCase
{
    private $storageVirtualType = Model\FavoritesSessionStorage\Virtual::class;

    private function getDiConfiguration(): ObjectManagerConfig
    {
        return ObjectManager::getInstance()->get(ObjectManagerConfig::class);
    }

    public function testImplementsSessionStorage()
    {
        $diConfig = $this->getDiConfiguration();
        $this->assertSame(SessionStorage::class, $diConfig->getInstanceType($this->storageVirtualType));
    }

    public function testSessionNamespaceIsSet()
    {
        $arguments = $this->getDiConfiguration()->getArguments($this->storageVirtualType);
        $this->assertSame('vinaikopp_favoriteproducts', $arguments['namespace']);
    }

    public function testVirtualTypeIsConfiguredAsStorageForFavoritesSession()
    {
        $diConfig = $this->getDiConfiguration()->getArguments(FavoriteProductsSession::class);
        $this->assertSame($this->storageVirtualType, $diConfig['storage']['instance']);
        
    }
}
