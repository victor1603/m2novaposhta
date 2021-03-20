<?php

namespace CodeCustom\NovaPoshta\Setup\Patch\Data;

use Magento\Eav\Model\Config;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchVersionInterface;

class StreetRefAttribute implements DataPatchInterface, PatchVersionInterface
{
    /**
     * @var Config
     */
    private $eavConfig;

    /**
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * StreetRefAttribute constructor.
     * @param Config $config
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(
        Config $config,
        EavSetupFactory $eavSetupFactory
    )
    {
        $this->eavConfig = $config;
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * @return string
     */
    public static function getVersion()
    {
        return '1.0.8';
    }

    /**
     * @return array
     */
    public function getAliases()
    {
        return [];
    }

    /**
     * @return array
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * @return StreetRefAttribute|void
     */
    public function apply()
    {
        $this->removeAttr();
        $this->setNovaPoshtaStreetRef();
    }

    /**
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    private function setNovaPoshtaStreetRef()
    {
        $eavSetup = $this->eavSetupFactory->create();

        $eavSetup->addAttribute('customer_address', 'novaposhta_street_ref', [
            'type'             => 'varchar',
            'input'            => 'text',
            'label'            => 'NP Street Ref',
            'visible'          => true,
            'required'         => false,
            'user_defined'      => true,
            'system'           => false,
            'group'            => 'General',
            'global'           => true,
            'visible_on_front' => false,
        ]);

        $customAttribute = $this->eavConfig->getAttribute('customer_address', 'novaposhta_street_ref');

        $customAttribute->setData(
            'used_in_forms',
            ['adminhtml_customer_address']
        );
        $customAttribute->save();
    }


    private function removeAttr()
    {
        $eav = $this->eavSetupFactory->create();
        $eav->removeAttribute('customer_address', 'novaposhta_street_reff');
    }
}
