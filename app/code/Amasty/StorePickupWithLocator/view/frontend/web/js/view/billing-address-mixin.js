/**
 * Billing address view mixin for restrict billing address copy from shipping
 */
define([
    'Amasty_StorePickupWithLocator/js/model/pickup',
    'Amasty_StorePickupWithLocator/js/model/pickup/pickup-data-resolver'
], function (pickup, pickupDataResolver) {
    'use strict';

    return function (billingAddress) {
        return billingAddress.extend({
            initObservable: function () {
                this._super();

                this.isAddressSameAsShipping.subscribe(this.billingSameAsShippingObserver, this);
                pickup.isPickup.subscribe(this.pickupStateObserver, this);
                pickupDataResolver.storeId.subscribe(this.pickupStateObserver, this);
                this.currentBillingAddress.subscribe(this.billingAddressSubscriber, this);

                return this;
            },

            /**
             * Restrict copy billing from shipping while pickup is selected
             *
             * @param {Boolean} state
             */
            billingSameAsShippingObserver: function (state) {
                if (state && pickup.isPickup()) {
                    this.isAddressSameAsShipping(false);
                }
            },

            /**
             * Mark view model to not be able to copy shipping while pickup is selected.
             * note: this method processing several times if billing address for each payment
             *       do not modify quote billing address from here for avoid high load
             */
            pickupStateObserver: function () {
                if (pickup.isPickup() && pickupDataResolver.storeId()) {
                    this.isAddressSameAsShipping(false);
                    if (this.currentBillingAddress() === null) {
                        this.editAddress();
                    }
                }
            },

            /**
             * Avoid hidden empty billing address with disabled place button
             *
             * @param {Object} address
             */
            billingAddressSubscriber: function (address) {
                if (address === null && pickup.isPickup() && pickupDataResolver.storeId()) {
                    this.editAddress();
                }
            }
        });
    };
});
