# Mbiz_Cc

Manage store credit cards.

## Events

*   `cc_validate_before`: dispatched before the validation. Use this event to add the data `token` to the credit card according to your payment system. You can also throw an exception `Mbiz_Cc_Exception` to stop the addition and tell something in error to the customer.

