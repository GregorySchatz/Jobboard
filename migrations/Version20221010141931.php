<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221010141931 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE advertisement (id INT AUTO_INCREMENT NOT NULL, company_id_id INT NOT NULL, type_contract_id_id INT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, wages INT NOT NULL, workingtime INT NOT NULL, INDEX IDX_C95F6AEE38B53C32 (company_id_id), INDEX IDX_C95F6AEE6A862BE7 (type_contract_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, siret INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job_application (id INT AUTO_INCREMENT NOT NULL, advertisement_id_id INT NOT NULL, user_id_id INT DEFAULT NULL, status_id_id INT NOT NULL, message VARCHAR(255) NOT NULL, firstname VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, INDEX IDX_C737C6887A0D5EE (advertisement_id_id), INDEX IDX_C737C6889D86650F (user_id_id), INDEX IDX_C737C688881ECFA7 (status_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_contract (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, company_id_id INT DEFAULT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, role JSON NOT NULL, INDEX IDX_8D93D64938B53C32 (company_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE advertisement ADD CONSTRAINT FK_C95F6AEE38B53C32 FOREIGN KEY (company_id_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE advertisement ADD CONSTRAINT FK_C95F6AEE6A862BE7 FOREIGN KEY (type_contract_id_id) REFERENCES type_contract (id)');
        $this->addSql('ALTER TABLE job_application ADD CONSTRAINT FK_C737C6887A0D5EE FOREIGN KEY (advertisement_id_id) REFERENCES advertisement (id)');
        $this->addSql('ALTER TABLE job_application ADD CONSTRAINT FK_C737C6889D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE job_application ADD CONSTRAINT FK_C737C688881ECFA7 FOREIGN KEY (status_id_id) REFERENCES status (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64938B53C32 FOREIGN KEY (company_id_id) REFERENCES company (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE advertisement DROP FOREIGN KEY FK_C95F6AEE38B53C32');
        $this->addSql('ALTER TABLE advertisement DROP FOREIGN KEY FK_C95F6AEE6A862BE7');
        $this->addSql('ALTER TABLE job_application DROP FOREIGN KEY FK_C737C6887A0D5EE');
        $this->addSql('ALTER TABLE job_application DROP FOREIGN KEY FK_C737C6889D86650F');
        $this->addSql('ALTER TABLE job_application DROP FOREIGN KEY FK_C737C688881ECFA7');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64938B53C32');
        $this->addSql('DROP TABLE advertisement');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE job_application');
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP TABLE type_contract');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
