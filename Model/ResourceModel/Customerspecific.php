<?php
namespace Nexgento\Customerspecific\Model\ResourceModel;

class Customerspecific extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('customerspecific', 'id');
    }
}
?>