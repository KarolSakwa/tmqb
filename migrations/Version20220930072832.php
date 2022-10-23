<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220930072832 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE competition (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, logo VARCHAR(255) DEFAULT NULL, reputation DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, pattern_id INT DEFAULT NULL, text VARCHAR(2000) NOT NULL, year INT NOT NULL, answer_a VARCHAR(255) NOT NULL, answer_b VARCHAR(255) NOT NULL, answer_c VARCHAR(255) NOT NULL, answer_d VARCHAR(255) NOT NULL, correct_answer VARCHAR(255) NOT NULL, difficulty DOUBLE PRECISION DEFAULT NULL, INDEX IDX_B6F7494EF734A20F (pattern_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question_category (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question_pattern (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, text VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, first_record_selector VARCHAR(500) DEFAULT NULL, second_record_selector VARCHAR(500) DEFAULT NULL, third_record_selector VARCHAR(500) DEFAULT NULL, fourth_record_selector VARCHAR(500) DEFAULT NULL, INDEX IDX_AD60299312469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494EF734A20F FOREIGN KEY (pattern_id) REFERENCES question_pattern (id)');
        $this->addSql('ALTER TABLE question_pattern ADD CONSTRAINT FK_AD60299312469DE2 FOREIGN KEY (category_id) REFERENCES question_category (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494EF734A20F');
        $this->addSql('ALTER TABLE question_pattern DROP FOREIGN KEY FK_AD60299312469DE2');
        $this->addSql('DROP TABLE competition');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE question_category');
        $this->addSql('DROP TABLE question_pattern');
    }
}
