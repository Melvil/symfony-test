<?php


/**
 * Skeleton subclass for representing a row from the 'category' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * 10/15/12 13:40:52
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class Category extends BaseCategory
{
	public function __toString()
	{
		return $this->getTitle();
	}
} // Category
