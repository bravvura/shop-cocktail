<?php
namespace Mirasvit\SearchElastic\Controller\Adminhtml\Command\Status;

/**
 * Interceptor class for @see \Mirasvit\SearchElastic\Controller\Adminhtml\Command\Status
 */
class Interceptor extends \Mirasvit\SearchElastic\Controller\Adminhtml\Command\Status implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Mirasvit\SearchElastic\SearchAdapter\Manager $manager, \Magento\Backend\App\Action\Context $context)
    {
        $this->___init();
        parent::__construct($manager, $context);
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