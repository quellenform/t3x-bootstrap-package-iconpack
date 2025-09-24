--
-- Table structure for table 'pages'
--
CREATE TABLE pages (
	page_icon_enable tinyint(3) unsigned DEFAULT '0' NOT NULL
);

--
-- Table structure for table 'tt_content'
--
CREATE TABLE tt_content (
	iconpack_enable tinyint(3) unsigned DEFAULT '0' NOT NULL,
	iconpack varchar(120) DEFAULT '' NOT NULL
);
--
-- Table structure for table 'tx_bootstrappackage_card_group_item'
--
CREATE TABLE tx_bootstrappackage_card_group_item (
	header_icon varchar(120) DEFAULT '' NOT NULL,
	iconpack_enable tinyint(3) unsigned DEFAULT '0' NOT NULL,
	iconpack varchar(120) DEFAULT '' NOT NULL
);

--
-- Table structure for table 'tx_bootstrappackage_accordion_item'
--
CREATE TABLE tx_bootstrappackage_accordion_item (
	header_icon varchar(120) DEFAULT '' NOT NULL
);

--
-- Table structure for table 'tx_bootstrappackage_icon_group_item'
--
CREATE TABLE tx_bootstrappackage_icon_group_item (
	iconpack_enable tinyint(3) unsigned DEFAULT '0' NOT NULL,
	iconpack varchar(120) DEFAULT '' NOT NULL
);

--
-- Table structure for table 'tx_bootstrappackage_tab_item'
--
CREATE TABLE tx_bootstrappackage_tab_item (
	header_icon varchar(120) DEFAULT '' NOT NULL
);

--
-- Table structure for table 'tx_bootstrappackage_timeline_item'
--
CREATE TABLE tx_bootstrappackage_timeline_item (
	iconpack_enable tinyint(3) unsigned DEFAULT '0' NOT NULL,
	iconpack varchar(120) DEFAULT '' NOT NULL
);

--
-- Table structure for table 'tx_bootstrappackage_carousel_item'
--
CREATE TABLE tx_bootstrappackage_carousel_item (
	header_icon varchar(120) DEFAULT '' NOT NULL
);
