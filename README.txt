## Customer Specific Product

This module provide the customer specific products for Magento 2

#### Install:

From Magento2 root dir:

bin/magento setup:upgrade
bin/magento cache:flush
```

also, if in production mode:
```bash
bin/magento setup:static-content:deploy
```

#### Usage

Go to Customerspecific -> Customerspecific 

Admin can create the customer specific products from admin. There is option to assign the multiple products to single customer. You can also assign same product to multiple customer as well.

Customer can see own product on customer dashboard under "Customer Specific" tab. Customer can see the all products with pagination, search option is also there with SKU. 