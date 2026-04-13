<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260413113439 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE answer (id INT AUTO_INCREMENT NOT NULL, text VARCHAR(255) NOT NULL, is_correct TINYINT NOT NULL, question_id INT NOT NULL, INDEX IDX_DADD4A251E27F6BF (question_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, text LONGTEXT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE question_quizz (question_id INT NOT NULL, quizz_id INT NOT NULL, INDEX IDX_4C9C86391E27F6BF (question_id), INDEX IDX_4C9C8639BA934BCD (quizz_id), PRIMARY KEY (question_id, quizz_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE quizz (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE submission (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, quizz_id INT NOT NULL, INDEX IDX_DB055AF3BA934BCD (quizz_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE submission_answer (submission_id INT NOT NULL, answer_id INT NOT NULL, INDEX IDX_E2D8179BE1FD4933 (submission_id), INDEX IDX_E2D8179BAA334807 (answer_id), PRIMARY KEY (submission_id, answer_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750 (queue_name, available_at, delivered_at, id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A251E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE question_quizz ADD CONSTRAINT FK_4C9C86391E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE question_quizz ADD CONSTRAINT FK_4C9C8639BA934BCD FOREIGN KEY (quizz_id) REFERENCES quizz (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE submission ADD CONSTRAINT FK_DB055AF3BA934BCD FOREIGN KEY (quizz_id) REFERENCES quizz (id)');
        $this->addSql('ALTER TABLE submission_answer ADD CONSTRAINT FK_E2D8179BE1FD4933 FOREIGN KEY (submission_id) REFERENCES submission (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE submission_answer ADD CONSTRAINT FK_E2D8179BAA334807 FOREIGN KEY (answer_id) REFERENCES answer (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A251E27F6BF');
        $this->addSql('ALTER TABLE question_quizz DROP FOREIGN KEY FK_4C9C86391E27F6BF');
        $this->addSql('ALTER TABLE question_quizz DROP FOREIGN KEY FK_4C9C8639BA934BCD');
        $this->addSql('ALTER TABLE submission DROP FOREIGN KEY FK_DB055AF3BA934BCD');
        $this->addSql('ALTER TABLE submission_answer DROP FOREIGN KEY FK_E2D8179BE1FD4933');
        $this->addSql('ALTER TABLE submission_answer DROP FOREIGN KEY FK_E2D8179BAA334807');
        $this->addSql('DROP TABLE answer');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE question_quizz');
        $this->addSql('DROP TABLE quizz');
        $this->addSql('DROP TABLE submission');
        $this->addSql('DROP TABLE submission_answer');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
