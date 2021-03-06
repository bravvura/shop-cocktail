<?php
/**
 * Copyright © 2017 Codazon, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Codazon\ThemeLayoutPro\Controller\Adminhtml;

use Magento\Config\Controller\Adminhtml\System\ConfigSectionChecker;

/**
 * System Configuration Abstract Controller
 */
abstract class ConfigAbstract extends \Magento\Backend\App\AbstractAction
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Magento_Config::config';

    /**
     * @var \Magento\Config\Model\Config\Structure
     */
    protected $_configStructure;

    /**
     * @var ConfigSectionChecker
     */
    protected $_sectionChecker;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Config\Model\Config\Structure $configStructure
     * @param ConfigSectionChecker $sectionChecker
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Codazon\ThemeLayoutPro\Model\Config\Structure $configStructure,
        ConfigSectionChecker $sectionChecker
    ) {
        parent::__construct($context);
        $this->_configStructure = $configStructure;
        $this->_sectionChecker = $sectionChecker;
    }

    /**
     * Check if current section is found and is allowed
     *
     * @param \Magento\Framework\App\RequestInterface $request
     * @return \Magento\Framework\App\ResponseInterface
     */
    public function dispatch(\Magento\Framework\App\RequestInterface $request)
    {
        // if (!$request->getParam('section')) {
            // $request->setParam('section', $this->_configStructure->getFirstSection()->getId());
        // }
        return parent::dispatch($request);
    }

    /**
     * Check is allow modify system configuration
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        // $sectionId = $this->_request->getParam('section');
        // return parent::_isAllowed()
            // || $this->_configStructure->getElement($sectionId)->isAllowed();
            return true;
    }

    /**
     * Save state of configuration field sets
     *
     * @param array $configState
     * @return bool
     */
    protected function _saveState($configState = [])
    {
        if (is_array($configState)) {
            $configState = $this->sanitizeConfigState($configState);
            $adminUser = $this->_auth->getUser();
            $extra = $adminUser->getExtra();
            if (!is_array($extra)) {
                $extra = [];
            }
            if (!isset($extra['configState'])) {
                $extra['configState'] = [];
            }
            foreach ($configState as $fieldset => $state) {
                $extra['configState'][$fieldset] = $state;
            }
            $adminUser->saveExtra($extra);
        }
        return true;
    }

    /**
     * Sanitize config state data
     *
     * @param array $configState
     * @return array
     * @SuppressWarnings(PHPMD.UnusedLocalVariable)
     */
    protected function sanitizeConfigState($configState)
    {
        $sectionList = $this->_configStructure->getSectionList();
        $sanitizedConfigState = $configState;
        foreach ($configState as $sectionId => $value) {
            if (array_key_exists($sectionId, $sectionList)) {
                $sanitizedConfigState[$sectionId] = (bool)$sanitizedConfigState[$sectionId] ? '1' : '0';
            } else {
                unset($sanitizedConfigState[$sectionId]);
            }
        }
        return $sanitizedConfigState;
    }
}
