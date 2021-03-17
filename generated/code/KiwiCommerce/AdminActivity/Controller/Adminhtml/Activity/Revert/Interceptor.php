<?php
namespace KiwiCommerce\AdminActivity\Controller\Adminhtml\Activity\Revert;

/**
 * Interceptor class for @see \KiwiCommerce\AdminActivity\Controller\Adminhtml\Activity\Revert
 */
class Interceptor extends \KiwiCommerce\AdminActivity\Controller\Adminhtml\Activity\Revert implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory, \KiwiCommerce\AdminActivity\Model\Processor $processor)
    {
        $this->___init();
        parent::__construct($context, $resultJsonFactory, $processor);
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
