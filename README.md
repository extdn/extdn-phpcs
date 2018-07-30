# ExtDN PHP_CodeSniffer rules for Magento 2

[![Build Status](https://travis-ci.org/extdn/extdn-phpcs.svg?branch=master)](https://travis-ci.org/extdn/extdn-phpcs)

### Introduction
There are already many PHP CodeSniffer rules out there to aid in Magento 2 development:
- Magento core ruleset (in folder `dev/tests/static/framework/Magento`)
- [Magento Extension Quality Program](https://github.com/magento/marketplace-eqp) (in short: MEQP)
- [Magento Expert Consultancy Group](https://github.com/magento-ecg/coding-standard) (in short: ECG)
- PSR-1, PSR-2, possibly PSR-12

However, some best practices still need to be integrated and/or some rules do need to be improved. This
repository forms an effort to come up with more advanced rulesets than there currently are. Additionally, one of the underlying goals is to create rules that fit Magento core, Magento third party extensions and Magento implements, while they all have different needs.

### Usage

To install this package, go to your Magento 2 root and use the following:

    composer require extdn/phpcs:dev-master

If this fails because the dependency with `magento/marketplace-eqp` fails to load, first add the EQP repo to your configuration and then repeat:

    composer config repositories.magento-marketplace-eqp vcs https://github.com/magento/marketplace-eqp
    composer require magento/marketplace-eqp:dev-master
    composer require extdn/phpcs:dev-master

Once installed, you can run PHPCS from the command-line to analyse your code `XYZ`:

    vendor/bin/phpcs --standard=./vendor/extdn/phpcs/Extdn app/code/XYZ
    vendor/bin/phpcs --standard=./vendor/extdn/phpcs/Extdn vendor/XYZ

## Where to contribute
We need help in the following areas:
- Documentation of existing EQP rules (where each EQP rule could be included in this repository its `ruleset.xml`)
- Creation of new PHPCS rules (see below **How to contribute**)
- Braindumps on where PHPCS lacks and other tools might come in more handy (PhpStan, Phan)
- Discussions on new rules (through periodic hangouts or discussions per GitHub Issue)

Please note that you are also welcome to contribute to the Magento rulesets directly (core, MEQP, ECG - see links above). The more rules can be created, the higher the quality can become.

## How to contribute

Any contribution is welcome. However, don't start coding just yet. Make sure first that the work is worth the effort.

1) Add a new issue under **Issues** to address new rulesets that are needed or report other issues.

2) Once the creation of the new rule has been accepted by adding a label `Accepted` under **Issues**, we're good to go.

3) If a similar rule already exists in the Magento ECG standards and/or Magento Marketplace standards, simply try to include this rule within the ExtDN ruleset.

4) If no rule exists yet, let's create it. As an example, you can use the `SetTemplateInBlockSniff` within the folder `Extdn/Sniffs/Blocks`. It can be tested upon a sample file under `Extdn/Samples/Blocks`:

```bash
vendor/bin/phpcs --standard=./vendor/extdn/phpcs/Extdn vendor/extdn/phpcs/Extdn/Samples
```

5) Once this all works, feel free to create a Pull Request (PR) including the addition of this rule to the `ruleset.xml` file.


### Using labels with GitHub issues
Some important labels, used for Github issues:

- `accepted`: The rule is accepted by extdn. If nobody claimed it yet, you may start working on it
- `experimental`: The rule can be implemented as well, but we will try it out with a low severity first before integrating it into the official ruleset
- `non-PHPCS`: The rule is not feasibly implementable with phpcs, will need additional tools. We keep it for later.
- `organizational`: Non-code related issues
- `on agenda of hangout`: The rule/issue will be discussed in the next community hangout

## How to create a Sniffer Rule
@todo: Fill in the gaps

## Testing
All rules should be accompanied with tests.

### Within a Magento installation
To run the sniff unit tests from a main repository, where the rules are installed via `composer`, first configure `phpcs` to find the rules:

    vendor/bin/phpcs --config-set installed_paths vendor/extdn/phpcs/Extdn,vendor/magento/marketplace-eqp/MEQP2

Then tests can be run like this:

    phpunit -c vendor/extdn/phpcs/phpunit-vendor.xml vendor/extdn/phpcs/Extdn/Tests

### In a standalone installation
If you have cloned this GitHub repository on its own for development, use `composer` to install things and run the tests:

    composer install
    composer test

Each `Test.php` class should be accompanied by a `Test.inc` file to allow for unit testing based upon the PHPCS parent class `AbstractSniffUnitTest`. Make sure to include a `Test.md` Markdown description which addresses the issue at hand, explains what the rule check for and then also suggests the improvement to be made.
