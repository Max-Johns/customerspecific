<?php

namespace Nexgento\Customerspecific\Block\Index;

use Magento\Catalog\Model\Product;

class Index extends \Magento\Framework\View\Element\Template {

	protected $productcollection;
	protected $_customerSession;
	protected $customerspecific;

    public function __construct(
    	\Magento\Catalog\Block\Product\Context $context, 
    	Product $productcollection,
    	\Nexgento\Customerspecific\Model\Customerspecific $customerspecific,
    	\Magento\Customer\Model\SessionFactory  $customerSession,
    	array $data = []
    ) {
    	$this->_product = $productcollection;
    	$this->_customerSession = $customerSession;
    	$this->customerspecific = $customerspecific;
        parent::__construct($context, $data);

    }


    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        if ($this->getCustomCollection()) {
            $pager = $this->getLayout()->createBlock(
                'Magento\Theme\Block\Html\Pager',
                'custom.history.pager'
            )->setAvailableLimit([10 => 10, 20 => 20, 30 => 30, 40 => 40])
                ->setShowPerPage(true)->setCollection(
                    $this->getCustomCollection()
                );
            $this->setChild('pager', $pager);
            $this->getCustomCollection()->load();
        }
        return $this;
    }
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }
    public function getCustomCollection()
    {
        $page = ($this->getRequest()->getParam('p')) ? $this->getRequest()->getParam('p') : 1;
        $pageSize = ($this->getRequest()->getParam('limit')) ? $this->getRequest(
            
        )->getParam('limit') : 10;;
        $id =  $this->_customerSession->create()->getCustomerId();
        $customerspecificCollection = $this->customerspecific->load($id,'customerid');
        $productids = $customerspecificCollection->getProductids();
        // echo "<pre>";print_r($productids);die();
        $pids = explode(',', $productids);
        $collection = $this->_product->getCollection()->addFieldToFilter('entity_id',array('in'=>$pids));

        $sku = $this->getRequest()->getPost('sku');
        if($sku){
			$collection->addFieldToFilter('sku',array('like'=>"%".$sku."%"));
		}
        $collection->setPageSize($pageSize);
        $collection->setCurPage($page);
        return $collection;
    }

    public function getProduct($id){
    	return $this->_product->load($id);
    }

}