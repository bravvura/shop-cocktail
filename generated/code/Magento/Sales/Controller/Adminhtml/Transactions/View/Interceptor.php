<?php
namespace Magento\Sales\Controller\Adminhtml\Transactions\View;

/**
 * Interceptor class for @see \Magento\Sales\Controller\Adminhtml\Transactions\View
 */
class Interceptor extends \Magento\Sales\Controller\Adminhtml\Transactions\View implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\Registry $coreRegistry, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \Magento\Framework\View\Result\LayoutFactory $resultLayoutFactory, \Magento\Sales\Api\OrderPaymentRepositoryInterface $orderPaymentRepository)
    {
        $this->___init();
        parent::__construct($context, $coreRegistry, $resultPageFactory, $resultLayoutFactory, $orderPaymentRepository);
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
