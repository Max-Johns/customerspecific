<?php

namespace Nexgento\Customerspecific\Model\ResourceModel\Customerspecific;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Nexgento\Customerspecific\Model\Customerspecific', 'Nexgento\Customerspecific\Model\ResourceModel\Customerspecific');
        $this->_map['fields']['page_id'] = 'main_table.page_id';
    }

}
?>