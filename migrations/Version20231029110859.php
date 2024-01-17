<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231029110859 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create test, question and answer tables';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE answer_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE question_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE test_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE answer (
                                    id SERIAL PRIMARY KEY,
                                    question_id INT NOT NULL,
                                    title VARCHAR(255) NOT NULL,
                                    is_correct BOOLEAN NOT NULL
                    )'
        );
        $this->addSql('CREATE INDEX IDX_DADD4A251E27F6BF ON answer (question_id)');
        $this->addSql('CREATE TABLE question (
                                    id SERIAL PRIMARY KEY,
                                    test_id INT NOT NULL,
                                    title VARCHAR(255) NOT NULL
                      )'
        );
        $this->addSql('CREATE INDEX IDX_B6F7494E1E5D0459 ON question (test_id)');
        $this->addSql('CREATE TABLE test (
                                    id SERIAL PRIMARY KEY,
                                    title VARCHAR(255) NOT NULL,
                                    description TEXT DEFAULT NULL
                  )'
        );
        $this->addSql('ALTER TABLE answer
                                ADD CONSTRAINT FK_DADD4A251E27F6BF
                                    FOREIGN KEY (question_id)
                                        REFERENCES question (id)
                                        NOT DEFERRABLE INITIALLY IMMEDIATE'
        );
        $this->addSql('ALTER TABLE question
                                ADD CONSTRAINT FK_B6F7494E1E5D0459
                                    FOREIGN KEY (test_id)
                                        REFERENCES test (id)
                                        NOT DEFERRABLE INITIALLY IMMEDIATE'
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE answer_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE question_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE test_id_seq CASCADE');
        $this->addSql('ALTER TABLE answer DROP CONSTRAINT FK_DADD4A251E27F6BF');
        $this->addSql('ALTER TABLE question DROP CONSTRAINT FK_B6F7494E1E5D0459');
        $this->addSql('DROP TABLE answer');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE test');
    }
}
