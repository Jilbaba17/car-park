<?php

use yii\db\Migration;

/**
 * Class m200504_165358_add_payment_date_column
 */
class m200504_165358_add_payment_date_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(\app\models\Payments::tableName(), 'payment_date', $this->dateTime()->null());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(\app\models\Payments::tableName(), 'payment_date');
        echo "m200504_165358_add_payment_date_column cannot be reverted.\n";

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200504_165358_add_payment_date_column cannot be reverted.\n";

        return false;
    }
    */
}
