-- Banco de dados: gestormax
CREATE DATABASE IF NOT EXISTS gestormax;
USE gestormax;

-- --------------------------------------------------------
-- Tabela: categorias
CREATE TABLE IF NOT EXISTS categorias (
  categoria_id INT(11) NOT NULL AUTO_INCREMENT,
  nome VARCHAR(100) NOT NULL,
  PRIMARY KEY (categoria_id),
  UNIQUE KEY nome (nome)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------
-- Tabela: produtos
CREATE TABLE IF NOT EXISTS produtos (
  id INT(11) NOT NULL AUTO_INCREMENT,
  nome VARCHAR(100) NOT NULL,
  categoria_id INT(11) DEFAULT NULL,
  quantidade_inicial INT(11) NOT NULL,
  quantidade_minima INT(11) NOT NULL,
  custo DECIMAL(10,2) NOT NULL,
  valor_venda DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (id),
  KEY categoria_id (categoria_id),
  FOREIGN KEY (categoria_id) REFERENCES categorias (categoria_id)
    ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------
-- Tabela: usuarios
CREATE TABLE IF NOT EXISTS usuarios (
  idname INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  nickname VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  typePerfil VARCHAR(255) NOT NULL,
  status VARCHAR(255) NOT NULL,
  senha VARCHAR(255) NOT NULL,
  PRIMARY KEY (idname),
  UNIQUE KEY email (email),
  UNIQUE KEY nickname (nickname)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------
-- Tabela: entradas (entrada de produtos no estoque)
CREATE TABLE IF NOT EXISTS entradas (
  entrada_id INT NOT NULL AUTO_INCREMENT,
  produto_id INT NOT NULL,
  usuario_id INT NOT NULL,
  data_entrada DATE NOT NULL,
  quantidade INT NOT NULL,
  PRIMARY KEY (entrada_id),
  FOREIGN KEY (produto_id) REFERENCES produtos (id)
    ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (usuario_id) REFERENCES usuarios (idname)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------
-- Tabela: vendas
CREATE TABLE IF NOT EXISTS vendas (
  venda_id INT NOT NULL AUTO_INCREMENT,
  data_venda DATE NOT NULL,
  usuario_id INT NOT NULL,
  PRIMARY KEY (venda_id),
  FOREIGN KEY (usuario_id) REFERENCES usuarios (idname)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------
-- Tabela: itens_venda (itens vendidos por venda)
CREATE TABLE IF NOT EXISTS itens_venda (
  item_id INT NOT NULL AUTO_INCREMENT,
  venda_id INT NOT NULL,
  produto_id INT NOT NULL,
  quantidade INT NOT NULL,
  valor_unitario DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (item_id),
  FOREIGN KEY (venda_id) REFERENCES vendas (venda_id)
    ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (produto_id) REFERENCES produtos (id)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------
-- Inserção de exemplo (opcional)
INSERT INTO categorias (nome) VALUES ('hortifruti');

INSERT INTO produtos (nome, categoria_id, quantidade_inicial, quantidade_minima, custo, valor_venda)
VALUES ('Shampoo Anticaspa', 1, 100, 10, 8.50, 19.90);

INSERT INTO usuarios (name, nickname, email, typePerfil, status, senha)
VALUES ('Gabriel', 'gabriel.buffon', 'ga@gmail.com', 'admin', 'ativo', 'senha123');
