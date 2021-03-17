<?php
namespace Amasty\Orderattr\Controller\Adminhtml\Attribute\Edit;

/**
 * Interceptor class for @see \Amasty\Orderattr\Controller\Adminhtml\Attribute\Edit
 */
class Interceptor extends \Amasty\Orderattr\Controller\Adminhtml\Attribute\Edit implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Eav\Model\Config $eavConfig, \Amasty\Orderattr\Api\CheckoutAttributeRepositoryInterface $attributeRepository, \Magento\Framework\Registry $coreRegistry)
    {
        $this->___init();
        parent::__construct($context, $eavConfig, $attributeRepository, $coreRegistry);
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'execute');
        if (!$pluginInfo) {
            return parent::execute();
        } else {
            return $this->___callPlugins('execute', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function dispatch(\Magento\Framework\App\RequestInterface $request)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'dispatch');
        if (!$pluginInfo) {
            return parent::dispatch($request);
        } else {
            return $this->___callPlugins('dispatch', func_get_args(), $pluginInfo);
        }
    }
}
