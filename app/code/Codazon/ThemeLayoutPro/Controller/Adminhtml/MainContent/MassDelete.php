<?php
/**
 *
 * Copyright © 2018 Codazon, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Codazon\ThemeLayoutPro\Controller\Adminhtml\MainContent;

use Magento\Backend\App\Action;
use Magento\Framework\App\Filesystem\DirectoryList;

class MassDelete extends \Codazon\ThemeLayoutPro\Controller\Adminhtml\MassDeleteAbstract
{
    protected $primary = 'entity_id';
    
    protected $modelClass = 'Codazon\ThemeLayoutPro\Model\MainContent';
    
    protected $successText = 'Your selected items have been deleted.';
}
