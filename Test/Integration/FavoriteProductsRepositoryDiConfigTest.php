<?php

declare(strict_types = 1);

namespace VinaiKopp\FavoriteProducts;

use Magento\Framework\ObjectManager\ConfigInterface as ObjectManagerConfig;
use Magento\TestFramework\ObjectManager;
use PHPUnit\Framework\TestCase;

class FavoriteProductsRepositoryDiConfigTest extends TestCase
{
    private $instanceType = Api\FavoriteProductsRepositoryInterface::class;

    private function getDiConfiguration(): ObjectManagerConfig
    {
        return ObjectManager::getInstance()->get(ObjectManagerConfig::class);
    }

    public function testPreference()
    {
        $this->assertSame(Model\FavoriteProductsRepository::class, $this->getDiConfiguration()->getPreference($this->instanceType));
    }
}
