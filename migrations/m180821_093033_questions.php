<?php

use yii\db\Migration;

/**
 * Class m180821_093033_questions
 */
class m180821_093033_questions extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%questions}}', [
                'id' => $this->primaryKey(),
                'name' => $this->text(),
                'email' => $this->string(),
                'ip' => $this->string(),
                'date' => $this->date(),

            ]
        );

        $this->createTable('{{%answers}}', [
                'id' => $this->primaryKey(),
                'answer' => $this->text(),
                'questionId' => $this->integer(),
                ]
        );
        $this->addForeignKey("answer_fk", "{{%answers}}", 'questionId', "{{%questions}}", 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180821_093033_questions cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180821_093033_questions cannot be reverted.\n";

        return false;
    }
    */
}
