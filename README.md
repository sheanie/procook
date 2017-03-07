**Tech test for Procook.**

Required to complete the following test.

**Tech test spec:**

Use the below API to get Amazon orders and their items.
http://docs.developer.amazonservices.com/en_UK/orders-2013-09-01/Orders_Overview.html

Use Amazon's PHP library
https://developer.amazonservices.co.uk/doc/orders/orders/v20130901/php.html

Store this information in a MySQL database.

Two tables

Example table structure:

amazon_mws_orders // this one to store orders
amo_uid // unique id auto increment
all other fields start with amo

amazon_mws_items // this one to store order items
ami_uid // unique id auto increment
all other fields start with ami

The following needs to be stored for orders:

AmazonOrderId
PurchaseDate
OrderStatus
FulfillmentChannel
OrderTotal
OrderTotalCurrency
BuyerName
BuyerEmail
ShipmentServiceLevelCategory
OrderType
ShippingAddressName
ShippingAddressLine1
ShippingAddressLine2
ShippingAddressLine3
ShippingAddressCity
ShippingAddressCounty
ShippingAddressDistrict
ShippingAddressStateOrRegion
ShippingAddressPostalCode
ShippingAddressCountryCode
ShippingAddressPhone
IsPrime

The following needs to be stored for the order items:

ASIN
SellerSKU
Title
QuantityOrdered
ItemPriceValue
ItemPriceCurrrency
ShippingPriceValue
ShippingPriceCurrrency


The two scripts to look at are:

1) ListOrdersSample.php
Uncomment serviceUrl for Europe
Uncomment $service = new MarketplaceWebServiceOrders_Mock(); in ListOrdersSample.php and it works fine without the credentials.
Ignore the comments:  
* Gets competitive pricing and related information for a product identified by
  
* the MarketplaceId and ASIN.
Uncomment $request->setSellerId(MERCHANT_ID);
Try setting the order status to Unshipped and the CreatedAfter to after 18/07/2016
They have nothing to do with this script. I'm not sure why they are in there. A mistake I think.
Print the response to screen and investigate the structure.
You will see that the structure is made up of objects and arrays.
You can find classes to access the data from these objects in MWSOrdersPHPClientLibrary\src\MarketplaceWebServiceOrders\Model\

2) ListOrderItemsSample.php

**Code walk through**

Sample API responses stored in data directory.  Mock client will serve these responses to the Amazon service.  

