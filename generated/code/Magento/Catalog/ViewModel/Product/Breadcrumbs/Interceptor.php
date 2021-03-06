<?php
namespace Magento\Catalog\ViewModel\Product\Breadcrumbs;

/**
 * Interceptor class for @see \Magento\Catalog\ViewModel\Product\Breadcrumbs
 */
class Interceptor extends \Magento\Catalog\ViewModel\Product\Breadcrumbs implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Catalog\Helper\Data $catalogData, \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig, \Magento\Framework\Escaper $escaper, \Magento\Framework\Serialize\Serializer\JsonHexTag $jsonSerializer)
    {
        $this->___init();
        parent::__construct($catalogData, $scopeConfig, $escaper, $jsonSerializer);
    }

    /**
     * {@inheritdoc}
     */
    public function getCategoryUrlSuffix()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getCategoryUrlSuffix');
        if (!$pluginInfo) {
            return parent::getCategoryUrlSuffix();
        } else {
            return $this->___callPlugins('getCategoryUrlSuffix', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function isCategoryUsedInProductUrl() : bool
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'isCategoryUsedInProductUrl');
        if (!$pluginInfo) {
            return parent::isCategoryUsedInProductUrl();
        } else {
            return $this->___callPlugins('isCategoryUsedInProductUrl', func_get_args(), $pluginInfo);
        }
    }
}
