<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190729052848 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE contrat (id INT AUTO_INCREMENT NOT NULL, intitul VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, duree VARCHAR(50) NOT NULL, horaires_hebdo VARCHAR(50) NOT NULL, is_valid TINYINT(1) NOT NULL, total_conges VARCHAR(25) NOT NULL, total_teletravail VARCHAR(25) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contrat_salarie (contrat_id INT NOT NULL, salarie_id INT NOT NULL, INDEX IDX_2B40696C1823061F (contrat_id), INDEX IDX_2B40696C5859934A (salarie_id), PRIMARY KEY(contrat_id, salarie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contrat_salarie ADD CONSTRAINT FK_2B40696C1823061F FOREIGN KEY (contrat_id) REFERENCES contrat (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE contrat_salarie ADD CONSTRAINT FK_2B40696C5859934A FOREIGN KEY (salarie_id) REFERENCES salarie (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE contrat_salarie DROP FOREIGN KEY FK_2B40696C1823061F');
        $this->addSql('DROP TABLE contrat');
        $this->addSql('DROP TABLE contrat_salarie');
    }
}
