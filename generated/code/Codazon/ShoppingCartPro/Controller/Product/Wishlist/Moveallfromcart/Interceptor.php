<?php
namespace Codazon\ShoppingCartPro\Controller\Product\Wishlist\Moveallfromcart;

/**
 * Interceptor class for @see \Codazon\ShoppingCartPro\Controller\Product\Wishlist\Moveallfromcart
 */
class Interceptor extends \Codazon\ShoppingCartPro\Controller\Product\Wishlist\Moveallfromcart implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Magento\Customer\Model\Session $customerSession, \Magento\Framework\View\Result\LayoutFactory $resultLayoutFactory, \Magento\Wishlist\Controller\WishlistProviderInterface $wishlistProvider, \Magento\Wishlist\Helper\Data $wishlistHelper, \Magento\Checkout\Model\Cart $cart, \Magento\Checkout\Helper\Cart $cartHelper, \Magento\Framework\Escaper $escaper, \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator)
    {
        $this->___init();
        parent::__construct($context, $customerSession, $resultLayoutFactory, $wishlistProvider, $wishlistHelper, $cart, $cartHelper, $escaper, $formKeyValidator);
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
