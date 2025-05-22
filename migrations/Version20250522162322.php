<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250522162322 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE currency (id VARCHAR(255) NOT NULL, code VARCHAR(3) NOT NULL, name VARCHAR(10) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE product (id BLOB NOT NULL --(DC2Type:uuid)
            , pricing_currency_id VARCHAR(255) NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_D34A04AD7166DCF0 FOREIGN KEY (pricing_currency_id) REFERENCES currency (id) NOT DEFERRABLE INITIALLY IMMEDIATE)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_D34A04AD7166DCF0 ON product (pricing_currency_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TEMPORARY TABLE __temp__topping AS SELECT id, pizza_id FROM topping
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE topping
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE topping (id BLOB NOT NULL --(DC2Type:uuid)
            , pizza_id BLOB NOT NULL --(DC2Type:uuid)
            , PRIMARY KEY(id), CONSTRAINT FK_81AA94E7D41D1D42 FOREIGN KEY (pizza_id) REFERENCES pizza (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)
        SQL);
        $this->addSql(<<<'SQL'
            INSERT INTO topping (id, pizza_id) SELECT id, pizza_id FROM __temp__topping
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE __temp__topping
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_81AA94E7D41D1D42 ON topping (pizza_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            DROP TABLE currency
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE product
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TEMPORARY TABLE __temp__topping AS SELECT id, pizza_id FROM topping
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE topping
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE topping (id BLOB NOT NULL --(DC2Type:uuid)
            , pizza_id BLOB NOT NULL --(DC2Type:uuid)
            , PRIMARY KEY(id), CONSTRAINT FK_81AA94E7D41D1D42 FOREIGN KEY (pizza_id) REFERENCES pizza (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)
        SQL);
        $this->addSql(<<<'SQL'
            INSERT INTO topping (id, pizza_id) SELECT id, pizza_id FROM __temp__topping
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE __temp__topping
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_81AA94E7D41D1D42 ON topping (pizza_id)
        SQL);
    }
}
