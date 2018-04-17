# Desenvolvimento de Aplicações Web

**Data de Apresentação: 24/08/2017**

**Arthur, Lucas, Wender**

# Proposta

Nossa ideia consiste em um sistema de doações inspirado no *Kickstarter*. Ele será composto por doações online com o intuito de angariar fundos para ações sociais. O usuário poderá fazer solicitações de abertura de doações online, verificar seu histórico com suas atividades e também fazer doações. O administrador será responsável por avaliar os pedidos de publicações de pedidos online.

## Usuário

**1. Solitação de abertura de doações online - PRIMEIRO**

A página de solitação irá conter: finalidade do pedido; valor mínimo; meta da quantia; organização(opcional).

**2. Histórico de doações - QUARTO**

O usuário poderar acessar uma página do site onde haverá seu histórico, composto pelas doações em andamento e encerradas.

**3. Realizar doações - TERCEIRO**

Ao acessar um pedido de doação, o usuário terá uma área a mais onde poderá realizar a doação colocando o valor e confirmando a doação.

## Administrador

**1. Avaliar pedidos - SEGUNDO**

Haverá uma página onde o administrador poderá acessar uma lista de pedidos pendentes e acessá-los para poder avaliar optando por aprová-lo ou reprová-lo.

**2. Histórico de avaliações - QUINTO**

Página com registro de avaliações, informando como ela é e qual administrador avaliou, data e hora.

## Desenvolvimento de um Sistema de Informação

A web abriu um nova forma de interação entre as pessoas. Entre suas características, a web se destaca por sua alta escalabilidade e acessibilidade. Não há nenhuma outra plataforma tecnológica no mundo que permite a interação entre seus usuários nos moldes como acontece na web. Tal estrutura permitiu que a sociedade, de forma autônoma, se engajasse em torno de causas importantes porém relegados por seus representantes, tais como: mobilidade urbana, assistência social, organização e promoção de eventos, etc.

Este trabalho tem como objetivo mostrar ao aluno que os conhecimentos adquiridos na disciplina de Desenvolvimento de Aplicações Web podem ser utilizados em pról de tais causas. Mais especificamente, espera-se que através deste trabalho o aluno identifique um problema real vivenciado por ele e proponha uma solução para este problema envolvendo o desenvolvimento de um sistema web.

# Requisitos

Independentemente do tema escolhido pelo grupo, seu trabalho deverá cumprir **obrigatóriamente** as seguintes restrições:

1. **Sistema de identificação dos usuários:** Seu sistema deverá ser capaz de identificar unicamente seus usuários através de um mecanismo de login.

2. **Suporte a pelo menos dois atores distintos:** Seu sistema deverá suportar a atuação de pelo menos dois atores distintos com suas respectivas ações (ex.: usuário e administrador).

3. **Solução deverá conter pelo menos quatro requisitos:** Sua solução deverá implementar pelo menos quatro requisitos no formato de funcionalidades.

4. **Armazenamento no formato de arquivos texto:** Seu sistema deverá armazenar suas informações no utilizando arquivos texto.
	* É claro que você poderá utilizar formas automatizadas para recuperar e armazenar os dados, tais como formatos estruturados de armazenamento (XML ou JSON).

## Cronograma

O trabalho será avaliado parcialmente, conforme cronograma definido abaixo. Essa organização permite ao aluno não se perder durante o desenvolvimento do sistema, uma vez que provê uma estimativa confiável de cumprimento do prazo do trabalho.

| Data       | O que deve ser entregue?                        | Valor     | TAG   |
|------------|-------------------------------------------------|-----------|-------|
| 27/06/2017 | Grupo, Tema & Requisitos                        | --        | --    |
| 04/07/2017 | Sprint 01: Protótipos HTML de dois requisitos   | 02 pontos | HTML  |
| 13/07/2017 | Sprint 02: Implementação do requisito R1        | 02 pontos | R1    |
| 01/08/2017 | Sprint 03: Implementação dos requisitos R2 e R3 | 04 pontos | R2/R3 |
| 08/08/2017 | Sprint 04: Implementação do requisito R4        | 02 pontos | R4    |
| 17/08/2017 | Sprint 05: Implementação da autenticação        | 02 pontos | Auth  |
| 24/08/2017 | Apresentação do trabalho                        | 05 pontos | 1.0   |


* **27/06/2017:** O grupo deverá fazer um fork deste repositório e alterar o `README.md` do projeto de forma a incluir os componmentes do grupo, qual foi o tema selecionado, e quais requisitos seu sistema irá implementar.
* **04/07/2017:** O grupo deverá implementar o protótipo em HTML de dois requisitos selecionados anteriormente. É importante que o grupo converse com o professor para decidir quais requisitos são mais fáceis de se prototipar e implementar primeiro.
* **13/07/2017:** O grupo deverá implementar pelo menos um dos requisitos prototipados anteriormente.
* **01/08/2017:** O grupo deverá implementar pelo menos dois requisitos do sistema, somando três requisitos implementados no total.
* **08/08/2017:** O grupo deverá ter implementado todos os requisitos do sistema.
* **17/08/2017:** O grupo deverá ter implementado os mecanimos de autenticação e identificação dos usuários do sistema.
* **24/08/2017:** Apresentação do trabalho final em sala de aula.

As entregas deverão ser marcadas com tags do próprio Git, indicadas na tabela acima. Leia sobre tags [aqui](http://imasters.com.br/artigo/21127/software-livre/como-trabalhar-com-tags-no-git/?trace=1519021197&source=single).

## Apresentação

A apresentação do trabalho ocorrerá no dia **24/08/2017**. Você deverá apresentar seu trabalho para seus colegas de turma junto de uma **banca de avaliação** que irá avaliar seu trabalho.

A banca de avaliação contará, a princípio, com **um especialista no desenvolvimento de software** que irá avaliar principalmente os aspectos internos do sistema (código, estruturação, etc.) e **um usuário comum**, que irá avaliar principalmente os aspectos externos do sistema (design, usabilidade, etc.).

A apresentação será dividida em duas partes:

* **Explicação:** Apresentação sobre o sistema, principais funcionalidades, o que foi implementado, o que foi usado, etc. etc.
* **Demonstração:** Você irá executar o seu sistema e mostrar o funcionamento dos requisitos implementados.

## Pilha de Tecnologias

Você estará livre para utilizar as bibliotecas e frameworks que considerar necessários. O uso de tais recursos inclusive é incentivado!!

Contudo, o desenvolvimento do trabalho **deve** englobar, de alguma forma, os seguintes conceitos:

* HTML
* CSS/SCSS
* JavaScript
* PHP: Classes, funções, etc.
* PHP: Sessões e Cookies
* PHP: Arquivos

## Composição dos grupos

Os grupos deverão, **obrigatóriamente**, ser compostos por alunos das duas extintas subturmas (103 e 106).
