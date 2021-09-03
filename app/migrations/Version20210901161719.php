<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210901161719 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE astronaut (id INT AUTO_INCREMENT NOT NULL, grade_id INT NOT NULL, pseudo VARCHAR(255) NOT NULL, INDEX IDX_5DADB6E5FE19A1A8 (grade_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grade (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE planet (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE planet_astronaut (planet_id INT NOT NULL, astronaut_id INT NOT NULL, INDEX IDX_DC60E91DA25E9820 (planet_id), INDEX IDX_DC60E91DD390014D (astronaut_id), PRIMARY KEY(planet_id, astronaut_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE products (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, INDEX IDX_B3BA5A5A12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE astronaut ADD CONSTRAINT FK_5DADB6E5FE19A1A8 FOREIGN KEY (grade_id) REFERENCES grade (id)');
        $this->addSql('ALTER TABLE planet_astronaut ADD CONSTRAINT FK_DC60E91DA25E9820 FOREIGN KEY (planet_id) REFERENCES planet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE planet_astronaut ADD CONSTRAINT FK_DC60E91DD390014D FOREIGN KEY (astronaut_id) REFERENCES astronaut (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5A12469DE2 FOREIGN KEY (category_id) REFERENCES categories (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE planet_astronaut DROP FOREIGN KEY FK_DC60E91DD390014D');
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5A12469DE2');
        $this->addSql('ALTER TABLE astronaut DROP FOREIGN KEY FK_5DADB6E5FE19A1A8');
        $this->addSql('ALTER TABLE planet_astronaut DROP FOREIGN KEY FK_DC60E91DA25E9820');
        $this->addSql('DROP TABLE astronaut');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE grade');
        $this->addSql('DROP TABLE planet');
        $this->addSql('DROP TABLE planet_astronaut');
        $this->addSql('DROP TABLE products');
    }
}
