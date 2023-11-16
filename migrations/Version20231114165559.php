<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231114165559 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE atelier (id INT AUTO_INCREMENT NOT NULL, nb_places INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compte (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, mel VARCHAR(255) NOT NULL, tel VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, portfolio_url VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE conference (id INT AUTO_INCREMENT NOT NULL, un_intervenant_id INT DEFAULT NULL, theme VARCHAR(255) NOT NULL, INDEX IDX_911533C8E006E110 (un_intervenant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evenement (id INT AUTO_INCREMENT NOT NULL, un_hackaton_id INT NOT NULL, descrription VARCHAR(255) NOT NULL, date DATE NOT NULL, heure DATE DEFAULT NULL, durée VARCHAR(255) DEFAULT NULL, salle VARCHAR(255) DEFAULT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_B26681EDD39DACB (un_hackaton_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hackaton (id INT AUTO_INCREMENT NOT NULL, nbr_places_limit INT DEFAULT NULL, date_lim_insc DATE NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, lieu VARCHAR(255) NOT NULL, heure DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscription (num_insc INT AUTO_INCREMENT NOT NULL, le_compte_id INT NOT NULL, un_hackaton_id INT NOT NULL, date_insc DATE NOT NULL, INDEX IDX_5E90F6D62BDD72D7 (le_compte_id), INDEX IDX_5E90F6D6DD39DACB (un_hackaton_id), PRIMARY KEY(num_insc)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE intervenant (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personne (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personne_atelier (personne_id INT NOT NULL, atelier_id INT NOT NULL, INDEX IDX_3F34FCDEA21BD112 (personne_id), INDEX IDX_3F34FCDE82E2CF35 (atelier_id), PRIMARY KEY(personne_id, atelier_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE conference ADD CONSTRAINT FK_911533C8E006E110 FOREIGN KEY (un_intervenant_id) REFERENCES intervenant (id)');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681EDD39DACB FOREIGN KEY (un_hackaton_id) REFERENCES hackaton (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D62BDD72D7 FOREIGN KEY (le_compte_id) REFERENCES compte (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6DD39DACB FOREIGN KEY (un_hackaton_id) REFERENCES hackaton (id)');
        $this->addSql('ALTER TABLE personne_atelier ADD CONSTRAINT FK_3F34FCDEA21BD112 FOREIGN KEY (personne_id) REFERENCES personne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personne_atelier ADD CONSTRAINT FK_3F34FCDE82E2CF35 FOREIGN KEY (atelier_id) REFERENCES atelier (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conference DROP FOREIGN KEY FK_911533C8E006E110');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681EDD39DACB');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D62BDD72D7');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6DD39DACB');
        $this->addSql('ALTER TABLE personne_atelier DROP FOREIGN KEY FK_3F34FCDEA21BD112');
        $this->addSql('ALTER TABLE personne_atelier DROP FOREIGN KEY FK_3F34FCDE82E2CF35');
        $this->addSql('DROP TABLE atelier');
        $this->addSql('DROP TABLE compte');
        $this->addSql('DROP TABLE conference');
        $this->addSql('DROP TABLE evenement');
        $this->addSql('DROP TABLE hackaton');
        $this->addSql('DROP TABLE inscription');
        $this->addSql('DROP TABLE intervenant');
        $this->addSql('DROP TABLE personne');
        $this->addSql('DROP TABLE personne_atelier');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
