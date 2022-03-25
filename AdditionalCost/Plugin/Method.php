<?php
declare(strict_types=1);

namespace Ziffity\AdditionalCost\Plugin;

use Ziffity\AdditionalCost\Model\Config as AdditonalCostConfig;
use Magento\Checkout\Model\Cart;

class Method
{

    /**
     * @var Config
     */
    protected $config;

    /**
     * @var Cart
     */
    protected $cart;

    /**
     * @param OptionFactory $optionFactory
     */
    public function __construct(
        AdditonalCostConfig $config,
        Cart $cart
    ) {
        $this->config = $config;
        $this->cart = $cart;
    }

    /**
     * Round shipping carrier's method price
     *
     * @param string|float|int $price
     * @return $this
     */
    public function beforeSetPrice($subject, $price)
    {

        if ($this->config->isEnabled()) {
            $finalPrice = 0;
            $additionCost = $this->config->getAdditionalCost();
            $attributeSetId = $this->config->getAttributeSetId();
            if (isset($attributeSetId) && ($additionCost > 0)) {
                $totalQty = $this->getProductQtyByAttributeId($attributeSetId);
                $finalPrice = $totalQty > 0 ? $totalQty * $additionCost : $finalPrice;
                $price = $price + $finalPrice;
            }            
        }

        return $price;
    }

    /**
     * Get Product QTy By AttributeSet Id in Basket
     *
     * @param int $attributeSetId
     * @return int
     */
    public function getProductQtyByAttributeId($attributeSetId) : int
    {
        $cartItems = $this->cart->getQuote()->getAllItems();
        $qty = 0;
        foreach($cartItems as $item)
        {
            $product = $item->getProduct();      
            if($product->getAttributeSetId() == $attributeSetId) {
                $qty++;
            }
        }
    
       return $qty;
    }
}
