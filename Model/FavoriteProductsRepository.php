<?php declare(strict_types = 1);

namespace VinaiKopp\FavoriteProducts\Model;

use VinaiKopp\FavoriteProducts\Api\FavoriteProductsRepositoryInterface;

class FavoriteProductsRepository implements FavoriteProductsRepositoryInterface
{
    /**
     * @var FavoriteProductsSession
     */
    private $session;

    public function __construct(FavoriteProductsSession $session)
    {
        $this->session = $session;
    }

    public function getSkus()
    {
        return $this->session->getFavoriteSkus();
    }

    public function addBySku($sku)
    {
        $this->session->addFavoriteSku($sku);
    }

    public function removeBySku($sku)
    {
        $this->session->removeFavoriteSku($sku);
    }
}
