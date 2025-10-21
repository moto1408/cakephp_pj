<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateUsersTable extends AbstractMigration
{
    public function up(): void
    {
        $table = $this->table('users');

        // UUID (CHAR(36)) を主キーとして設定
        $table->addColumn('id', 'uuid', [
            'null' => false,
        ]);

        $table
            ->addColumn('email', 'string', ['limit' => 255, 'null' => false,])
            ->addColumn('password', 'string', ['limit' => 255, 'null' => false,])
            ->addColumn('username', 'string', ['limit' => 50, 'null' => false,])
            ->addColumn('profile_url_slug', 'string', ['limit' => 50, 'default' => null, 'null' => true,])
            ->addColumn('role', 'string', ['limit' => 20, 'default' => 'user', 'null' => false,])
            ->addColumn('is_verified', 'boolean', ['default' => 0, 'null' => false,])
            ->addColumn('is_active', 'boolean', ['default' => 1, 'null' => false,])
            ->addColumn('created', 'datetime', ['null' => false])
            ->addColumn('modified', 'datetime', ['null' => false])
            ->addColumn('deleted', 'datetime', ['default' => null, 'null' => true])

            ->addIndex(['email'], ['unique' => true])
            ->addIndex(['profile_url_slug'], ['unique' => true])

            ->addPrimaryKey(['id'])

            ->create();
    }
}
