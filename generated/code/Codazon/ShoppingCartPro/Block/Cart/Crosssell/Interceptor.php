<?php
namespace Codazon\ShoppingCartPro\Block\Cart\Crosssell;

/**
 * Interceptor class for @see \Codazon\ShoppingCartPro\Block\Cart\Crosssell
 */
class Interceptor extends \Codazon\ShoppingCartPro\Block\Cart\Crosssell implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Catalog\Block\Product\Context $context, \Magento\Checkout\Model\Session $checkoutSession, \Magento\Catalog\Model\Product\Visibility $productVisibility, \Magento\Catalog\Model\Product\LinkFactory $productLinkFactory, \Magento\Quote\Model\Quote\Item\RelatedProducts $itemRelationsList, \Magento\CatalogInventory\Helper\Stock $stockHelper, array $data = [])
    {
        $this->___init();
        parent::__construct($context, $checkoutSession, $productVisibility, $productLinkFactory, $itemRelationsList, $stockHelper, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function getImage($product, $imageId, $attributes = [])
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getImage');
        if (!$pluginInfo) {
            return parent::getImage($product, $imageId, $attributes);
        } else {
            return $this->___callPlugins('getImage', func_get_args(), $pluginInfo);
        }
    }
}
