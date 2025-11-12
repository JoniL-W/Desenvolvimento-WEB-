
CREATE TABLE dispositivos (
    id_dispositivo SERIAL PRIMARY KEY,
    nome_dispositivo VARCHAR(100) NOT NULL,
    status_dispositivo VARCHAR(10) NOT NULL CHECK (status_dispositivo IN ('ativo', 'inativo'))
);

CREATE TABLE perguntas (
    id_pergunta SERIAL PRIMARY KEY,
    texto_pergunta TEXT NOT NULL,
    status_pergunta VARCHAR(10) NOT NULL CHECK (status_pergunta IN ('ativa', 'inativa'))
);


CREATE TABLE setores (
    id_setor SERIAL PRIMARY KEY,
    nome_setor VARCHAR(100) NOT NULL
);

CREATE TABLE avaliacoes (
    id_avaliacao SERIAL PRIMARY KEY,
    id_setor INT NOT NULL REFERENCES setores(id_setor) ON DELETE CASCADE,
    id_pergunta INT NOT NULL REFERENCES perguntas(id_pergunta) ON DELETE CASCADE,
    id_dispositivo INT NOT NULL REFERENCES dispositivos(id_dispositivo) ON DELETE CASCADE,
    resposta INT NOT NULL CHECK (resposta BETWEEN 0 AND 10),
    feedback_textual TEXT,
    data_hora TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE usuarios_admin (
    id_usuario SERIAL PRIMARY KEY,
    login VARCHAR(50) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL
);


INSERT INTO perguntas (texto_pergunta, status_pergunta) VALUES
('Como você avalia a cordialidade e o atendimento dos funcionários?', 'ativa'),
('O tempo de espera para ser atendido foi satisfatório?', 'ativa'),
('Os serviços oferecidos atenderam às suas expectativas?', 'ativa'),
('Como você avalia a limpeza e organização do ambiente?', 'ativa'),
('Os equipamentos e instalações estavam em bom estado de conservação?', 'ativa'),
('Você considera que o setor visitado foi eficiente no atendimento?', 'ativa'),
('De forma geral, qual é o seu nível de satisfação com o estabelecimento?', 'ativa');

INSERT INTO setores (id_setor,nome_setor) VALUES 
(1,'Atendimento'),
(2,'Serviçoes');

INSERT INTO dispositivos(id_dispositivo,nome_dispositivo,status_dispositivo) VALUES
(1,'Estacionamento','ativo'),
(2,'Espaço interno','ativo');
