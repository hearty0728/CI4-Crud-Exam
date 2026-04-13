<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUpdatedAtToStudents extends Migration
{
    public function up()
    {
        if (! $this->db->fieldExists('updated_at', 'students')) {
            $this->forge->addColumn('students', [
                'updated_at' => ['type' => 'DATETIME', 'null' => true, 'after' => 'created_at'],
            ]);
        }
    }

    public function down()
    {
        $this->forge->dropColumn('students', 'updated_at');
    }
}
