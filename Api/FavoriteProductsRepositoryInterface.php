<?php declare(strict_types = 1);

namespace VinaiKopp\FavoriteProducts\Api;

interface FavoriteProductsRepositoryInterface
{
    /**
     * @return string[]
     */
    public function getSkus();

    /**
     * @param string $sku
     * @return void
     */
    public function addBySku($sku);

    /**
     * @param string $sku
     * @return void
     */
    public function removeBySku($sku);
}
