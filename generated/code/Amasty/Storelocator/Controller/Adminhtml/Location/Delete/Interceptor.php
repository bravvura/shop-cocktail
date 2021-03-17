<?php
namespace Amasty\Storelocator\Controller\Adminhtml\Location\Delete;

/**
 * Interceptor class for @see \Amasty\Storelocator\Controller\Adminhtml\Location\Delete
 */
class Interceptor extends \Amasty\Storelocator\Controller\Adminhtml\Location\Delete implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\Registry $coreRegistry, \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \Magento\Framework\Filesystem $filesystem, \Magento\MediaStorage\Model\File\UploaderFactory $fileUploaderFactory, \Amasty\Base\Model\Serializer $serializer, \Magento\Framework\Filesystem\Io\File $ioFile, \Amasty\Storelocator\Model\Location $locationModel, \Psr\Log\LoggerInterface $logger, \Magento\Ui\Component\MassAction\Filter $filter, \Amasty\Storelocator\Model\ResourceModel\Location\Collection $locationCollection)
    {
        $this->___init();
        parent::__construct($context, $coreRegistry, $resultForwardFactory, $resultPageFactory, $filesystem, $fileUploaderFactory, $serializer, $ioFile, $locationModel, $logger, $filter, $locationCollection);
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
