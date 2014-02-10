<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1392035154.
 * Generated on 2014-02-10 13:25:54 by tomasz
 */
class PropelMigration_1392035154
{

    public function preUp($manager)
    {
        // add the pre-migration code here
    }

    public function postUp($manager)
    {
        // add the post-migration code here
    }

    public function preDown($manager)
    {
        // add the pre-migration code here
    }

    public function postDown($manager)
    {
        // add the post-migration code here
    }

    /**
     * Get the SQL statements for the Up migration
     *
     * @return array list of the SQL strings to execute for the Up migration
     *               the keys being the datasources
     */
    public function getUpSQL()
    {
        return array (
  'vote-app' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `constituency` CHANGE `going_maybe` `going_yes` INTEGER;

ALTER TABLE `vote` CHANGE `is_going_vote` `is_going_vote` TINYINT(1) NOT NULL;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

    /**
     * Get the SQL statements for the Down migration
     *
     * @return array list of the SQL strings to execute for the Down migration
     *               the keys being the datasources
     */
    public function getDownSQL()
    {
        return array (
  'vote-app' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `constituency` CHANGE `going_yes` `going_maybe` INTEGER;

ALTER TABLE `vote` CHANGE `is_going_vote` `is_going_vote` TINYINT NOT NULL;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}