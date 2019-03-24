<?php
class Ballal_Customer_Model_Eav_Entity_Attribute_Source_Customeroptions extends Mage_Eav_Model_Entity_Attribute_Source_Abstract
{
    /**
     * Retrieve all options array
     *
     * @return array
     */
    public function getAllOptions()
    {
        if (is_null($this->_options)) {
            $this->_options = array(

                array(
                    "label" => Mage::helper("eav")->__("Select One"),
                    "value" =>  0
                ),

                array(
                    "label" => Mage::helper("eav")->__("Google"),
                    "value" =>  1
                ),
	
                array(
                    "label" => Mage::helper("eav")->__("Bing"),
                    "value" =>  2
                ),
                array(
                    "label" => Mage::helper("eav")->__("Friend"),
                    "value" =>  3
                ),
	
                array(
                    "label" => Mage::helper("eav")->__("Ad"),
                    "value" =>  4
                ),
	
                array(
                    "label" => Mage::helper("eav")->__("Newspaper"),
                    "value" =>  5
                ),
	
                array(
                    "label" => Mage::helper("eav")->__("Facebook"),
                    "value" =>  6
                ),

                array(
                    "label" => Mage::helper("eav")->__("Other Social Media"),
                    "value" =>  7
                ),



	
            );
        }
        return $this->_options;
    }

    /**
     * Retrieve option array
     *
     * @return array
     */
    public function getOptionArray()
    {
        $_options = array();
        foreach ($this->getAllOptions() as $option) {
            $_options[$option["value"]] = $option["label"];
        }
        return $_options;
    }

    /**
     * Get a text for option value
     *
     * @param string|integer $value
     * @return string
     */
    public function getOptionText($value)
    {
        $options = $this->getAllOptions();
        foreach ($options as $option) {
            if ($option["value"] == $value) {
                return $option["label"];
            }
        }
        return false;
    }

    /**
     * Retrieve Column(s) for Flat
     *
     * @return array
     */
    public function getFlatColums()
    {
        $columns = array();
        $columns[$this->getAttribute()->getAttributeCode()] = array(
            "type"      => "tinyint(1)",
            "unsigned"  => false,
            "is_null"   => true,
            "default"   => null,
            "extra"     => null
        );

        return $columns;
    }

    /**
     * Retrieve Indexes(s) for Flat
     *
     * @return array
     */
    public function getFlatIndexes()
    {
        $indexes = array();

        $index = "IDX_" . strtoupper($this->getAttribute()->getAttributeCode());
        $indexes[$index] = array(
            "type"      => "index",
            "fields"    => array($this->getAttribute()->getAttributeCode())
        );

        return $indexes;
    }

    /**
     * Retrieve Select For Flat Attribute update
     *
     * @param int $store
     * @return Varien_Db_Select|null
     */
    public function getFlatUpdateSelect($store)
    {
        return Mage::getResourceModel("eav/entity_attribute")
            ->getFlatUpdateSelect($this->getAttribute(), $store);
    }
}

			 