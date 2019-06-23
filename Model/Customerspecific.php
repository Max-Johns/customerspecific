<?php
namespace Nexgento\Customerspecific\Model;

class Customerspecific extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Nexgento\Customerspecific\Model\ResourceModel\Customerspecific');
    }
}
?>