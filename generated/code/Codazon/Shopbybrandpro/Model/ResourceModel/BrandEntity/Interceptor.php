<?php
namespace Codazon\Shopbybrandpro\Model\ResourceModel\BrandEntity;

/**
 * Interceptor class for @see \Codazon\Shopbybrandpro\Model\ResourceModel\BrandEntity
 */
class Interceptor extends \Codazon\Shopbybrandpro\Model\ResourceModel\BrandEntity implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Eav\Model\Entity\Context $context, \Magento\Store\Model\StoreManagerInterface $storeManager, \Codazon\Shopbybrandpro\Model\Factory $modelFactory, $data = [])
    {
        $this->___init();
        parent::__construct($context, $storeManager, $modelFactory, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function save(\Magento\Framework\Model\AbstractModel $object)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'save');
        if (!$pluginInfo) {
            return parent::save($object);
        } else {
            return $this->___callPlugins('save', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function delete($object)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'delete');
        if (!$pluginInfo) {
            return parent::delete($object);
        } else {
            return $this->___callPlugins('delete', func_get_args(), $pluginInfo);
        }
    }
}