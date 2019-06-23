<?php
namespace Nexgento\Customerspecific\Block\Adminhtml\Customerspecific;

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * @var \Magento\Framework\Module\Manager
     */
    protected $moduleManager;

    /**
     * @var \Nexgento\Customerspecific\Model\customerspecificFactory
     */
    protected $_customerspecificFactory;

    /**
     * @var \Nexgento\Customerspecific\Model\Status
     */
    protected $_status;

    protected $customer;
    protected $products;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data $backendHelper
     * @param \Nexgento\Customerspecific\Model\customerspecificFactory $customerspecificFactory
     * @param \Nexgento\Customerspecific\Model\Status $status
     * @param \Magento\Framework\Module\Manager $moduleManager
     * @param array $data
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Nexgento\Customerspecific\Model\CustomerspecificFactory $CustomerspecificFactory,
        \Nexgento\Customerspecific\Model\Status $status,
        \Magento\Customer\Model\Customer $customer,
        \Magento\Catalog\Model\Product $products,
        \Magento\Framework\Module\Manager $moduleManager,
        array $data = []
    ) {
        $this->_customerspecificFactory = $CustomerspecificFactory;
        $this->_status = $status;
        $this->products = $products;
        $this->customer = $customer;
        $this->moduleManager = $moduleManager;
        parent::__construct($context, $backendHelper, $data);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('postGrid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(false);
        $this->setVarNameFilter('post_filter');
    }

    /**
     * @return $this
     */
    protected function _prepareCollection()
    {
        $collection = $this->_customerspecificFactory->create()->getCollection();
        $this->setCollection($collection);

        parent::_prepareCollection();

        return $this;
    }

    /**
     * @return $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareColumns()
    {
						
    	$this->addColumn(
    		'customerid',
    		[
    			'header' => __('Customer Name'),
    			'index' => 'customerid',
    			'type' => 'options',
                'options' => $this->getOptionArray0()
    		]
    	);

						
		
        //$this->addColumn(
            //'edit',
            //[
                //'header' => __('Edit'),
                //'type' => 'action',
                //'getter' => 'getId',
                //'actions' => [
                    //[
                        //'caption' => __('Edit'),
                        //'url' => [
                            //'base' => '*/*/edit'
                        //],
                        //'field' => 'id'
                    //]
                //],
                //'filter' => false,
                //'sortable' => false,
                //'index' => 'stores',
                //'header_css_class' => 'col-action',
                //'column_css_class' => 'col-action'
            //]
        //);
		

		
		   $this->addExportType($this->getUrl('customerspecific/*/exportCsv', ['_current' => true]),__('CSV'));
		   $this->addExportType($this->getUrl('customerspecific/*/exportExcel', ['_current' => true]),__('Excel XML'));

        $block = $this->getLayout()->getBlock('grid.bottom.links');
        if ($block) {
            $this->setChild('grid.bottom.links', $block);
        }

        return parent::_prepareColumns();
    }

	
    /**
     * @return $this
     */
    protected function _prepareMassaction()
    {

        $this->setMassactionIdField('id');
        //$this->getMassactionBlock()->setTemplate('Nexgento_Customerspecific::customerspecific/grid/massaction_extended.phtml');
        $this->getMassactionBlock()->setFormFieldName('customerspecific');

        $this->getMassactionBlock()->addItem(
            'delete',
            [
                'label' => __('Delete'),
                'url' => $this->getUrl('customerspecific/*/massDelete'),
                'confirm' => __('Are you sure?')
            ]
        );

        $statuses = $this->_status->getOptionArray();

        return $this;
    }
		

    /**
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('customerspecific/*/index', ['_current' => true]);
    }

    /**
     * @param \Nexgento\Customerspecific\Model\customerspecific|\Magento\Framework\Object $row
     * @return string
     */
    public function getRowUrl($row)
    {
		
        return $this->getUrl(
            'customerspecific/*/edit',
            ['id' => $row->getId()]
        );
		
    }


        public function getOptionArray0()
        {
            $customerCollection = $this->customer->getCollection();

            $data_array=array(); 
            foreach ($customerCollection as $_customer) {
			     $data_array[$_customer->getId()]=$_customer->getFirstname().' '.$_customer->getLastname();
                
            }
            return($data_array);
		}
		public function getValueArray0()
		{
            $data_array=array();
            foreach($this->getOptionArray0() as $k=>$v){
               $data_array[]=array('value'=>$k,'label'=>$v);		
			}
            return($data_array);

		}
		
		public function getOptionArray1()
		{
            $productCollection = $this->products->getCollection();
            $productCollection->addFieldToFilter('status',1);
            $productCollection->addFieldToFilter('visibility',array('neq'=>array('1')));
            $productCollection->addFieldToFilter('type_id','simple');
            $data_array=array(); 
            foreach ($productCollection as $_product) {
                $pro = $this->products->load($_product->getId());
                 $data_array[$_product->getId()] = $pro->getData('name');
            }
            return($data_array);
		}
		public function getValueArray1()
		{
            $data_array=array();
			foreach($this->getOptionArray1() as $k=>$v){
               $data_array[]=array('value'=>$k,'label'=>$v);		
			}
            return($data_array);

		}
		

}