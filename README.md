# Ascend Stats

**Ascend Stats** � uma plataforma poderosa e intuitiva para **lan�amento, an�lise e visualiza��o de estat�sticas no futebol**. Criado para clubes, analistas e profissionais que querem transformar dados em decis�es.

![Ascend Stats banner](https://i.imgur.com/q3qK2mY.png)

---

## Funcionalidades principais

- **Insights visuais** com gr�ficos e dashboards interativos
- Suporte a m�tricas personalizadas e filtros din�micos
- Pronto para m�ltiplos usu�rios e dispositivos

---

## Objetivo

O **Ascend Stats** nasceu com o objetivo de **elevar a an�lise de desempenho no futebol brasileiro**, oferecendo 
uma ferramenta moderna, leve e acess�vel para equipes t�cnicas de todos os n�veis. Sua incr�vel capacidade na facilidade
de lan�amento e manipula��o de dados � seu diferencial quando o quesito � an�lise de dados esportivos.

---

## Tecnologias

- PHP moderno
- JavaScript
- MySQL
- Bootstrap (UI)
- CanvaJs 
- Git / GitHub

---

## Instala��o

1. Clone o projeto:
   ```bash
   git clone https://github.com/seu-usuario/meu-php-app.git
   cd meu-php-app
   docker compose build
   docker compose up -d
2. Insira via banco de dados o seu primeiro usu�rio
   ```bash
   INSERT INTO users (
      type_user, nome, senha, email, telefone, data_nascimento, cidade, estado, endereco
   ) VALUES (
      1, 'Seu nome', 'Sua senha', 'Seu e-mail',
      'telefone', '2005-07-02', 'Cidade', 'SC', 'endereco'
   );

3. Acesse via navegador
   ```bash
   localhost:8080/index.php
   // utilize o email e a senha que voc� cadastrou