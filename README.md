[![Donate](https://img.shields.io/badge/Donate-PayPal-green.svg?style=for-the-badge)](https://www.paypal.me/quellenform)
[![Latest Stable Version](https://img.shields.io/packagist/v/quellenform/t3x-bootstrap-package-iconpack?style=for-the-badge)](https://packagist.org/packages/quellenform/t3x-bootstrap-package-iconpack)
[![TYPO3](https://img.shields.io/badge/TYPO3-10|11|12|13-%23f49700.svg?style=for-the-badge)](https://get.typo3.org/)
[![License](https://img.shields.io/packagist/l/quellenform/t3x-bootstrap-package-iconpack?style=for-the-badge)](https://packagist.org/packages/quellenform/t3x-bootstrap-package-iconpack)

# Iconpack for Bootstrap Package

TYPO3 CMS Extension `bootstrap_package_iconpack`


## What does it do?

This extension replaces the hard-coded icons in the extension [bootstrap_package](https://github.com/benjaminkott/bootstrap_package)
with the flexible icon system provided by the extension [iconpack](https://github.com/quellenform/t3x-iconpack).

In addition to the functionality of *EXT:iconpack*, the individual iconpacks of your choice are thus available
in the following elements:
- Pages (navigation icon)
- Accordion
- Card Group
- Carousel
- Icon Group
- Tabs
- Texticon
- Timeline

Of course, it is still possible to use an image as provided by *EXT:bootstrap_package*, as only the icon sets are replaced.

In addition, the icons integrated in *EXT:bootstrap_package*, which are used to display social icons and file downloads,
are replaced by a separate iconpack, ensuring that all display options (svgSprite, svgInline, webfont, svg) are supported.


## Installation

1. Make sure you have installed *EXT:bootstrap_package* and *EXT:iconpack*, as well as a suitable iconpack provider
2. Install this extension from TER or with Composer
3. Add the provided TypoScript (or Site Set) to your template
4. Run the upgrade wizard if you are upgrading from the beta version of *EXT:bootstrap_package_iconpack*
5. Carefully check whether any of your individual templates affect the above-mentioned content types,
   and whether any relevant parts that are necessary for the rendering of icons are being overwritten!

> **Important Note**
>
> The templates provided with this extension are used in TypoScript BEFORE your individually defined templates
> to prevent them from being accidentally overwritten. Any changes you make to those default templates manually
> must therefore take into account the above-mentioned content elements for the rendering of icons and implement
> the modifications correctly!
>
> Hint: Take a look at the provided Typoscript/Templates.
