<?php

$dbFile = __DIR__ . '/data.db';

$createEstadoTable = "
CREATE TABLE IF NOT EXISTS Estado (
        ID INTEGER PRIMARY KEY,
        Estado TEXT NOT NULL
    );
";

$createCategoriaTable = "
CREATE TABLE IF NOT EXISTS  Categoria (
    ID INTEGER PRIMARY KEY,
    Categoria TEXT NOT NULL
);
";

$createRaridadeTable = "
CREATE TABLE IF NOT EXISTS Raridade (
    ID INTEGER PRIMARY KEY,
    Raridade TEXT NOT NULL,
    fk_Categoria_ID INTEGER,
    FOREIGN KEY (fk_Categoria_ID) REFERENCES Categoria (ID) ON DELETE SET NULL
);
";

$createCartaTable = "
CREATE TABLE IF NOT EXISTS  Carta (
    ID INTEGER PRIMARY KEY,
    Nome TEXT NOT NULL,
    Valor_Compra INTEGER,
    Valor_Mercado INTEGER,
    Valor_Venda INTEGER,
    E_Foil INTEGER,
    E_De_Interesse INTEGER,
    fk_Categoria_ID INTEGER,
    fk_Estado_ID INTEGER,
    fk_Raridade_ID INTEGER,
    FOREIGN KEY (fk_Categoria_ID) REFERENCES Categoria (ID) ON DELETE CASCADE,
    FOREIGN KEY (fk_Estado_ID) REFERENCES Estado (ID) ON DELETE CASCADE,
    FOREIGN KEY (fk_Raridade_ID) REFERENCES Raridade (ID) ON DELETE CASCADE
);
";
$insertCategories = "
INSERT INTO Categoria (Categoria) VALUES ('Pokemon'),('Magic: The Gathering'),('Yu-Gi-Oh')";

$insertRaridades = "
INSERT INTO Raridade (Raridade,fk_Categoria_ID) VALUES
                                                    ('Common',1),
                                                    ('Uncommon',1),
                                                    ('Rare',1),
                                                    ('Holo Rare',1),
                                                    ('Ultra Rare',1),
                                                    ('Secret Rare',1),
                                                     ('Common',2),
                                                    ('Uncommon',2),
                                                    ('Rare',2),
                                                    ('Mythic Rare',2),
                                                    ('Common',3),
                                                    ('Uncommon',3),
                                                    ('Rare',3),
                                                    ('Super Rare',3),
                                                    ('Ultra Rare',3),
                                                    ('Secret Rare',3),
                                                    ('Ghost Rare',3);
";

$insertEstados = "
INSERT INTO Estado (Estado) VALUES
                                ('Mint'),
                                ('Near Mint'),
                                ('Excellent'),
                                ('Very Good'),
                                ('Good'),
                                ('Fair'),
                                ('Poor')
;
";

try {
    $db = new PDO('sqlite:' . $dbFile);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->exec("PRAGMA foreign_keys = ON;");
    $db->exec($createEstadoTable);
    $db->exec($createCategoriaTable);
    $db->exec($createRaridadeTable);
    $db->exec($createCartaTable);
    $db->exec($insertCategories);
    $db->exec($insertRaridades);
    $db->exec($insertEstados);


}catch (PDOException $e){
    echo "Error on Migrating: " . $e->getMessage();
    exit;
}
$db = null;

function Migrate_App($db_file)
{
    try {

    }catch (PDOException $e){
        echo "Error on Migrating: " . $e->getMessage();
    }
    $db = null;
}