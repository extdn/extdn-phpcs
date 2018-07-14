# Rule: Do not inject the Object Manager
## Background
The Object Manager should never be injected as a dependency into a class constructor. Injecting the Object Manager directly bypasses the DI mechanism that Magento makes flexible. Therefore, injecting the Object Manager in any kind of class is a code smell that leads to inflexibility.

## Reasoning
Whenever the Object Manager is directly injected into the constructor, it should be refactored into something else. 

## How it works
This rule uses PHP Reflection to determine the constructor arguments of a parsed class. If one of the arguments contains the word `ObjectManager`, the rule gives a warning.

However, if the parsed class matches one of the following circumstances, the rule is bypassed:
- When the class has a namespace that contains `/Test/`, indicating a test-class;
- When the class has a name ending with `Factory`, `Proxy` or `Builder`;

## How to fix
If there is a match with this rule, the class constructor needs to be refactored so that dependencies are injected directly as a constructor argument, instead of via the Object Manager. Alternatively, this class needs to be created via a `Factory` class so that the `Factory` is able to use the Object Manager as needed.