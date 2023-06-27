[![Donate](https://img.shields.io/badge/Donate-PayPal-green.svg?style=for-the-badge)](https://www.paypal.me/quellenform)
[![Latest Stable Version](https://img.shields.io/packagist/v/quellenform/t3x-bootstrap-package-iconpack?style=for-the-badge)](https://packagist.org/packages/quellenform/t3x-bootstrap-package-iconpack)
[![TYPO3 10](https://img.shields.io/badge/TYPO3-10-%23f49700.svg?style=for-the-badge)](https://get.typo3.org/version/11)
[![TYPO3 11](https://img.shields.io/badge/TYPO3-11-%23f49700.svg?style=for-the-badge)](https://get.typo3.org/version/10)
[![License](https://img.shields.io/packagist/l/quellenform/t3x-bootstrap-package-iconpack?style=for-the-badge)](https://packagist.org/packages/quellenform/t3x-bootstrap-package-iconpack)

# Iconpack for Bootstrap Package

TYPO3 CMS Extension `bootstrap_package_iconpack`


## What does it do?

This extension replaces the hard-coded icons in the extension [bootstrap_package](https://github.com/benjaminkott/bootstrap_package) with the flexible icon system provided by the extension [iconpack](https://github.com/quellenform/t3x-iconpack).

In addition to the functionality of *EXT:iconpack*, the individual iconpacks of your choice are thus available in the following elements:
- pages (navigation icon)
- texticon
- accordion
- icon group
- card group
- tabs
- timeline

Of course, it is still possible to use an image as provided by Bootstrap Package, as only the icon sets are replaced.


## Installation

1. Make sure you have installed *EXT:bootstrap_package* and *EXT:iconpack*, as well as a suitable iconpack provider
2. Install this extension from TER or with Composer
3. Add the provided TypoScript to your template

> Note: Make sure you include the template at the end, otherwise `lib.parseFunc_RTE` will be overwritten by *bootstrap_package* and the icons cannot be displayed by the RTE.
