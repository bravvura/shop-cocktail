<?php
namespace Codazon\Shopbybrandpro\Controller\Index\Index;

/**
 * Interceptor class for @see \Codazon\Shopbybrandpro\Controller\Index\Index
 */
class Interceptor extends \Codazon\Shopbybrandpro\Controller\Index\Index implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Magento\Framework\Registry $coreRegistry, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \Codazon\Shopbybrandpro\Model\BrandFactory $brandFactory)
    {
        $this->___init();
        parent::__construct($context, $coreRegistry, $storeManager, $resultPageFactory, $brandFactory);
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
