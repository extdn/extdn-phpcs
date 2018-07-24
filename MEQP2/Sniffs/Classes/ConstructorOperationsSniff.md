# Rule: Only DI operations are allowed in constructor
## Background
In Magento 2, the PHP constructor of a class is used to inject dependencies: Constructor-based Dependency Injection (DI).
Because the constructor its purpose is to inject dependencies, other operations (or other logic) should not be part of the
constructor.

## Reasoning
The constructor should only assign the values of constructor arguments to internal variables, like shown below:

```php
class Foo
{
    private $bar;

    public function __construct(
        Bar $bar
    ) {
        $this->bar = $bar;
    }
}
```

Any other logic than these dependency assignment operators should be excluded from the constructor. Having additional logic in
the constructor makes it harder to debug and test the class.

## How it works
This rule checks the constructor code to see if any other operators than `a + b` is used. If so, a warning is generated.

## How to fix
Move other logic to another method. In some cases, this could be `init()` or `_construct()` method that is already created by
Magento for this purpose. Otherwise, you will need to create such a method yourself. Alternatively, try to add additional
constructor arguments (like boolean flags) to add configurable behaviour to your class.
