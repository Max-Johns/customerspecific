<?php
namespace Nexgento\Customerspecific\Block\Adminhtml\Customerspecific\Edit;

/**
 * Admin page left menu
 */
class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('customerspecific_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Customerspecific Information'));
    }
}