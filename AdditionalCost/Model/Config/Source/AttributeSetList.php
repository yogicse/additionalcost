<?php
namespace Ziffity\AdditionalCost\Model\Config\Source;

use Magento\Catalog\Model\Product\AttributeSet\Options;

class AttributeSetList implements \Magento\Framework\Data\OptionSourceInterface
{

    /**
     * @var Option
     */
    protected $option;

    /**
     * @param OptionFactory $optionFactory
     */
    public function __construct(Options $option)
    {
        $this->option = $option;
  
    }

    /**
     * Get all options
     *
     * @return array
     */
    public function toOptionArray() : array
    {
        return $this->option->toOptionArray();
    }
}