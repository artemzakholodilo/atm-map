<?php

use yii\db\Migration;

/**
 * Class m190926_122733_alter_table_atm
 */
class m190926_122733_alter_table_atm extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createIndex('{{%atm}}', 'latitude', 'latitude', true);
        $this->createIndex('{{%atm}}', 'longitude', 'longitude', true);
        $this->addColumn('{{%atm}}', 'alias', $this->string(200)->defaultValue(NULL));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('latitude', '{{%atm}}');
        $this->dropIndex('longitude', '{{%atm}}');
        $this->dropColumn('{{%atm}}', 'alias');
    }
}
