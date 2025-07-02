DROP TABLE IF EXISTS public.atividade CASCADE;
DROP TABLE IF EXISTS public.players CASCADE;
DROP TABLE IF EXISTS public.users CASCADE;

CREATE TABLE public.atividade (
                                  id SERIAL PRIMARY KEY,
                                  nome character varying(40),
                                  data character varying(40),
                                  tipo character varying(15),
                                  operador integer
);

CREATE TABLE public.players (
                                id SERIAL PRIMARY KEY,
                                nome character varying(255) NOT NULL,
                                data_nascimento date,
                                peso numeric(5,2),
                                altura numeric(3,2),
                                posicao character varying(3),
                                clube character varying(255),
                                aceleracao integer,
                                pique integer,
                                finalizacao integer,
                                forca_do_chute integer,
                                chute_de_longe integer,
                                penalti integer,
                                visao_de_jogo integer,
                                cruzamento integer,
                                passe_curto integer,
                                passe_longo integer,
                                curva integer,
                                agilidade integer,
                                equilibrio integer,
                                reacao integer,
                                controle_de_bola integer,
                                drible integer,
                                agressividade integer,
                                interceptacao integer,
                                precisao_no_cabeceio integer,
                                nocao_defensiva integer,
                                desarme integer,
                                carrinho integer,
                                impulsao integer,
                                folego integer,
                                forca integer,
                                nacionalidade character varying(100),
                                imagem character varying(255)
);

CREATE TABLE public.users (
                              id integer GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
                              type_user integer NOT NULL,
                              nome text NOT NULL,
                              senha character varying(155) NOT NULL,
                              email character varying(155) NOT NULL UNIQUE,
                              telefone character varying(20),
                              data_nascimento date,
                              cidade character varying(50),
                              estado character varying(5),
                              endereco character varying(50)
);

INSERT INTO public.users (type_user, nome, senha, email, telefone, data_nascimento, cidade, estado, endereco)
VALUES (1, 'admin', '$2y$10$QHkQ8apHdBN9/fcHPAGZL.2FnzQeNYwQhKfjEmGtuya00.uCBmfUK', 'admin@admin.com', 'admin_tel', '2025-05-01', 'Chapecó', 'SC', 'Casa do Admin');
