CREATE DATABASE sistema_carne;
USE sistema_carne;

CREATE TABLE IF NOT EXISTS tbl_carne (
	id INT AUTO_INCREMENT PRIMARY KEY,
    valor_total INT NOT NULL,
    qtd_parcelas INT NOT NULL,
    data_primeiro_vencimento DATETIME NOT NULL,
    periodicidade ENUM("mensal", "semanal"),
    valor_entrada INT
);


