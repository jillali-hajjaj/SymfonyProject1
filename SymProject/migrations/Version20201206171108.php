<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201206171108 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE clients (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, adress VARCHAR(255) NOT NULL, phone_number INT NOT NULL, tva_number INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE factures (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, amount INT NOT NULL, tva INT NOT NULL, INDEX IDX_647590B19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE services (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, price INT NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE factures ADD CONSTRAINT FK_647590B19EB6921 FOREIGN KEY (client_id) REFERENCES clients (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE factures DROP FOREIGN KEY FK_647590B19EB6921');
        $this->addSql('DROP TABLE clients');
        $this->addSql('DROP TABLE factures');
        $this->addSql('DROP TABLE services');
    }
}
