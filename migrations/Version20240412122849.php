<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240412122849 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE favoris (id_hackathon_id INT NOT NULL, id_compte_id INT NOT NULL, is_favori TINYINT(1) NOT NULL, INDEX IDX_8933C432BAACE5BD (id_hackathon_id), INDEX IDX_8933C43272F0DA07 (id_compte_id), PRIMARY KEY(id_hackathon_id, id_compte_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE favoris ADD CONSTRAINT FK_8933C432BAACE5BD FOREIGN KEY (id_hackathon_id) REFERENCES hackaton (id)');
        $this->addSql('ALTER TABLE favoris ADD CONSTRAINT FK_8933C43272F0DA07 FOREIGN KEY (id_compte_id) REFERENCES compte (id)');
      
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE favoris DROP FOREIGN KEY FK_8933C432BAACE5BD');
        $this->addSql('ALTER TABLE favoris DROP FOREIGN KEY FK_8933C43272F0DA07');
        $this->addSql('DROP TABLE favoris');
    
    }
}
