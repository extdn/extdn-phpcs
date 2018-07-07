# ExtDN PHP_CodeSniffer rules for Magento 2

[![Build Status](https://travis-ci.org/extdn/extdn-phpcs.svg?branch=master)](https://travis-ci.org/extdn/extdn-phpcs)

### Introduction
There are already many PHP CodeSniffer rules out there to aid in Magento 2 development:
- https://github.com/magento/marketplace-eqp
- https://github.com/magento-ecg/coding-standard
- PSR-1, PSR-2, possibly PSR-12

However, some best practices still need to be integrated. Like not using the Object Manager in PHTML
templates, not using `setTemplate` in Blocks and using namespaced classes for Virtual Types. This
repository forms an effort to come up with more advanced rulesets than there currently are.

### Usage

To install this package, go to your Magento 2 root and use the following:

    composer require extdn/phpcs:dev-master

Once installed, you can run PHPCS from the command-line to analyse your code `XYZ`:

    vendor/bin/phpcs --standard=./vendor/extdn/phpcs/Extdn app/code/XYZ
    vendor/bin/phpcs --standard=./vendor/extdn/phpcs/Extdn vendor/XYZ

### Contributions

Any contributions are welcome. However, dont start coding just yet. Make sure first that the work is going to be worth the effort.

1) Add a new issue under **Issues** to address new rulesets that are needed or report other issues.

2) Once the creation of the new rule has been accepted by adding a label `Accepted` under **Issues**, we're good to go.

3) If a similar rule already exists in the Magento ECG standards and/or Magento Marketplace standards, simply try to include this rule within the ExtDN ruleset.

4) If no rule exists yet, let's create it. As an example, you can use the `SetTemplateInBlockSniff` within the folder `Extdn/Sniffs/Blocks`. It can be tested upon a sample file under `Extdn/Samples/Blocks`:

    vendor/bin/phpcs --standard=./vendor/extdn/phpcs/Extdn vendor/extdn/phpcs/Extdn/Samples

#### Labels

Some important labels, used for Github issues:

- `accepted`: The rule is accepted by extdn. If nobody claimed it yet, you may start working on it
- `experimental`: The rule can be implemented as well, but we will try it out with a low severity first before integrating it into the official ruleset
- `non-PHPCS`: The rule is not feasibly implementable with phpcs, will need additional tools. We keep it for later.
- `organizational`: Non-code related issues
- `on agenda of hangout`: The rule/issue will be discussed in the next community hangout

### Testing

### Within a Magento installation

To run the sniff unit tests from a main repository, where the rules are installed via composer, first configure phpcs to find the rules:

    vendor/bin/phpcs --config-set installed_paths vendor/extdn/phpcs/Extdn,vendor/magento/marketplace-eqp/MEQP2

Then tests can be run like this:

    phpunit -c vendor/extdn/phpcs/phpunit-vendor.xml vendor/extdn/phpcs/Extdn/Tests

### In a standalone installation

If you cloned the repository on its own for development:

    composer install
    composer test

Each `Test.php` class should be accompanied by a `Test.inc` file to allow for unit testing based upon the PHPCS parent class `AbstractSniffUnitTest`. Make sure to include a `Test.md` Markdown description which addresses the issue at hand, explains what the rule check for and then also suggests the improvement to be made.

