
## Ziffity Additional Cost Module  
This module sets the additional cost for every product specific of an attribute set as per configure from admin configuration.

## Installation

To install the module use the following commands:
```
php bin/magento module:enable Ziffity_AdditionalCost
php bin/magento setup:upgrade
php bin/magento setup:di:compile
php bin/magento cache:flush
```

## Admin Configuration

Stores->Configurations->ADDITIONAL SHIPPING COST-> Additional Cost

#### Fields

1. Enable
2. Choose Attribute Set
3. Additional Cost

![screenshot-magento236p1 local-2022 03 25-15_01_01](https://user-images.githubusercontent.com/6420794/160099683-1263f3b7-0da8-407d-aab8-218d39e8703b.png)
