# Test webhook locally
```
php artisan serve
full_path\stripe.exe login
full_path\stripe.exe listen --forward-to http://127.0.0.1:8000/stripe/webhook
full_path\stripe.exe trigger payment_intent.succeeded --add payment_intent:metadata.order_id=1
```
