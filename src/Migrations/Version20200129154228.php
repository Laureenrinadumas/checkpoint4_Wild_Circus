<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200129154228 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE content ADD category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE content ADD CONSTRAINT FK_FEC530A912469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_FEC530A912469DE2 ON content (category_id)');
        $this->addSql('ALTER TABLE user ADD created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE customer ADD price_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E09D614C7E7 FOREIGN KEY (price_id) REFERENCES price (id)');
        $this->addSql('CREATE INDEX IDX_81398E09D614C7E7 ON customer (price_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE content DROP FOREIGN KEY FK_FEC530A912469DE2');
        $this->addSql('DROP INDEX IDX_FEC530A912469DE2 ON content');
        $this->addSql('ALTER TABLE content DROP category_id');
        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E09D614C7E7');
        $this->addSql('DROP INDEX IDX_81398E09D614C7E7 ON customer');
        $this->addSql('ALTER TABLE customer DROP price_id');
        $this->addSql('ALTER TABLE user DROP created_at');
    }
}
