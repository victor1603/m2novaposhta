<?php

namespace CodeCustom\NovaPoshta\Setup\Patch\Data;

use Magento\Eav\Model\Config;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchVersionInterface;

class AddressAttribute implements DataPatchInterface, PatchVersionInterface
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
     * AddressAttribute constructor.
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
     *
     * Apply all methods in Patch class
     *
     * @return AddressAttribute|void
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Zend_Validate_Exception
     */
    public function apply()
    {
        $this->setNovaPoshtaCityRef();
        $this->setNovaPoshtaWarehouseRef();
        $this->setNovaPoshtaWarehouseAddress();
    }

    /**
     * Create customer address attribute to store Novaposhta city ref
     *
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Zend_Validate_Exception
     */
    private function setNovaPoshtaCityRef()
    {
        $eavSetup = $this->eavSetupFactory->create();

        $eavSetup->addAttribute('customer_address', 'novaposhta_city_ref', [
            'type'             => 'varchar',
            'input'            => 'text',
            'label'            => 'NP City Ref (Ref field in novaposhta city table)',
            'visible'          => true,
            'required'         => false,
            'user_defined'     => true,
            'system'           => false,
            'group'            => 'General',
            'global'           => true,
            'visible_on_front' => false,
        ]);

        $customAttribute = $this->eavConfig->getAttribute('customer_address', 'novaposhta_city_ref');

        $customAttribute->setData(
            'used_in_forms',
            ['adminhtml_customer_address']
        );
        $customAttribute->save();
    }

    /**
     * Create customer address attribute to store Novaposhta warehouse ref
     *
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Zend_Validate_Exception
     */
    private function setNovaPoshtaWarehouseRef()
    {
        $eavSetup = $this->eavSetupFactory->create();

        $eavSetup->addAttribute('customer_address', 'novaposhta_warehouse_ref', [
            'type'             => 'varchar',
            'input'            => 'text',
            'label'            => 'NP Warehouse Ref (Ref field in novaposhta warehouse table)',
            'visible'          => true,
            'required'         => false,
            'user_defined'     => true,
            'system'           => false,
            'group'            => 'General',
            'global'           => true,
            'visible_on_front' => false,
        ]);

        $customAttribute = $this->eavConfig->getAttribute('customer_address', 'novaposhta_warehouse_ref');

        $customAttribute->setData(
            'used_in_forms',
            ['adminhtml_customer_address']
        );
        $customAttribute->save();
    }

    /**
     * Create customer address attribute to store Novaposhta warehouse description
     *
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    private function setNovaPoshtaWarehouseAddress()
    {
        $eavSetup = $this->eavSetupFactory->create();

        $eavSetup->addAttribute('customer_address', 'novaposhta_warehouse_address', [
            'type'             => 'varchar',
            'input'            => 'text',
            'label'            => 'NP Warehouse address (Description field in novaposhta warehouse table)',
            'visible'          => true,
            'required'         => false,
            'user_defined'     => true,
            'system'           => false,
            'group'            => 'General',
            'global'           => true,
            'visible_on_front' => false,
        ]);

        $customAttribute = $this->eavConfig->getAttribute('customer_address', 'novaposhta_warehouse_address');

        $customAttribute->setData(
            'used_in_forms',
            ['adminhtml_customer_address']
        );
        $customAttribute->save();
    }

}
