<?php
namespace Magento\Payment\Block\Info\Cc;

/**
 * Interceptor class for @see \Magento\Payment\Block\Info\Cc
 */
class Interceptor extends \Magento\Payment\Block\Info\Cc implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\Template\Context $context, \Magento\Payment\Model\Config $paymentConfig, array $data = [])
    {
        $this->___init();
        parent::__construct($context, $paymentConfig, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function toPdf()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'toPdf');
        if (!$pluginInfo) {
            return parent::toPdf();
        } else {
            return $this->___callPlugins('toPdf', func_get_args(), $pluginInfo);
        }
    }
}
