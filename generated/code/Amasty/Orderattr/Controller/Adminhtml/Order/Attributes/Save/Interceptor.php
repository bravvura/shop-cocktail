<?php
namespace Amasty\Orderattr\Controller\Adminhtml\Order\Attributes\Save;

/**
 * Interceptor class for @see \Amasty\Orderattr\Controller\Adminhtml\Order\Attributes\Save
 */
class Interceptor extends \Amasty\Orderattr\Controller\Adminhtml\Order\Attributes\Save implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Amasty\Orderattr\Model\Entity\EntityResolver $entityResolver, \Amasty\Orderattr\Model\Value\Metadata\FormFactory $metadataFormFactory, \Magento\Sales\Api\OrderRepositoryInterface $orderRepository, \Amasty\Orderattr\Model\Entity\Handler\Save $saveHandler)
    {
        $this->___init();
        parent::__construct($context, $entityResolver, $metadataFormFactory, $orderRepository, $saveHandler);
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
