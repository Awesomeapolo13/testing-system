<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231104130234 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create the test result table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE test_result_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE test_result (
                                    id SERIAL PRIMARY KEY,
                                    test_id INT NOT NULL,
                                    result JSON NOT NULL
                         )'
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE test_result_id_seq CASCADE');
        $this->addSql('DROP TABLE test_result');
    }
}
