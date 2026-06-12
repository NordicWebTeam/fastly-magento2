<?php
namespace Fastly\Cdn\Setup\Patch\Data;

use Magento\Framework\App\Config\Storage\WriterInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Fastly\Cdn\Model\Config as FastlyConfig;
use Magento\Framework\App\Config\ScopeConfigInterface;

/**
 * Class AddExcludedCountriesConfig
 * This patch adds the default excluded countries to the core_config_data table for Fastly.
 */
class AddExcludedCountriesConfig implements DataPatchInterface
{
    /**
     * @var WriterInterface
     */
    private $configWriter;

    /**
     * AddExcludedCountriesConfig constructor.
     *
     * @param WriterInterface $configWriter
     */
    public function __construct(WriterInterface $configWriter)
    {
        $this->configWriter = $configWriter;
    }

    /**
     * Apply the patch to insert the excluded countries.
     *
     * @return void
     */
    public function apply()
    {
        // The configuration path where the data will be stored
        $configPath = FastlyConfig::XML_FASTLY_EXCLUDED_COUNTRIES;

        // The default list of excluded countries (JSON format)
        $excludedCountries = '["AT","BG","HR","CY","DK","EE","EU","FI","FR","DE","GR","GL","IS","IE","IT","LV","LI","LT","LU","MT","MD","NO","PL","PT","RO","SK","SI","ES","SE","CH","UA","GB","VA","AX"]';

        // Insert the value into the core_config_data table for the 'default' scope with scope_id 0
        $this->configWriter->save($configPath, $excludedCountries, ScopeConfigInterface::SCOPE_TYPE_DEFAULT, 0);
    }

    /**
     * @return array
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * @return array
     */
    public function getAliases()
    {
        return [];
    }
}
