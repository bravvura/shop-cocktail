<?php
namespace MagePal\GmailSmtpApp\Block\Adminhtml\System\Config\TestButton;

/**
 * Interceptor class for @see \MagePal\GmailSmtpApp\Block\Adminhtml\System\Config\TestButton
 */
class Interceptor extends \MagePal\GmailSmtpApp\Block\Adminhtml\System\Config\TestButton implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Template\Context $context, array $data = [])
    {
        $this->___init();
        parent::__construct($context, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function render(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'render');
        if (!$pluginInfo) {
            return parent::render($element);
        } else {
            return $this->___callPlugins('render', func_get_args(), $pluginInfo);
        }
    }
}
