<?php
declare(strict_types=1);

namespace Ziffity\AdditionalCost\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;

class Config
{
    /**
     * @var string
     */
    public const XML_ADDITIONAL_COST_MODULE_ENABLED = 'additional_cost/additionalcost/active';

    /**
     * @var string
     */
    public const XML_ATTRIBUTESET_ID = 'additional_cost/additionalcost/attribute_set_id';

    /**
     * @var string
     */
    public const XML_ADDITIONAL_SHIPPING_PRICE = 'additional_cost/additionalcost/cost';

    /**
     * @var bool
     */
    public $isEnabled;

     /**
     * @var int
     */
    public $attributeSetId;

     /**
     * @var bool
     */
    public $attributeSetPrice;

    /*
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {   
        if (!$this->isEnabled) {
            $this->isEnabled = $this->scopeConfig->isSetFlag(self::XML_ADDITIONAL_COST_MODULE_ENABLED);
        }

        return $this->isEnabled;        
    }

    /**
     * @return string
     */
    public function getAdditionalCost(): string
    {
        if (!$this->attributeSetPrice) {
            $this->attributeSetPrice = (string) $this->scopeConfig->getValue(self::XML_ADDITIONAL_SHIPPING_PRICE);
        }

        return $this->attributeSetPrice;
    }

    /**
     * @return string
     */
    public function getAttributeSetId(): int
    {

        if (!$this->attributeSetId) {
           return $attributeSetId = (int) $this->scopeConfig->getValue(self::XML_ATTRIBUTESET_ID);
        }

        return $this->attributeSetId;
    }
}
