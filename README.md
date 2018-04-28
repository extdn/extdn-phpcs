# ExtDN PHP_CodeSniffer rules for Magento 2

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

    composer config repositories:extdn-phpcs vcs git@github.com:extdn/extdn-phpcs.git
    composer require extdn/phpcs:dev-master

Once installed, you can run PHPCS from the command-line to analyse your code `XYZ`:

    vendor/bin/phpcs --standard=./vendor/extdn/phpcs/Extdn app/code/XYZ
    vendor/bin/phpcs --standard=./vendor/extdn/phpcs/Extdn vendor/XYZ

### Contributions
Any contributions are welcome. Add a new issue under **Issues** to address new rulesets that are needed or report other issues.

As an example, you can use the `SetTemplateInBlockSniff` within the folder `Extdn/Sniffs/Blocks`. It can be tested upon a sample file under `Extdn/Samples/Blocks`:

    vendor/bin/phpcs --standard=./vendor/extdn/phpcs/Extdn vendor/extdn/phpcs/Extdn/Samples

### Testing

vendor/bin/phpcs --config-set installed_paths vendor/extdn/phpcs/Extdn

Tests can be run like this:

    phpunit -c vendor/extdn/phpcs/phpunit.xml.dist vendor/extdn/phpcs/Extdn/Tests

Each `Test.php` class should be accompanied by a `Test.inc` file to allow for unit testing based upon the PHPCS parent class `AbstractSniffUnitTest`.

@todo: Currently not working