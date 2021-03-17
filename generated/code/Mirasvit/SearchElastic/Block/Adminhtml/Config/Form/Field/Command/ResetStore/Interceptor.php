<?php
namespace Mirasvit\SearchElastic\Block\Adminhtml\Config\Form\Field\Command\ResetStore;

/**
 * Interceptor class for @see \Mirasvit\SearchElastic\Block\Adminhtml\Config\Form\Field\Command\ResetStore
 */
class Interceptor extends \Mirasvit\SearchElastic\Block\Adminhtml\Config\Form\Field\Command\ResetStore implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Template\Context $context, array $data = [], ?\Magento\Framework\View\Helper\SecureHtmlRenderer $secureRenderer = null)
    {
        $this->___init();
        parent::__construct($context, $data, $secureRenderer);
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
