<?php
namespace Codazon\ThemeLayoutPro\Model\ResourceModel\Attribute;

/**
 * Interceptor class for @see \Codazon\ThemeLayoutPro\Model\ResourceModel\Attribute
 */
class Interceptor extends \Codazon\ThemeLayoutPro\Model\ResourceModel\Attribute implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Model\ResourceModel\Db\Context $context, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\Eav\Model\ResourceModel\Entity\Type $eavEntityType, \Magento\Eav\Model\Config $eavConfig, $connectionName = null)
    {
        $this->___init();
        parent::__construct($context, $storeManager, $eavEntityType, $eavConfig, $connectionName);
    }

    /**
     * {@inheritdoc}
     */
    public function getStoreLabelsByAttributeId($attributeId)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getStoreLabelsByAttributeId');
        if (!$pluginInfo) {
            return parent::getStoreLabelsByAttributeId($attributeId);
        } else {
            return $this->___callPlugins('getStoreLabelsByAttributeId', func_get_args(), $pluginInfo);
        }
    }
}
