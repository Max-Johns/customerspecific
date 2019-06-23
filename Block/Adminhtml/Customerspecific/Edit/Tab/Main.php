<?php

namespace Nexgento\Customerspecific\Block\Adminhtml\Customerspecific\Edit\Tab;

/**
 * Customerspecific edit form main tab
 */
class Main extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @var \Nexgento\Customerspecific\Model\Status
     */
    protected $_status;

    protected $customerspecificgrid;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Nexgento\Customerspecific\Block\Adminhtml\Customerspecific\Grid $customerspecificgrid,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        \Nexgento\Customerspecific\Model\Status $status,
        array $data = []
    ) {
        $this->_systemStore = $systemStore;
        $this->_status = $status;
        $this->customerspecificgrid = $customerspecificgrid;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form
     *
     * @return $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareForm()
    {
        /* @var $model \Nexgento\Customerspecific\Model\BlogPosts */
        $model = $this->_coreRegistry->registry('customerspecific');

        $isElementDisabled = false;

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $form->setHtmlIdPrefix('page_');

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Item Information')]);

        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', ['name' => 'id']);
        }

						
						
        $fieldset->addField(
            'customerid',
            'select',
            [
                'label' => __('Customer IDs'),
                'title' => __('Customer IDs'),
                'name' => 'customerid',
				
                'options' => $this->customerspecificgrid->getOptionArray0(),
                // 'options' => \Nexgento\Customerspecific\Block\Adminhtml\Customerspecific\Grid::getOptionArray0(),
                'disabled' => $isElementDisabled
            ]
        );
						
											
        $fieldset->addField(
            'productids',
            'multiselect',
            [
                'label' => __('Product Ids'),
                'title' => __('Product Ids'),
                'name' => 'productids[]',
				
                'values' => $this->customerspecificgrid->getValueArray1(),
                'disabled' => $isElementDisabled
            ]
        );
						

        if (!$model->getId()) {
            $model->setData('is_active', $isElementDisabled ? '0' : '1');
        }

        $form->setValues($model->getData());
        $this->setForm($form);
		
        return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabLabel()
    {
        return __('Item Information');
    }

    /**
     * Prepare title for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle()
    {
        return __('Item Information');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
    
    public function getTargetOptionArray(){
    	return array(
    				'_self' => "Self",
					'_blank' => "New Page",
    				);
    }
}
