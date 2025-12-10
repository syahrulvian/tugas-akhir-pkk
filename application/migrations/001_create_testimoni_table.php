<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_testimoni_table extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'id_testimoni' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'testimoni_nama' => array(
                'type' => 'VARCHAR',
                'constraint' => '150',
                'null' => FALSE
            ),
            'testimoni_perusahaan' => array(
                'type' => 'VARCHAR',
                'constraint' => '150',
                'null' => FALSE
            ),
            'testimoni_isi' => array(
                'type' => 'LONGTEXT',
                'null' => FALSE
            ),
            'testimoni_rating' => array(
                'type' => 'INT',
                'constraint' => 1,
                'default' => 5
            ),
            'testimoni_foto' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'testimoni_email' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE
            ),
            'testimoni_status' => array(
                'type' => 'ENUM',
                'constraint' => array('pending', 'approved', 'rejected'),
                'default' => 'pending'
            ),
            'testimoni_date' => array(
                'type' => 'DATETIME',
                'default' => 'CURRENT_TIMESTAMP'
            ),
            'created_at' => array(
                'type' => 'DATETIME',
                'default' => 'CURRENT_TIMESTAMP'
            ),
            'updated_at' => array(
                'type' => 'DATETIME',
                'default' => 'CURRENT_TIMESTAMP',
                'on_update' => 'CURRENT_TIMESTAMP'
            )
        ));

        $this->dbforge->add_key('id_testimoni', TRUE);
        $this->dbforge->create_table('tb_testimoni');
    }

    public function down()
    {
        $this->dbforge->drop_table('tb_testimoni');
    }
}
