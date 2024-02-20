## Unit Tests vs Feature Tests
Feature tests: are for most of the tests of the site/app, it is page content, notifications, and anything that has visible/viewable content.

Unit tests: are for inside mechanisms: actions, helpers, services, etc, that are not reachable by any route, but play their role inside - like currency converters, pdf generators, webhook parsers, routers, etc.

## AAA "Mantra": Arrange, Act, Assert
One of the most common ways to write tests is to divide any function into three fazes, and they all start with an "A" letter. It's a "AAA". You can call it a framework: Arrange, Act, Assert. In most cases, you should stick to this plan for every function in your test.

### Arrange
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

### Act
This is usually calling some API, calling some function, calling some URL. So, simulate the actual action of the user like you would be behind the browser doing the same thing.

```php
public function test_homepage_contains_non_empty_table(): void
{
    Product::create([
        'name'  => 'Product 1',
        'price' => 123,
    ]);

    /** Act **/
    $response = $this->get('/products'); 
    /*********/

    $response->assertStatus(200);
    $response->assertDontSee(__('No products found'));
}
```

### Assert
There can be multiple assertions. For example, we can assert the status, assert don't see some text, and also assert see the name of the product.

```php
public function test_homepage_contains_non_empty_table(): void
{
    Product::create([
        'name'  => 'Product 1',
        'price' => 123,
    ]);
 
    $response = $this->get('/products');

    /** Assert **/
    $response->assertStatus(200); 
    $response->assertDontSee(__('No products found'));
    $response->assertSee('Product 1');
    /************/
}
```

Typically, there are multiple things for an arranged scenario, or it could be none. Then, there is usually one call for the action. And then there are multiple assertions. With multiple assertions, you shouldn't over-push on the assertions because you may bump into testing different scenarios. So it should be sometimes a different test.
