<?php

use yii\db\Migration;

/**
 * Class m190926_115852_init
 */
class m190926_115852_init extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%atm}}', [
            'id' => $this->primaryKey(),
            'address' => $this->string(200)->notNull(),
            'latitude' => $this->float()->notNull(),
            'longitude' => $this->float()->notNull()
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%atm}}');
    }
}
