<?php

$installer = $this;

$installer->startSetup();

$installer->run("

ALTER TABLE {$this->getTable('bannerslider')} CHANGE `content` `description` text NULL;

    ");

$installer->endSetup();
