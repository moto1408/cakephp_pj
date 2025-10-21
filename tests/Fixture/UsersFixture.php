<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 */
class UsersFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => '5f106648-60b1-4b98-86d5-cab7b82fe7bb',
                'email' => 'Lorem ipsum dolor sit amet',
                'password' => 'Lorem ipsum dolor sit amet',
                'username' => 'Lorem ipsum dolor sit amet',
                'profile_url_slug' => 'Lorem ipsum dolor sit amet',
                'role' => 'Lorem ipsum dolor ',
                'is_verified' => 1,
                'is_active' => 1,
                'created' => '2025-10-21 14:00:25',
                'modified' => '2025-10-21 14:00:25',
            ],
        ];
        parent::init();
    }
}
