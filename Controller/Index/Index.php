<?php

namespace Nexgento\Customerspecific\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
	protected $_session;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Customer\Model\Session $session)
	{
		$this->_session = $session;
		return parent::__construct($context);
	}

    public function execute()
    {
    	if ($this->_session->isLoggedIn()) {
	        $this->_view->loadLayout();
	        $this->_view->getLayout()->initMessages();
	        $this->_view->renderLayout();
	    } else {
	    	return $this->resultRedirectFactory->create()->setPath('customer/account/', ['_current' => true]);

	    }
    }
}