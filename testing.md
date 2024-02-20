# AAA "Mantra": Arrange, Act, Assert
One of the most common ways to write tests is to divide any function into three fazes, and they all start with an "A" letter. It's a "AAA". You can call it a framework: Arrange, Act, Assert. In most cases, you should stick to this plan for every function in your test.

## Arrange
Add any data you need, any configuration. Build the scenario.

```php
public function test_homepage_contains_non_empty_table(): void
{
    /** Arrange **/
    Product::create([ 
        'name'  => 'Product 1',
        'price' => 123,
    ]); 
    /*************/

    $response = $this->get('/products');
 
    $response->assertStatus(200);
    $response->assertDontSee(__('No products found'));
}
```
