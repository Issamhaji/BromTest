<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231010125827 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE deliverables DROP FOREIGN KEY FK_1A74C3A999091188');
        $this->addSql('DROP INDEX IDX_1A74C3A999091188 ON deliverables');
        $this->addSql('ALTER TABLE deliverables ADD deliverable2 VARCHAR(255) NOT NULL, DROP phase_id, CHANGE file_path deliverable1 VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE phase ADD deliverable_id INT NOT NULL');
        $this->addSql('ALTER TABLE phase ADD CONSTRAINT FK_B1BDD6CBF3C6560A FOREIGN KEY (deliverable_id) REFERENCES deliverables (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B1BDD6CBF3C6560A ON phase (deliverable_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE deliverables ADD phase_id INT NOT NULL, ADD file_path VARCHAR(255) NOT NULL, DROP deliverable1, DROP deliverable2');
        $this->addSql('ALTER TABLE deliverables ADD CONSTRAINT FK_1A74C3A999091188 FOREIGN KEY (phase_id) REFERENCES phase (id)');
        $this->addSql('CREATE INDEX IDX_1A74C3A999091188 ON deliverables (phase_id)');
        $this->addSql('ALTER TABLE phase DROP FOREIGN KEY FK_B1BDD6CBF3C6560A');
        $this->addSql('DROP INDEX UNIQ_B1BDD6CBF3C6560A ON phase');
        $this->addSql('ALTER TABLE phase DROP deliverable_id');
    }
}
