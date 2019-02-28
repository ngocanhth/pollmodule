<?php
namespace AHT\Poll\Setup;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;
class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface{

	public function install(SchemaSetupInterface $setup, ModuleContextInterface $context){

		$installer = $setup;
        $installer->startSetup();

        /* Create table poll  */

        $table = $installer->getConnection()->newTable(
            $installer->getTable('poll')
        )->addColumn(
            'poll_id',
            Table::TYPE_INTEGER,
            10,
            ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
            'Poll ID'
        )->addColumn(
            'poll_title',
            Table::TYPE_TEXT,
            255,
            ['nullable' => true],
            'Poll Title'
        )->addColumn(
            'votes_count',
            Table::TYPE_INTEGER,
            null,
            ['nullable' => false, 'unsigned' => true, 'default' => 0],
            'Votes Count'
        )->addColumn(
            'status',
            Table::TYPE_BOOLEAN,
            null,
            ['nullable' => false, 'default' => 0]
        );
        $installer->getConnection()->createTable($table);

        /* End create table poll */

        /** Create table poll_answer */

        $table = $installer->getConnection()->newTable(
            $installer->getTable('poll_answer')
        )->addColumn(
            'answer_id',
            Table::TYPE_INTEGER,
            10,
            ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
            'Answer ID'
        )->addColumn(
            'poll_id',
            Table::TYPE_INTEGER,
            10,
            ['unsigned' => true, 'nullable' => false, 'default' => '0'],
            'Auction ID'
        )->addColumn(
            'answer_title',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false, 'default' => ''],
            'Answer Title'
        )->addColumn(
            'votes_count',
            Table::TYPE_INTEGER,
            null,
            ['nullable' => false, 'unsigned' => true, 'default' => 0],
            'Votes Count'
        )
        ->addForeignKey(
            $installer->getFkName(
                'poll_answer',
                'poll_id',
                'poll',
                'poll_id'
            ),
            'poll_id',
            $installer->getTable('poll'),
            'poll_id',
            Table::ACTION_CASCADE
        );
        $installer->getConnection()->createTable($table);

        /** End create table poll_answer */

	}

}