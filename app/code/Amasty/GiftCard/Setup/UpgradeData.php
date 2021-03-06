<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2020 Amasty (https://www.amasty.com)
 * @package Amasty_GiftCard
 */


namespace Amasty\GiftCard\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;

class UpgradeData implements UpgradeDataInterface
{
    /**
     * @var Operation\UpdateDataTo200
     */
    private $updateDataTo200;

    /**
     * @var Operation\UpdateDataTo210
     */
    private $updateDataTo210;

    public function __construct(
        Operation\UpdateDataTo200 $updateDataTo200,
        Operation\UpdateDataTo210 $updateDataTo210
    ) {
        $this->updateDataTo200 = $updateDataTo200;
        $this->updateDataTo210 = $updateDataTo210;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        if ($context->getVersion() && version_compare($context->getVersion(), '2.0.0', '<')) {
            $this->updateDataTo200->upgrade($setup);
        }
        if ($context->getVersion() && version_compare($context->getVersion(), '2.0.0', '>=')
            && version_compare($context->getVersion(), '2.1.0', '<')
        ) {
            $this->updateDataTo210->upgrade($setup);
        }
    }
}
