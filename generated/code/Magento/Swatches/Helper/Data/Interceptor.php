<?php
namespace Magento\Swatches\Helper\Data;

/**
 * Interceptor class for @see \Magento\Swatches\Helper\Data
 */
class Interceptor extends \Magento\Swatches\Helper\Data implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory, \Magento\Catalog\Api\ProductRepositoryInterface $productRepository, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\Swatches\Model\ResourceModel\Swatch\CollectionFactory $swatchCollectionFactory, \Magento\Catalog\Model\Product\Image\UrlBuilder $urlBuilder, ?\Magento\Framework\Serialize\Serializer\Json $serializer = null, ?\Magento\Swatches\Model\SwatchAttributesProvider $swatchAttributesProvider = null, ?\Magento\Swatches\Model\SwatchAttributeType $swatchTypeChecker = null)
    {
        $this->___init();
        parent::__construct($productCollectionFactory, $productRepository, $storeManager, $swatchCollectionFactory, $urlBuilder, $serializer, $swatchAttributesProvider, $swatchTypeChecker);
    }

    /**
     * {@inheritdoc}
     */
    public function getProductMediaGallery(\Magento\Catalog\Model\Product $product) : array
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getProductMediaGallery');
        if (!$pluginInfo) {
            return parent::getProductMediaGallery($product);
        } else {
            return $this->___callPlugins('getProductMediaGallery', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function isSwatchAttribute(\Magento\Catalog\Model\ResourceModel\Eav\Attribute $attribute)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'isSwatchAttribute');
        if (!$pluginInfo) {
            return parent::isSwatchAttribute($attribute);
        } else {
            return $this->___callPlugins('isSwatchAttribute', func_get_args(), $pluginInfo);
        }
    }
}
