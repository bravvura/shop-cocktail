var config = {
    config: {
        mixins: {
            'Magento_Checkout/js/view/shipping': {
                'Amasty_StorePickupWithLocator/js/view/shipping-mixin': true
            },
            'Magento_Checkout/js/view/shipping-information': {
                'Amasty_StorePickupWithLocator/js/view/shipping-information-mixin': true
            },
            'Magento_Checkout/js/model/shipping-save-processor/payload-extender': {
                'Amasty_StorePickupWithLocator/js/model/shipping-save-processor/payload-extender-mixin': true
            },
            "Magento_Checkout/js/view/shipping-address/list": {
                'Amasty_StorePickupWithLocator/js/view/shipping-address/list-mixin': true
            },
            'Magento_Checkout/js/view/billing-address': {
                'Amasty_StorePickupWithLocator/js/view/billing-address-mixin': true
            },
            'Magento_Checkout/js/model/shipping-rates-validator': {
                'Amasty_StorePickupWithLocator/js/model/shipping-rates-validator-mixin': true
            },
            'Magento_Checkout/js/model/shipping-service': {
                'Amasty_StorePickupWithLocator/js/model/shipping-service-mixin': true
            },
            'Magento_Checkout/js/action/select-shipping-address': {
                'Amasty_StorePickupWithLocator/js/action/select-shipping-address-mixin': true
            },
            'Magento_Checkout/js/action/select-billing-address': {
                'Amasty_StorePickupWithLocator/js/action/select-billing-address-mixin': true
            },
            'Klarna_Kp/js/model/klarna': {
                'Amasty_StorePickupWithLocator/js/model/klarna-mixin': true
            }
        }
    }
};
