<?php
declare(strict_types=1);

namespace Ziffity\AdditionalCost\Plugin;

use Ziffity\AdditionalCost\Model\Config;
use Magento\Checkout\Model\Session;

class Method
{

    /**
     * @var Config
     */
    protected $config;

    /**
     * @var Session
     */
    protected $checkoutSession;

    /**
     * Undocumented function
     *
     * @param Config $config
     * @param Session $checkoutSession
     */
    public function __construct(
        Config $config,
        Session $checkoutSession
    ) {
        $this->config = $config;
        $this->checkoutSession = $checkoutSession;
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
                $price +=  $finalPrice;
            }
        }

        return $price;
    }

    /**
     * Get Product Qty By AttributeSet Id in Basket
     *
     * @param int $attributeSetId
     * @return int
     */
    public function getProductQtyByAttributeId($attributeSetId) : int
    {
        $allItems = $this->checkoutSession->getQuote()->getAllItems();
        $qty = 0;
        foreach($allItems as $item)
        {
            $product = $item->getProduct();
            if((int)$product->getAttributeSetId() === $attributeSetId) {
                $qty += (int)$item->getQty();
            }
        }

       return $qty;
    }
}
