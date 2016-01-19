<?php

use yii\db\Migration;
use yii\db\Schema;

class m160118_173512_create_tables extends Migration
{
    public function up()
    {
        $this->createTable('{{%tours}}', [
            'id' => $this->primaryKey(),
            'title' => Schema::TYPE_STRING . '(255) NOT NULL',

        ]);

        $this->createTable('{{%tours_meta}}', [
            'id' => $this->primaryKey(),
            'tour_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'tour_key' => Schema::TYPE_STRING . '(50) NOT NULL',
            'tour_value' => Schema::TYPE_STRING . ' NOT NULL',
            'description' =>  Schema::TYPE_STRING . '(255) NOT NULL',
            'order_sort' =>  Schema::TYPE_INTEGER . ' NOT NULL',

        ]);
        $this->createTable('{{%orders}}', [
            'id' => $this->primaryKey(),
            'tour_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'created' => Schema::TYPE_DATE . ' NOT NULL',
            'user_id' => Schema::TYPE_INTEGER . ' NOT NULL',


        ]);
        $this->createTable('{{%order_meta}}', [
            'id' => $this->primaryKey(),
            'order_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'meta_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'meta_val' => Schema::TYPE_STRING . ' NOT NULL',


        ]);
        $this->createIndex('fk_tours_orders', '{{%orders}}', 'tour_id');
        $this->addForeignKey(
            'fk_tours_orders', '{{%orders}}', 'tour_id', '{{%tours}}','id','CASCADE', 'RESTRICT'
        );
        $this->createIndex('fk_tours_meta', '{{%tours_meta}}', 'tour_id');
        $this->addForeignKey(
            'fk_tours_meta', '{{%tours_meta}}', 'tour_id', '{{%tours}}','id','CASCADE', 'RESTRICT'
        );
        $this->createIndex('fk_orders_meta', '{{%order_meta}}', 'order_id');
        $this->addForeignKey(
            'fk_orders_meta', '{{%order_meta}}', 'order_id', '{{%orders}}','id','CASCADE', 'RESTRICT'
        );
        $this->createIndex('fk_orders_metaval', '{{%order_meta}}', 'meta_id');
        $this->addForeignKey(
            'fk_orders_metaval', '{{%order_meta}}', 'meta_id', '{{%tours_meta}}','id','CASCADE', 'RESTRICT'
        );

    }

    public function down()
    {
        $this->dropTable('{{%tours_meta}}');
        $this->dropTable('{{%order_meta}}');
        $this->dropTable('{{%orders}}');
        $this->dropTable('{{%tours}}');
    }
}
