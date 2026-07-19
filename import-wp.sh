#!/bin/bash
# Script gerado pelo import-blogger.py
# Execute: bash import-wp.sh

WP="/Applications/Local.app/Contents/Resources/extraResources/bin/wp-cli/posix/wp"
export MYSQL_HOME="/Users/tarcisio/Library/Application Support/Local/run/ZbAP20zeY/conf/mysql"
export PHPRC="/Users/tarcisio/Library/Application Support/Local/run/ZbAP20zeY/conf/php"
export PATH="/Users/tarcisio/Library/Application Support/Local/lightning-services/mysql-8.4.0/bin/darwin-arm64/bin:$PATH"
export PATH="/Users/tarcisio/Library/Application Support/Local/lightning-services/php-8.2.29+0/bin/darwin-arm64/bin:$PATH"

echo "Importando posts..."

echo '  [1/375] publicacao: PROGRAMA UNIGOU SCIENTIFIC TRAINING ABRE INSCRIÇÕE...'
$WP post create --post_type="publicacao" --post_title="PROGRAMA UNIGOU SCIENTIFIC TRAINING ABRE INSCRIÇÕES PARA JULHO 2026" --post_status="publish" --post_content="$(cat /tmp/wp-post-0.html)" --post_date="2026-05-27T06:34:27.358-07:00" --post_excerpt="O Instituto Tcheco-Brasileiro para Cooperação Acadêmica (INCBAC) tem a satisfação de comunicar a abertura das inscrições para o Programa UNIGOU Scientific Training, com início em Julho de 2026. O Programa contempla estudantes universitários e jovens pesquisadores brasileiros que tenham interesse em"
rm -f /tmp/wp-post-0.html

echo '  [2/375] publicacao: PUBLICADO O EDITAL DE MOBILIDADE ACADÊMICA NA UFSC...'
$WP post create --post_type="publicacao" --post_title="PUBLICADO O EDITAL DE MOBILIDADE ACADÊMICA NA UFSCAR" --post_status="publish" --post_content="$(cat /tmp/wp-post-1.html)" --post_date="2026-05-25T10:07:59.354-07:00" --post_excerpt="Compartilho a notícia de publicação e o link de acesso ao Edital de Mobilidade Acadêmica na UFSCAR do qual podem participar os alunos regularmente matriculados nos cursos de graduação da UFRB e das demais universidades federais do Brasil. Destacamos a relevância da mobilidade acadêmica para a for..."
rm -f /tmp/wp-post-1.html

echo '  [3/375] livro: O HOMEM QUE NÃO SABIA SER SANTO - Adquira o seu!...'
$WP post create --post_type="livro" --post_title="O HOMEM QUE NÃO SABIA SER SANTO - Adquira o seu!" --post_status="publish" --post_content="$(cat /tmp/wp-post-2.html)" --post_date="2026-05-19T13:44:13.129-07:00" --post_excerpt="Há livros que nascem para inquietar. Outros, para provocar espanto, reflexão e silêncio. O homem que não sabia ser santo, de Irenilson de Jesus Barbosa, é uma dessas obras que nos convidam a atravessar zonas sensíveis da existência, entre humanidade, desejo, contradição e busca de sentido.

A obra"
rm -f /tmp/wp-post-2.html

echo '  [4/375] post: Seleção Interna de Bolsista e Voluntários para o P...'
$WP post create --post_type="post" --post_title="Seleção Interna de Bolsista e Voluntários para o Projeto de Extensão HABILITÀ na UFRB" --post_status="publish" --post_content="$(cat /tmp/wp-post-3.html)" --post_date="2026-05-19T11:57:17.457-07:00" --post_excerpt="O Projeto de Extensão HABILITÀ, da Universidade Federal do Recôncavo da Bahia (UFRB), coordenado pelo Dr. Irenilson de Jesus Barbosa, torna pública a abertura de seleção interna de discentes para atuação como bolsista e extensionistas voluntários(as), em conformidade com o edital vigente do PIBEX" --post_category='educacao'
rm -f /tmp/wp-post-3.html

echo '  [5/375] post: "CANDIDATO DE DEUS", "CANDIDATO DO DIABO" E "FALSO...'
$WP post create --post_type="post" --post_title="\"CANDIDATO DE DEUS\", \"CANDIDATO DO DIABO\" E \"FALSO MESSIAS\": CAMPANHA ELEITORAL EXPÕE PRECONCEITOS E DESCONHECIMENTO BÍBLICO" --post_status="publish" --post_content="$(cat /tmp/wp-post-4.html)" --post_date="2022-10-05T09:44:00.000-07:00" --post_excerpt="A campanha eleitoral em 2022, sobretudo no que se refere à disputa pela Presidência da República, tem deixado evidente o uso político-partidário da religião no Brasil. Os absurdos vão desde a divulgação de fake news à adoção de um candidato pelos segmentos religiosos mais conservadores e fundamen..." --post_category='filosofia'
rm -f /tmp/wp-post-4.html

echo '  [6/375] post: Projeto de Extensão da UFRB promove OFICINA EDUCAT...'
$WP post create --post_type="post" --post_title="Projeto de Extensão da UFRB promove OFICINA EDUCATIVA \"A LIBRAS EM CENA 2\"" --post_status="publish" --post_content="$(cat /tmp/wp-post-5.html)" --post_date="2022-07-29T09:46:00.000-07:00" --post_excerpt="O Projeto de Extensão Tessituras Recôncavas e Inclusões Reconvexas, realizará neste dia 29/07/2022, das 17:00 às 19:00, pelo Google Meet, a OFICINA EDUCATIVA \"A LIBRAS EM CENA 2\" ministrada pela Profa. Me. Poliana da Silva Lima Andrade, docente da UFRB. Trata-se da segunda parte da Oficina Educati" --post_category='educacao'
rm -f /tmp/wp-post-5.html

echo '  [7/375] publicacao: Universidade Federal do Recôncavo da Bahia (UFRB) ...'
$WP post create --post_type="publicacao" --post_title="Universidade Federal do Recôncavo da Bahia (UFRB) comemora 17 anos e lança campanha 'Sim ao Futuro'" --post_status="publish" --post_content="$(cat /tmp/wp-post-6.html)" --post_date="2022-07-29T09:21:00.000-07:00" --post_excerpt="A Universidade Federal do Recôncavo da Bahia (UFRB) completa 17 anos de criação neste 29 de julho de 2022 e diz \"Sim ao Futuro\". Criada em 2005, a UFRB se consolidou nacionalmente como uma universidade inclusiva, de qualidade e socialmente referenciada.

Fincada nos territórios do Recôncavo, Portal"
rm -f /tmp/wp-post-6.html

echo '  [8/375] post: Projeto de Extensão da UFRB promove OFICINA EDUCAT...'
$WP post create --post_type="post" --post_title="Projeto de Extensão da UFRB promove OFICINA EDUCATIVA \"A LIBRAS EM CENA\" em 01/07/22" --post_status="publish" --post_content="$(cat /tmp/wp-post-7.html)" --post_date="2022-06-20T08:31:00.000-07:00" --post_excerpt="O Projeto de Extensão Tessituras Recôncavas e Inclusões Reconvexas, estará realizando em 01/07/2022, das 17:00 às 19:00, pelo Google Meet, a OFICINA EDUCATIVA \"A LIBRAS EM CENA\" ministrada pela Profa. Me. Poliana da Silva Lima Andrade, docente da UFRB. O público-alvo será composto por discentes p" --post_category='filosofia'
rm -f /tmp/wp-post-7.html

echo '  [9/375] post: RODA DE CONVERSA "PENSAMENTO AFRICANO: INTERFACES ...'
$WP post create --post_type="post" --post_title="RODA DE CONVERSA \"PENSAMENTO AFRICANO: INTERFACES PARADOXAIS ENTRE A DESOBEDIÊNCIA E A \"NORMATIVIDADE EPISTÊMICA\"" --post_status="publish" --post_content="$(cat /tmp/wp-post-8.html)" --post_date="2022-06-10T08:17:00.000-07:00" --post_excerpt="Como lidar com um modo de pensar secular que, ao longo da história do pensamento científico e filosófico, colocou o Pensar e o Ser Africano à margem dos cânones da razão universa? Nossa asserção é de que a principal característica de qualquer saber filosófico é o pensamento. Saber lidar com a norma" --post_category='educacao'
rm -f /tmp/wp-post-8.html

echo '  [10/375] post: CAPOEIRA E EDUCAÇÃO: LIMITES E POSSIBILIDADES PARA...'
$WP post create --post_type="post" --post_title="CAPOEIRA E EDUCAÇÃO: LIMITES E POSSIBILIDADES PARA EMANCIPAÇÃO HUMANA" --post_status="publish" --post_content="$(cat /tmp/wp-post-9.html)" --post_date="2022-06-09T09:51:00.003-07:00" --post_excerpt="O Projeto de Extensão Tessituras Recôncavas e Inclusões Reconvexas, vinculado ao Centro de Formação de Professores da Universidade Federal do Recôncavo da Bahia (UFRB), sob a coordenação do Prof. Dr. Irenilson de Jesus Barbosa, estará realizando na próxima quarta-feira, 15/06/2022, das 17:00 às 19" --post_category='educacao'
rm -f /tmp/wp-post-9.html

echo '  [11/375] post: BOLSA DE ESTUDOS PARA AFRODESCENDENTES NA SUÍÇA...'
$WP post create --post_type="post" --post_title="BOLSA DE ESTUDOS PARA AFRODESCENDENTES NA SUÍÇA" --post_status="publish" --post_content="$(cat /tmp/wp-post-10.html)" --post_date="2022-06-09T09:21:00.000-07:00" --post_excerpt="Até 15 de junho de 2022 é possível se inscrever para uma bolsa para afrodescendentes da ONU. O programa oferece bolsas para um curso sobre direitos humanos em Genebra, na Suíça. O curso acontece de 21 de novembro a 9 de dezembro de 2022.  O Programa Anual de Bolsa para afrodescendentes é parte das" --post_category='cultura'
rm -f /tmp/wp-post-10.html

echo '  [12/375] post: PROPAAE LANÇA EDITAL 001/2022 PARA CADASTRAMENTO D...'
$WP post create --post_type="post" --post_title="PROPAAE LANÇA EDITAL 001/2022 PARA CADASTRAMENTO DE BOLSISTAS VINCULADAS/OS AO PROGRAMA DE PERMANÊNCIA QUALIFICADA DA UFRB" --post_status="publish" --post_content="$(cat /tmp/wp-post-11.html)" --post_date="2022-02-21T13:45:00.000-08:00" --post_excerpt="A Pró-reitoria de Políticas Afirmativas e Assuntos Estudantis lançou o Edital 001/2022 que dispõe sobre o cadastramento no SIGAA (Portal do Discente/aba Bolsas) das/os estudantes da graduação presencial, vinculadas/os ao Programa de Permanência Qualificada – PPQ, beneficiárias/os ativas/os das moda" --post_category='filosofia'
rm -f /tmp/wp-post-11.html

echo '  [13/375] livro: VI Congresso Baiano de Educação Inclusiva e IV Sim...'
$WP post create --post_type="livro" --post_title="VI Congresso Baiano de Educação Inclusiva e IV Simpósio Brasileiro de Educação Especial - 18 a 20/10/2021" --post_status="publish" --post_content="$(cat /tmp/wp-post-12.html)" --post_date="2021-08-26T08:50:00.001-07:00" --post_excerpt="#pracegover #pratodosverem #audiodescrição: Card de divulgação do VI Congresso Baiano de Educação Inclusiva e IV Simpósio Brasileiro de Educação Especial com o tema “Educação Especial em tempos de transformação”. Dias 18, 19 e 20 de outubro de 2021. Evento online transmitido a partir de Salvador,"
rm -f /tmp/wp-post-12.html

echo '  [14/375] material: FORUMDIR e mais 15 entidades repudiam Edital e Pro...'
$WP post create --post_type="material" --post_title="FORUMDIR e mais 15 entidades repudiam Edital e Programa do MEC sobre formação de professores e gestores escolares" --post_status="publish" --post_content="$(cat /tmp/wp-post-13.html)" --post_date="2021-07-07T08:01:00.004-07:00" --post_excerpt="Em recente Portaria de 17 de junho de 2021, o Ministério da Educação instituiu o Programa Institucional de Fomento e Indução da Inovação da Formação Inicial Continuada de Professores e Diretores Escolares, com o objetivo principal de promover a adequação da Pedagogia e das Licenciaturas à BNCC, aos"
rm -f /tmp/wp-post-13.html

echo '  [15/375] material: PROJETO DE EXTENSÃO APROVADO NO EDITAL PIBEX - EST...'
$WP post create --post_type="material" --post_title="PROJETO DE EXTENSÃO APROVADO NO EDITAL PIBEX - ESTUDANTES PODEM CONCORRER A BOLSAS!" --post_status="publish" --post_content="$(cat /tmp/wp-post-14.html)" --post_date="2021-04-14T10:49:00.001-07:00" --post_excerpt="O Projeto de Extensão \"TESSITURAS RECONCAVAS E INCLUSÕES RECONVEXAS\" proposto e coordenado pelo Prof. Irenilson de Jesus Barbosa foi aprovado para concorrer a bolsas do Edital PIBEX 2021. Caso você tenha interesse em participar da seleção para este e demais projetos, confira as informações e link..."
rm -f /tmp/wp-post-14.html

echo '  [16/375] material: DEPOIS DA QUEDA, O COICE...'
$WP post create --post_type="material" --post_title="DEPOIS DA QUEDA, O COICE" --post_status="publish" --post_content="$(cat /tmp/wp-post-15.html)" --post_date="2021-01-28T04:09:00.002-08:00" --post_excerpt="Pr. Idenilton Barbosa

(O texto abaixo, usado com permissão do autor, representa a opinião desse blog sobre o pronunciamento da CBB, assinado pelo seu presidente, declarando que a mesma não assinou o histórico pedido de impeachment de Jair Bolsonaro junto com outras entidades religiosas do Brasil."
rm -f /tmp/wp-post-15.html

echo '  [17/375] post: CALENDÁRIO ACADÊMICO SUPLEMENTAR NA UFRB...'
$WP post create --post_type="post" --post_title="CALENDÁRIO ACADÊMICO SUPLEMENTAR NA UFRB" --post_status="publish" --post_content="$(cat /tmp/wp-post-16.html)" --post_date="2020-09-15T08:11:00.000-07:00" --post_excerpt="Depois de longo e tenebroso inverno pandêmico (que ainda persiste, apesar da primavera dos negacionistas e dos que gostam de viver perigosamente), estamos reiniciando nesta semana as atividades acadêmicas de Ensino Remoto na UFRB. O Calendário Acadêmico Suplementar 2020.3 se desenvolverá no período" --post_category='educacao'
rm -f /tmp/wp-post-16.html

echo '  [18/375] post: NATAL DOS COVARDES...'
$WP post create --post_type="post" --post_title="NATAL DOS COVARDES" --post_status="publish" --post_content="$(cat /tmp/wp-post-17.html)" --post_date="2019-12-23T16:15:00.000-08:00" --post_excerpt="Escrito por Marcelo Freixo.

O que diriam os pregadores da intolerância, os obreiros do justiçamento, os apóstolos do olho por olho dente por dente sobre um homem que manifestou seu amor por um ladrão condenado e lhe prometeu o paraíso?

Brandiriam o velho sermonário: bandido bom é bandido morto?" --post_category='filosofia'
rm -f /tmp/wp-post-17.html

echo '  [19/375] material: RESULTADO FINAL DA SELEÇÃO PARA PRECEPTORES DA RES...'
$WP post create --post_type="material" --post_title="RESULTADO FINAL DA SELEÇÃO PARA PRECEPTORES DA RESIDÊNCIA PEDAGÓGICA - SUBPROJETO DE PEDAGOGIA NA UFRB" --post_status="publish" --post_content="$(cat /tmp/wp-post-18.html)" --post_date="2018-07-13T13:51:00.001-07:00" --post_excerpt="Confira abaixo o RESULTADO FINAL DO PROCESSO SELETIVO PARA PRECEPTORES NO PROGRAMA DE RESIDÊNCIA PEDAGÓGICA (RESPED) no SUBPROJETO DO CURSO DE LICENCIATURA EM PEDAGOGIA do Centro de Formação de Professores (CFP) da Universidade Federal do Recôncavo da Bahia (UFRB) publicado no site do Centro de For"
rm -f /tmp/wp-post-18.html

echo '  [20/375] post: INSCRIÇÕES HOMOLOGADAS NA SELEÇÃO PARA PRECEPTORES...'
$WP post create --post_type="post" --post_title="INSCRIÇÕES HOMOLOGADAS NA SELEÇÃO PARA PRECEPTORES DA RESIDÊNCIA PEDAGÓGICA - SUBPROJETO DE PEDAGOGIA NA UFRB" --post_status="publish" --post_content="$(cat /tmp/wp-post-19.html)" --post_date="2018-07-12T18:23:00.002-07:00" --post_excerpt="Confira abaixo as INSCRIÇÕES HOMOLOGADAS NO PROCESSO SELETIVO PARA PRECEPTORES DO PROGRAMA DE RESIDÊNCIA PEDAGÓGICA (RESPED), NO SUBPROJETO DO CURSO DE LICENCIATURA EM PEDAGOGIA no Centro de Formação de Professores da UFRB (Amargosa, Bahia).




 
 
 
 

 
 Normal
 0
 false
 
 21
 
 
 false
 false" --post_category='educacao'
rm -f /tmp/wp-post-19.html

echo '  [21/375] post: RESULTADO FINAL DO PROCESSO SELETIVO PARA RESIDENT...'
$WP post create --post_type="post" --post_title="RESULTADO FINAL DO PROCESSO SELETIVO PARA RESIDENTES NO PROGRAMA DE RESIDÊNCIA PEDAGÓGICA (RESPED) SUBPROJETO DE PEDAGOGIA[1]" --post_status="publish" --post_content="$(cat /tmp/wp-post-20.html)" --post_date="2018-07-09T15:45:00.000-07:00" --post_excerpt="Normal
 0
 false
 
 21
 
 
 false
 false
 false
 
 PT-BR
 X-NONE
 X-NONE" --post_category='educacao'
rm -f /tmp/wp-post-20.html

echo '  [22/375] publicacao: RESULTADO PRELIMINAR DA SELEÇÃO PARA RESIDÊNCIA PE...'
$WP post create --post_type="publicacao" --post_title="RESULTADO PRELIMINAR DA SELEÇÃO PARA RESIDÊNCIA PEDAGÓGICA - SUBPROJETO DE LICENCIATURA EM PEDAGOGIA" --post_status="publish" --post_content="$(cat /tmp/wp-post-21.html)" --post_date="2018-07-07T14:17:00.000-07:00" --post_excerpt="Confira abaixo o resultado preliminar da Seleção de Residentes para o Programa Residência Pedagógica - Subprojeto de Licenciatura em Pedagogia no centro de Formação de Professores de acordo com o Edital RP/CFP nº. 01/2018 e o Edital CAPES 06/2018 que regem o processo e o Programa, respectivamente..."
rm -f /tmp/wp-post-21.html

echo '  [23/375] material: EDITAL DE SELEÇÃO PARA PRECEPTORES DO PROGRAMA RES...'
$WP post create --post_type="material" --post_title="EDITAL DE SELEÇÃO PARA PRECEPTORES DO PROGRAMA RESIDÊNCIA PEDAGÓGICA NO CFP/UFRB" --post_status="publish" --post_content="$(cat /tmp/wp-post-22.html)" --post_date="2018-07-07T07:01:00.002-07:00" --post_excerpt="Estão abertas as inscrições para Processo Seletivo de Preceptores para atuarem no Programa Residência Pedagógica nos Subprojetos localizados no Centro de Formação de Professores da UFRB. O período de inscrição é de 06 a 09 de julho de 2018. Confira os detalhes, clicando no link abaixo para acessa..."
rm -f /tmp/wp-post-22.html

echo '  [24/375] post: HOMOLOGAÇÃO FINAL DAS INSCRIÇÕES NO PROCESSO SELET...'
$WP post create --post_type="post" --post_title="HOMOLOGAÇÃO FINAL DAS INSCRIÇÕES NO PROCESSO SELETIVO PARA RESIDENTES DO PROGRAMA RESIDÊNCIA PEDAGÓGICA - SUBPROJETO DE PEDAGOGIA DO CFP/UFRB" --post_status="publish" --post_content="$(cat /tmp/wp-post-23.html)" --post_date="2018-07-05T17:54:00.000-07:00" --post_excerpt="Normal
 0
 
 
 21
 
 
 false
 false
 false
 
 PT-BR
 X-NONE
 X-NONE" --post_category='educacao'
rm -f /tmp/wp-post-23.html

echo '  [25/375] post: HOMOLOGAÇÃO DOS INSCRITOS NO SUBPROJETO DE PEDAGOG...'
$WP post create --post_type="post" --post_title="HOMOLOGAÇÃO DOS INSCRITOS NO SUBPROJETO DE PEDAGOGIA DA RESIDÊNCIA PEDAGÓGICA NO CFP DA UFRB" --post_status="publish" --post_content="$(cat /tmp/wp-post-24.html)" --post_date="2018-07-03T14:48:00.000-07:00" --post_excerpt="Normal
 0
 
 
 21
 
 
 false
 false
 false
 
 PT-BR
 X-NONE
 X-NONE
 
 
 
 
 
 
 
 
 
 
 
 
 
 MicrosoftInternetExplorer4" --post_category='educacao'
rm -f /tmp/wp-post-24.html

echo '  [26/375] post: LINKS PARA SEMINÁRIOS DE ORGANIZAÇÃO DA EDUCAÇÃO B...'
$WP post create --post_type="post" --post_title="LINKS PARA SEMINÁRIOS DE ORGANIZAÇÃO DA EDUCAÇÃO BRASILEIRA E POLÍTICAS PÚBLICAS" --post_status="publish" --post_content="$(cat /tmp/wp-post-25.html)" --post_date="2018-02-01T11:21:00.001-08:00" --post_excerpt="Prezad@s educand@s,






Bem-vind@s de volta às aulas de 2017.2 (o semestre que se recusa a acabar)! 







Conforme prometido, seguem
 os links com orientações e subsídios para as apresentações dos 
Seminários Temáticos em equipes nas aulas do componente curricular 
Organização da Educação Brasi" --post_category='filosofia'
rm -f /tmp/wp-post-25.html

echo '  [27/375] post: O QUE O GOLPE FARÁ DE NÓS?...'
$WP post create --post_type="post" --post_title="O QUE O GOLPE FARÁ DE NÓS?" --post_status="publish" --post_content="$(cat /tmp/wp-post-26.html)" --post_date="2016-05-12T09:50:00.000-07:00" --post_excerpt="Irenilson de Jesus Barbosa



Um terrível nó na garganta me assalta, após interromper os cuidados com a minha iminente defesa de tese para ouvir Dilma Roussef discursando e deixando o Palácio do Planalto, agora afastada por até 180 dias, a despeito de ser a presidente eleita. É um dia de trevas pa" --post_category='politica'
rm -f /tmp/wp-post-26.html

echo '  [28/375] publicacao: É Natal... Mas o Cristo que celebramos era branco ...'
$WP post create --post_type="publicacao" --post_title="É Natal... Mas o Cristo que celebramos era branco ou negro?" --post_status="publish" --post_content="$(cat /tmp/wp-post-27.html)" --post_date="2015-12-19T15:21:00.000-08:00" --post_excerpt="Às vésperas de mais uma celebração do Natal - onde muitos ocidentais já nem lembram que a festa tem como pretexto a celebração do nascimento de Jesus - editamos um texto intitulado \"O Natal rediscute a verdadeira imagem de Cristo: branco ou negro?\", publicado no site Conexão Jornalismo em 2014,"
rm -f /tmp/wp-post-27.html

echo '  [29/375] material: Publicada a Nova Norma ABNT de Acessibilidade a Ed...'
$WP post create --post_type="material" --post_title="Publicada a Nova Norma ABNT de Acessibilidade a Edificações, Mobiliário, Espaços e Equipamentos Urbanos" --post_status="publish" --post_content="$(cat /tmp/wp-post-28.html)" --post_date="2015-09-22T13:21:00.001-07:00" --post_excerpt="NBR 9050 - versão 2015
 



 


\"Saiu a nova norma 
 de acessibilidade! Foi publicada pelo 
 Comitê Brasileiro de Acessibilidade da ABNT a 
 revisão e atualização da Norma de Acessibilidade a 
 Edificações, Mobiliário, Espaços e Equipamentos 
 Urbanos, a NBR 9050. As normas de acessibilidade são"
rm -f /tmp/wp-post-28.html

echo '  [30/375] livro: Dia de Luta da Pessoa com Deficiência e I Semana C...'
$WP post create --post_type="livro" --post_title="Dia de Luta da Pessoa com Deficiência e I Semana Cultural Acessível em Salvador" --post_status="publish" --post_content="$(cat /tmp/wp-post-29.html)" --post_date="2015-09-17T16:23:00.002-07:00" --post_excerpt="Pessoas com deficiências celebram seu Dia de Luta (21/09) e podem apresentar atividades artísticas e participar de oficinas da I Semana Acessível em Salvador. O evento acontecerá no Espaço Xisto Bahia, no bairro dos Barris, em Salvador, nos dias 21 a 27 de setembro de 2015. Na UNEB, haverá uma Pal"
rm -f /tmp/wp-post-29.html

echo '  [31/375] post: CAPITALISMO MUNDIAL EM CRISE REVELA PERVERSIDADE D...'
$WP post create --post_type="post" --post_title="CAPITALISMO MUNDIAL EM CRISE REVELA PERVERSIDADE DO SEU SISTEMA DE DESIGUALDADES" --post_status="publish" --post_content="$(cat /tmp/wp-post-30.html)" --post_date="2015-09-04T07:44:00.000-07:00" --post_excerpt="Embarcações precárias abarrotadas de africanos atravessam os mares, tentando refúgio para pessoas vitimas das guerras, da fome e da miséria semeadas pelo capitalismo. (Foto 1)
..



Enquanto a mídia brasileira - que assumiu de vez a sua insensatez oposicionista e abriu mão da verdade na seletivi" --post_category='politica'
rm -f /tmp/wp-post-30.html

echo '  [32/375] publicacao: Estudante da UFRB vence I Prêmio Jovem Pequisador ...'
$WP post create --post_type="publicacao" --post_title="Estudante da UFRB vence I Prêmio Jovem Pequisador da Rede de Bancos de Leite Humano" --post_status="publish" --post_content="$(cat /tmp/wp-post-31.html)" --post_date="2015-08-18T15:52:00.001-07:00" --post_excerpt="A
 estudante Nayara Alves Reis, Bacharel em Biologia e Mestre 
Microbiologia Agrícola pela Universidade Federal do Recôncavo da Bahia 
(UFRB), foi uma das vencedoras do I Prêmio Jovem Pesquisador da Rede de Bancos de Leite Humano (rBLH).
 A discente do Centro de Ciências Agrárias Ambi"
rm -f /tmp/wp-post-31.html

echo '  [33/375] publicacao: UFRB abre inscrições para concurso de professor ef...'
$WP post create --post_type="publicacao" --post_title="UFRB abre inscrições para concurso de professor efetivo do CFP" --post_status="publish" --post_content="$(cat /tmp/wp-post-32.html)" --post_date="2015-08-03T10:00:00.002-07:00" --post_excerpt="A Universidade Federal do Recôncavo da Bahia (UFRB) divulga que estão 
abertas as inscrições do Concurso Público para Professor Efetivo do 
Centro de Formação de Professores (CFP), localizado em Amragosa. As inscrições são realizadas 
através da página eletrônica de concursos da UFRB até o dia 01 d"
rm -f /tmp/wp-post-32.html

echo '  [34/375] post: HÁ 391 ANOS ERA INSTALADO O TRIBUNAL DA INQUISIÇÃO...'
$WP post create --post_type="post" --post_title="HÁ 391 ANOS ERA INSTALADO O TRIBUNAL DA INQUISIÇÃO NO BRASIL" --post_status="publish" --post_content="$(cat /tmp/wp-post-33.html)" --post_date="2015-07-23T11:16:00.000-07:00" --post_excerpt="Ignorado pela grande mídia no Brasil - como tem sido comum nos verdadeiros temas de interesse nacional - ontem, 22 de julho, completaram-se 391 anos de um marco nas páginas mais sangrentas e absurdas da história religiosa, econômica e social no Brasil. Naquela data, 22 de julho de 1624, uma Carta-R" --post_category='filosofia'
rm -f /tmp/wp-post-33.html

echo '  [35/375] publicacao: IGREJAS DA CONVENÇÃO BATISTA BAIANA SE PRONUNCIAM ...'
$WP post create --post_type="publicacao" --post_title="IGREJAS DA CONVENÇÃO BATISTA BAIANA SE PRONUNCIAM SOBRE INTOLERÂNCIA E AFINS" --post_status="publish" --post_content="$(cat /tmp/wp-post-34.html)" --post_date="2015-07-07T10:07:00.000-07:00" --post_excerpt="Embora eu faça ressalvas a algumas afirmações e às ambiguidade perceptíveis em alguns trechos do documento, considero um importante avanço que a Convenção Batista Baiana, finalmente tenha se pronunciado sobre temas contemporâneos que afetam diretamente à nossa sociedade, alguns dos quais ameaçando"
rm -f /tmp/wp-post-34.html

echo '  [36/375] publicacao: IMPERIALISMO: O QUE ESTÁ POR TRÁS DA OFENSIVA DOS ...'
$WP post create --post_type="publicacao" --post_title="IMPERIALISMO: O QUE ESTÁ POR TRÁS DA OFENSIVA DOS EUA CONTRA A FIFA?" --post_status="publish" --post_content="$(cat /tmp/wp-post-35.html)" --post_date="2015-05-29T07:47:00.001-07:00" --post_excerpt="Compartilhamos abaixo duas matérias reveladoras dos reais interesses dos EUA na crise da FIFA. Na primeira, publicada no site UOL, John Shulman, professor de Harvard (foto), alerta sobre reais interesses dos EUA em escândalos financeiros que envolvem dirigentes da FIFA e outras entidades do futebo"
rm -f /tmp/wp-post-35.html

echo '  [37/375] post: OPORTUNIDADES NA UFRB: Inscrições ao BCET e apoio ...'
$WP post create --post_type="post" --post_title="OPORTUNIDADES NA UFRB: Inscrições ao BCET e apoio à participação em eventos." --post_status="publish" --post_content="$(cat /tmp/wp-post-36.html)" --post_date="2015-05-21T13:56:00.001-07:00" --post_excerpt="Divulgando algumas notícias 
de hoje na UFRB. 

Confira abaixo...

Abraço e cheiro!

PROGRAD divulga inscrições para segundo ciclo do BCET






A Pró-Reitoria de Graduação (PROGRAD) da Universidade Federal do Recôncavo da Bahia (UFRB) divulga que estão abertas as inscrições do segundo ciclo de" --post_category='filosofia'
rm -f /tmp/wp-post-36.html

echo '  [38/375] post: GREVE CANCELADA: Após assembléia, rodoviários canc...'
$WP post create --post_type="post" --post_title="GREVE CANCELADA: Após assembléia, rodoviários cancelam greve em Salvador" --post_status="publish" --post_content="$(cat /tmp/wp-post-37.html)" --post_date="2015-05-19T15:42:00.002-07:00" --post_excerpt="Categoria aprovou, nesta terça-feira (19/05), proposta da SRTE de 10% de reajuste. Empresários realizaram reunião e também aceitaram acordo.







Assembleia dos rodoviários realizada nesta tarde, em Salvador (Foto: Maiana Belo/G1)





Na segunda assembleia desta terça-feira (19), os rodoviário..." --post_category='filosofia'
rm -f /tmp/wp-post-37.html

echo '  [39/375] publicacao: CORRUPÇÃO NO METRÔ DE SALVADOR COMEÇOU NA GESTÃO D...'
$WP post create --post_type="publicacao" --post_title="CORRUPÇÃO NO METRÔ DE SALVADOR COMEÇOU NA GESTÃO DE IMBASSAHY (PSDB)" --post_status="publish" --post_content="$(cat /tmp/wp-post-38.html)" --post_date="2015-05-12T16:52:00.001-07:00" --post_excerpt="Comentando publicação da Folha de São Paulo, que mais uma 

vez esconde o nome do tucano Antônio Imbassahy e de seu 

partido (PSDB) da manchete em que ele é acusado de ter dado 

início à corrupção no metrô de Salvador, iniciado em sua gestão, 

(ao contrário do que faz quando o acusado é do PT),"
rm -f /tmp/wp-post-38.html

echo '  [40/375] material: PROGRAMA UNIVERSIDADE PARA TODOS: Inscrições em pr...'
$WP post create --post_type="material" --post_title="PROGRAMA UNIVERSIDADE PARA TODOS: Inscrições em pré-vestibular terminam na quinta-feira (14/05)" --post_status="publish" --post_content="$(cat /tmp/wp-post-39.html)" --post_date="2015-05-12T14:32:00.000-07:00" --post_excerpt="A Universidade Federal do Recôncavo da Bahia (UFRB), por meio da Pró-Reitoria de Graduação (PROGRAD), torna públicas as inscrições para o curso preparatório para o vestibular do Projeto Universidade Para Todos. As inscrições on line seguem até quinta-feira, 14 de maio.



São mil vagas distribuídas"
rm -f /tmp/wp-post-39.html

echo '  [41/375] livro: NOVOS LIVROS DE IRENILSON BARBOSA: Poesia, teologi...'
$WP post create --post_type="livro" --post_title="NOVOS LIVROS DE IRENILSON BARBOSA: Poesia, teologia e relações etnicorraciais em evidência" --post_status="publish" --post_content="$(cat /tmp/wp-post-40.html)" --post_date="2015-05-01T10:04:00.000-07:00" --post_excerpt="Rapidamente, um terço do ano de 2015 se vai, mas nos deixa de herança dois novos livros de Irenilson de Jesus Barbosa. O mantenedor do nosso blogue Poiésis do Irê, acaba de lançar duas publicações, onde transita entre temas diversos e em abordagens distintas, da literatura poética à discussão teoló"
rm -f /tmp/wp-post-40.html

echo '  [42/375] publicacao: MORRE EDUARDO GALEANO: Um escritor a serviço da Am...'
$WP post create --post_type="publicacao" --post_title="MORRE EDUARDO GALEANO: Um escritor a serviço da América Latina" --post_status="publish" --post_content="$(cat /tmp/wp-post-41.html)" --post_date="2015-04-14T11:18:00.000-07:00" --post_excerpt="O escritor uruguaio Eduardo Galeano, autor de \"As Veias Abertas da América Latina\", uma referência da literatura comprometida com a esquerda e voz dos marginalizados da região, faleceu nesta segunda-feira (13/04) aos 74 anos, em Montevidéu.








Eduardo Germán María Hughes Galeano morreu vítim..."
rm -f /tmp/wp-post-41.html

echo '  [43/375] post: NORMAS DA ABNT PARA TCC 2015: Conheça as principai...'
$WP post create --post_type="post" --post_title="NORMAS DA ABNT PARA TCC 2015: Conheça as principais regras" --post_status="publish" --post_content="$(cat /tmp/wp-post-42.html)" --post_date="2015-04-07T10:17:00.000-07:00" --post_excerpt="Confira as principais regras da ABNT para TCC e aprenda a estruturar o seu trabalho de acordo com as normas técnicas



As regras da ABNT 2015 são fundamentais para fazer a formatação dos trabalhos acadêmicos, principalmente o TCC (Trabalho de Conclusão de Curso). As normas são usadas internaciona" --post_category='filosofia'
rm -f /tmp/wp-post-42.html

echo '  [44/375] post: SOCIÓLOGO PORTUGUÊS DENUNCIA FINANCIAMENTO DE CRIS...'
$WP post create --post_type="post" --post_title="SOCIÓLOGO PORTUGUÊS DENUNCIA FINANCIAMENTO DE CRISE NO BRASIL" --post_status="publish" --post_content="$(cat /tmp/wp-post-43.html)" --post_date="2015-04-07T09:51:00.002-07:00" --post_excerpt="Segundo Boaventura, Brasil é alvo de tentativa de desestabilização pelas elites econômicas
\"No caso do Brasil, há uma transgressão sem história... Há um grupo político que não pertence às elites tradicionais brasileiras, que chegou ao poder, e que está no poder desde 2003. E, portanto, as elites, n" --post_category='filosofia'
rm -f /tmp/wp-post-43.html

echo '  [45/375] post: ABSURDOS TRÁGICOS DE NOSSO TEMPO: Autoridades dize...'
$WP post create --post_type="post" --post_title="ABSURDOS TRÁGICOS DE NOSSO TEMPO: Autoridades dizem que co-piloto derrubou avião da Germanwings" --post_status="publish" --post_content="$(cat /tmp/wp-post-44.html)" --post_date="2015-03-26T09:53:00.000-07:00" --post_excerpt="Segundo autoridades francesas, gravações da \"caixa-preta\" revelam que o co-piloto Andreas Lubitz (foto) ficou consciente e em silêncio, trancado na cabine de comando até o momento do impacto que matou 150 pessoas.

A Promotoria de Marselha afirmou que o co-piloto alemão do voo da Germanwing" --post_category='filosofia'
rm -f /tmp/wp-post-44.html

echo '  [46/375] post: DIA NACIONAL DA POESIA... É HOJE!...'
$WP post create --post_type="post" --post_title="DIA NACIONAL DA POESIA... É HOJE!" --post_status="publish" --post_content="$(cat /tmp/wp-post-45.html)" --post_date="2015-03-14T10:14:00.000-07:00" --post_excerpt="Gosto de pensar que a poesia é a vida em versos... É uma forma de acariciar a alma de alguém que lê e se embevece entre sensações, às vezes indizíveis. A poesia é o dito e o não dito, sensivelmente ditos e, por vezes, silentes... como só os enamorados pelas palavras e encantados com a vida sabe" --post_category='filosofia'
rm -f /tmp/wp-post-45.html

echo '  [47/375] post: DA TEOLOGIA, DO TEMPO E DE SUAS CONVENIÊNCIAS DISC...'
$WP post create --post_type="post" --post_title="DA TEOLOGIA, DO TEMPO E DE SUAS CONVENIÊNCIAS DISCURSIVAS" --post_status="publish" --post_content="$(cat /tmp/wp-post-46.html)" --post_date="2015-03-12T13:33:00.000-07:00" --post_excerpt="No final da década de 1980 eu era um jovem seminarista no Seminário Teológico Batista do Sul do Brasil (STBSB). Apesar do nome, o internato ficava situado no Rio de Janeiro, bairro da Tijuca. Lá ouvi muitos discursos de colegas empolgados com a Teologia da Libertação, então defendida por Leona" --post_category='filosofia'
rm -f /tmp/wp-post-46.html

echo '  [48/375] post: MULHERES, AS CRIATURAS MAIS LINDAS!...'
$WP post create --post_type="post" --post_title="MULHERES, AS CRIATURAS MAIS LINDAS!" --post_status="publish" --post_content="$(cat /tmp/wp-post-47.html)" --post_date="2015-03-08T13:23:00.000-07:00" --post_excerpt="No Dia Internacional da Mulher, 08 de Março, reedito uma brevíssima homenagem às mulheres de minha vida. Essas pessoas especiais que fazem a vida parecer sempre linda, mesmo quando são uma sofrida lembrança, em meio aos seus muitos afazeres, perguntas, ansiedades, ciúmes, amizades e uma graça que" --post_category='filosofia'
rm -f /tmp/wp-post-47.html

echo '  [49/375] post: UNEB OFERECERÁ ESPECIALIZAÇÃO EM ATIVIDADE FÍSICA ...'
$WP post create --post_type="post" --post_title="UNEB OFERECERÁ ESPECIALIZAÇÃO EM ATIVIDADE FÍSICA PARA PESSOAS COM DEFICIÊNCIA" --post_status="publish" --post_content="$(cat /tmp/wp-post-48.html)" --post_date="2014-11-06T04:20:00.000-08:00" --post_excerpt="Uma notícia que deve interessar aos educadores em geral, especialmente aos profissionais e estudantes da Educação Física: A UNEB prepara edital para oferta de um CURSO DE ESPECIALIZAÇÃO EM ATIVIDADE FÍSICA PARA PESSOAS COM DEFICIÊNCIA, a ser realizado em 2015. Este curso de especialização foi" --post_category='educacao'
rm -f /tmp/wp-post-48.html

echo '  [50/375] post: PASTOR JOSÉ SALES DA COSTA: UM PRÍNCIPE DE DEUS QU...'
$WP post create --post_type="post" --post_title="PASTOR JOSÉ SALES DA COSTA: UM PRÍNCIPE DE DEUS QUE VAI À SUA MORADA ETERNA" --post_status="publish" --post_content="$(cat /tmp/wp-post-49.html)" --post_date="2014-10-03T16:29:00.000-07:00" --post_excerpt="\"Disse Davi a Joabe e a todo o povo que com ele estava: Rasgai as vossas vestes, cingi-vos de sacos e ide pranteando diante de Abner. E o rei Davi ia seguindo o féretro. Sepultaram Abner em Hebrom; e o rei, levantando a sua voz, chorou junto da sepultura de Abner; chorou também todo o povo. Então d" --post_category='filosofia'
rm -f /tmp/wp-post-49.html

echo '  [51/375] post: Historiador demonstra que críticas à influência da...'
$WP post create --post_type="post" --post_title="Historiador demonstra que críticas à influência da religião na política evidencia preconceitos contra \"evangélicos\"" --post_status="publish" --post_content="$(cat /tmp/wp-post-50.html)" --post_date="2014-09-10T08:44:00.002-07:00" --post_excerpt="A ignorância sobre a diversidade contida sob os rótulos empregados aos cristãos não-católicos, com base em estereótipos, revela desconhecimento, preconceito e muita má vontade da mídia e dos \"analistas\" sobre o que são, como vivem e como votam os chamados \"evangélicos\" no Brasil. 







\"A intelli" --post_category='filosofia'
rm -f /tmp/wp-post-50.html

echo '  [52/375] publicacao: Prefeitura na Bahia abre concurso com 500 vagas e ...'
$WP post create --post_type="publicacao" --post_title="Prefeitura na Bahia abre concurso com 500 vagas e salários de até R$ 10 mil" --post_status="publish" --post_content="$(cat /tmp/wp-post-51.html)" --post_date="2014-07-30T07:24:00.000-07:00" --post_excerpt="As oportunidades são para profissionais de níveis fundamental, médio/ magistério/ técnico ou superior.

A prefeitura de Xique-Xique divulgou o edital do seu concurso público com um total de 501 vagas. As oportunidades são para profissionais de níveis fundamental, médio/ magistério/ técnico ou super"
rm -f /tmp/wp-post-51.html

echo '  [53/375] post: VALORIZE A SUA IGREJA[1]...'
$WP post create --post_type="post" --post_title="VALORIZE A SUA IGREJA[1]" --post_status="publish" --post_content="$(cat /tmp/wp-post-52.html)" --post_date="2014-07-17T11:40:00.001-07:00" --post_excerpt="A igreja é um lugar de pessoas
imperfeitas, que resulta do fato de estarmos nela.

Este
lugar imperfeito é, no entanto, o único espaço em que todos são bem-vindos. São
bem-vindas as crianças. São bem-vindos os adolescentes. São bem-vindos os
jovens. São bem-vindas os maiores de idade. São bem" --post_category='filosofia'
rm -f /tmp/wp-post-52.html

echo '  [54/375] post: Aniversário e Dia Nacional do Homem: AFAGOS, ASPER...'
$WP post create --post_type="post" --post_title="Aniversário e Dia Nacional do Homem: AFAGOS, ASPEREZAS E INDIFERENÇAS" --post_status="publish" --post_content="$(cat /tmp/wp-post-53.html)" --post_date="2014-07-16T09:56:00.000-07:00" --post_excerpt="Irenilson Barbosa



Ontem (15/07) foi o meu
aniversário e, naturalmente, o Dia Nacional do Homem. Agradeço carinhosamente
às manifestações de todos em felicitações pela minha data natalícia. Sou grato
a Deus pelos familiares, amigos e pessoas muito queridas que sempre me agraciam
com seus afago" --post_category='filosofia'
rm -f /tmp/wp-post-53.html

echo '  [55/375] publicacao: Pelé e Garrincha: o gênio aclamado e o povo menosp...'
$WP post create --post_type="publicacao" --post_title="Pelé e Garrincha: o gênio aclamado e o povo menosprezado pelas elites" --post_status="publish" --post_content="$(cat /tmp/wp-post-54.html)" --post_date="2014-06-14T07:16:00.000-07:00" --post_excerpt="\"Pelé será sempre o mais admirado, Garrincha o mais amado. Ele retrata com perfeição o seu povo sofrido, injustiçado, maltratado por uma elite brutal que não acredita no seu gênio, que o explora e despreza, um povo que mesmo assim cultiva a alegria e mostra seu brilho nas circunstâncias mais adve"
rm -f /tmp/wp-post-54.html

echo '  [56/375] post: Igreja Batista Káris divulga eventos da TRANSCOPA ...'
$WP post create --post_type="post" --post_title="Igreja Batista Káris divulga eventos da TRANSCOPA 2014 em Salvador" --post_status="publish" --post_content="$(cat /tmp/wp-post-55.html)" --post_date="2014-06-11T10:00:00.001-07:00" --post_excerpt="Começa hoje (12/06), a partir das 16:00 horas com a Abertura da Copa do Mundo 2014 e o jogo de estréia
 Brasil x Croácia!
Vamos torcer juntos pelo Brasil e anunciar o amor de Deus através do esporte!









A Trans Copa do Mundo 2014 (TRANSCOPA)
em Salvador é um projeto da Junta de Missões Nacion" --post_category='filosofia'
rm -f /tmp/wp-post-55.html

echo '  [57/375] material: UFRB divulga novo calendário de matrícula para o s...'
$WP post create --post_type="material" --post_title="UFRB divulga novo calendário de matrícula para o semestre 2014.1" --post_status="publish" --post_content="$(cat /tmp/wp-post-56.html)" --post_date="2014-06-06T12:51:00.000-07:00" --post_excerpt="A Universidade Federal do Recôncavo da Bahia (UFRB), por meio da Superintendência de Regulação e Registros Acadêmicos (SURRAC), divulgou hoje o novo calendário da matrícula web referente ao semestre 2014.1.

No período de 13 a 17 de junho, estará disponível através do Portal Acadêmico a primeir"
rm -f /tmp/wp-post-56.html

echo '  [58/375] post: Agente contratado pela CIA para matar José Dirceu ...'
$WP post create --post_type="post" --post_title="Agente contratado pela CIA para matar José Dirceu lhe enviou carta à Papuda" --post_status="publish" --post_content="$(cat /tmp/wp-post-57.html)" --post_date="2014-06-04T07:38:00.000-07:00" --post_excerpt="Visando oferecer ao leitor uma oportunidade a mais de refletir sobre a política brasileira neste ano eleitoral e sobre o tom raivoso e indignado que se confunde com uma certa \"sede de justiça\" generalizada e nunca vista na mídia brasileira, reproduzimos, abaixo, a matéria publicada nesta terça-f" --post_category='politica'
rm -f /tmp/wp-post-57.html

echo '  [59/375] livro: Pr. José Sales da Costa: ALGUÉM QUE PODE SER CHAMA...'
$WP post create --post_type="livro" --post_title="Pr. José Sales da Costa: ALGUÉM QUE PODE SER CHAMADO \"HOMEM DE DEUS\"" --post_status="publish" --post_content="$(cat /tmp/wp-post-58.html)" --post_date="2014-05-31T10:12:00.001-07:00" --post_excerpt="HOJE É ANIVERSÁRIO DELE. Há 93 anos, Deus o trouxe ao mundo e, há 68 anos, ele foi ordenado PASTOR, ou simplesmente um \"servo da mais excelente obra\". 

Ele co-celebrou meu casamento com sua ovelha mais linda, que também o ama, e foi nosso conselheiro. Solicitou a minha ordenação como pastor e me i"
rm -f /tmp/wp-post-58.html

echo '  [60/375] post: 31 de Maio: DIA MUNDIAL SEM TABACO: Razões e passo...'
$WP post create --post_type="post" --post_title="31 de Maio: DIA MUNDIAL SEM TABACO: Razões e passos vencer o vício de fumar" --post_status="publish" --post_content="$(cat /tmp/wp-post-59.html)" --post_date="2014-05-31T07:42:00.000-07:00" --post_excerpt="Desde 1987, a Organização Mundial da Saúde considera o dia 31 de maio como o Dia Mundial Sem tabaco. O objetivo da campanha é conscientizar a população sobre as doenças relacionadas ao tabagismo. No Brasil, as secretarias Municipais e Estaduais de Saúde são articuladoras das ações da campanha" --post_category='filosofia'
rm -f /tmp/wp-post-59.html

echo '  [61/375] post: O CANTO CONGREGACIONAL E SEU CARÁTER DIDÁTICO NA A...'
$WP post create --post_type="post" --post_title="O CANTO CONGREGACIONAL E SEU CARÁTER DIDÁTICO NA ADORAÇÃO" --post_status="publish" --post_content="$(cat /tmp/wp-post-60.html)" --post_date="2014-05-23T06:26:00.001-07:00" --post_excerpt="A propósito da importância da música e do canto congregacional na adoração a Deus e da forma como temos perdido o verdadeiro sentido de seu uso nos cultos ditos evangélicos, onde aparece às vezes como passatempo, outras vezes como lazer e elemento de auto-satisfação do que canta, compartilho esse t" --post_category='cultura'
rm -f /tmp/wp-post-60.html

echo '  [62/375] post: DOCENTES DA UFRB APROVAM INDICATIVO DE GREVE SEM D...'
$WP post create --post_type="post" --post_title="DOCENTES DA UFRB APROVAM INDICATIVO DE GREVE SEM DATA DEFINIDA" --post_status="publish" --post_content="$(cat /tmp/wp-post-61.html)" --post_date="2014-05-22T07:35:00.002-07:00" --post_excerpt="Texto postado por APUR em 21 maio de 2014 (disponível em apur.org.br)



DOCENTES DA UFRB APROVAM INDICATIVO DE GREVE EM MAIS UMA GRANDE ASSEMBLEIA



Em assembleia nesta quarta-feira (21), dois anos após o início da greve de 2012, os docentes da Universidade Federal do Recôncavo da Bahia (UFRB) a" --post_category='filosofia'
rm -f /tmp/wp-post-61.html

echo '  [63/375] post: Lançado Edital para Mestrado Profissional em Artes...'
$WP post create --post_type="post" --post_title="Lançado Edital para Mestrado Profissional em Artes para Professores da Educação Básica" --post_status="publish" --post_content="$(cat /tmp/wp-post-62.html)" --post_date="2014-05-19T07:31:00.000-07:00" --post_excerpt="Está aberto o edital de acesso ao Programa de Mestrado Profissional em Artes (PROF-ARTES), sediado no Instituto de Humanidades, Artes e Ciências Professor Milton Santos - IHAC/UFBA. A iniciativa tem por objetivo proporcionar formação continuada a docentes de Artes da Educação Básica pública. O P" --post_category='educacao'
rm -f /tmp/wp-post-62.html

echo '  [64/375] post: SÓ PRA QUEM NAMORA...'
$WP post create --post_type="post" --post_title="SÓ PRA QUEM NAMORA" --post_status="publish" --post_content="$(cat /tmp/wp-post-63.html)" --post_date="2014-05-14T12:33:00.003-07:00" --post_excerpt="Irenilson de Jesus Barbosa[1]













Quem namora agrada a Deus, seja gente pobre ou rica. 

E quem enamorado fica, recebe dádiva sem rival,

É quando, sem nenhum mal, mais encantando tudo fica

E assim também se dignifica a vida em versão natural.



Namorar é a forma bonita de se viver culti" --post_category='filosofia'
rm -f /tmp/wp-post-63.html

echo '  [65/375] post: Docentes das IFES deliberaram agenda de paralisaçã...'
$WP post create --post_type="post" --post_title="Docentes das IFES deliberaram agenda de paralisação e mobilização para Maio" --post_status="publish" --post_content="$(cat /tmp/wp-post-64.html)" --post_date="2014-05-07T07:39:00.001-07:00" --post_excerpt="Visando atender alunos que buscam informações a respeito de uma eventual greve docente na UFRB, reproduzimos a matéria abaixo, informando sobre as deliberações dos representantes das IFES em recente reunião, realizada no final de abril, em Brasília, e divulgada pela APUR, no último dia 29/04." --post_category='educacao'
rm -f /tmp/wp-post-64.html

echo '  [66/375] publicacao: Estudo arqueológico comprova existência de 50 pers...'
$WP post create --post_type="publicacao" --post_title="Estudo arqueológico comprova existência de 50 personagens bíblicos" --post_status="publish" --post_content="$(cat /tmp/wp-post-65.html)" --post_date="2014-05-06T11:16:00.002-07:00" --post_excerpt="O arqueólogo Lawrence Mykytiuk liderou um estudo da Universidade Purdue comprovando a existência de pelo menos 50 pessoas mencionadas no Velho Testamento. O relatório apresenta uma lista de pessoas de destaque em Israel e governantes da região da Antiga Mesopotâmia.

O material da pesquisa foi pub"
rm -f /tmp/wp-post-65.html

echo '  [67/375] publicacao: UFRB publica Nota sobre Suspensão da Matrícula Web...'
$WP post create --post_type="publicacao" --post_title="UFRB publica Nota sobre Suspensão da Matrícula Web e do Edital de Cursos BI'S" --post_status="publish" --post_content="$(cat /tmp/wp-post-66.html)" --post_date="2014-04-28T15:09:00.000-07:00" --post_excerpt="O Conselho Acadêmico (CONAC) da Universidade Federal do Recôncavo da Bahia (UFRB) divulga nota sobre  suspensão da 2ª Etapa da Matrícula Web e do Edital de Acesso aos Cursos de Graduação para 2014.1. Confira abaixo texto na íntegra:

Nota sobre suspensão da 2ª Etapa da Matrícula Web e Edital de Ace"
rm -f /tmp/wp-post-66.html

echo '  [68/375] post: UM HOMEM QUE AMAVA EM SILÊNCIO...'
$WP post create --post_type="post" --post_title="UM HOMEM QUE AMAVA EM SILÊNCIO" --post_status="publish" --post_content="$(cat /tmp/wp-post-67.html)" --post_date="2014-04-27T20:31:00.001-07:00" --post_excerpt="Uma breve homenagem à memória do amigo Fritz Mohn

Irenilson de Jesus Barbosa



Diácono Fritz Mohn - Cristalina - Goiás



A
notícia me chegou hoje (27 de abril de 2014), pouco antes do almoço. Um amigo guardado no peito se
foi... Partiu ao encontro do Eterno que o amou sem reservas (João 3.16). M" --post_category='filosofia'
rm -f /tmp/wp-post-67.html

echo '  [69/375] publicacao: Universidade de Coimbra vai usar Enem para ingress...'
$WP post create --post_type="publicacao" --post_title="Universidade de Coimbra vai usar Enem para ingresso de brasileiros" --post_status="publish" --post_content="$(cat /tmp/wp-post-68.html)" --post_date="2014-04-26T12:57:00.000-07:00" --post_excerpt="Confira esta excelente notícia para estudantes brasileiros que desejam fazer uma graduação em terras lusitanas.





Estudantes brasileiros poderão ingressar na Universidade de Coimbra, em Portugal, com a nota do Exame Nacional do Ensino Médio (Enem). O exame passa a ser aceito este ano para os"
rm -f /tmp/wp-post-68.html

echo '  [70/375] post: SUGESTÃO DE CULTO DOMÉSTICO E ESTUDO BÍBLICO SOBRE...'
$WP post create --post_type="post" --post_title="SUGESTÃO DE CULTO DOMÉSTICO E ESTUDO BÍBLICO SOBRE A RESSURREIÇÃO DE CRISTO" --post_status="publish" --post_content="$(cat /tmp/wp-post-69.html)" --post_date="2014-04-19T19:09:00.002-07:00" --post_excerpt="Considerando a dificuldade de reunião de nossa igreja por conta de problemas de segurança pública em Salvador, neste domingo (20/04), sugerimos o programa abaixo para suprimento de necessidades devocionais de nossos irmãos, membros da Igreja Batista Káris, em reuniões de oração em seus próprios lar" --post_category='filosofia'
rm -f /tmp/wp-post-69.html

echo '  [71/375] publicacao: A ‘tempestade perfeita’ da imprensa em ano eleitor...'
$WP post create --post_type="publicacao" --post_title="A ‘tempestade perfeita’ da imprensa em ano eleitoral" --post_status="publish" --post_content="$(cat /tmp/wp-post-70.html)" --post_date="2014-04-11T08:40:00.000-07:00" --post_excerpt="Comentário de Luciano Martins Costa para o programa radiofônico do Observatório da Imprensa, em 08/04/2014, denominado \"A 'tempestade perfeita' da imprensa\"revela como a imprensa manipula informações e dissemina pessimismo econômico no Brasil, um dos países mais equilibrados hoje no mundo e com e"
rm -f /tmp/wp-post-70.html

echo '  [72/375] post: UFBA entrega tablets com softwares de acessibilida...'
$WP post create --post_type="post" --post_title="UFBA entrega tablets com softwares de acessibilidade para os estudantes com deficiência visual" --post_status="publish" --post_content="$(cat /tmp/wp-post-71.html)" --post_date="2014-03-28T17:45:00.001-07:00" --post_excerpt="Na sexta-feira, 28 de março de 2014, os estudantes com deficiência visual (cegueira e baixa visão) receberam da Universidade os novos Tablets, com softwares especiais de acessibilidade instalados, visando principalmente favorecer e facilitar, a esses alunos, o acesso aos conteúdos textuais das disc" --post_category='educacao'
rm -f /tmp/wp-post-71.html

echo '  [73/375] post: É CARNAVAL, MINHA GENTE!...'
$WP post create --post_type="post" --post_title="É CARNAVAL, MINHA GENTE!" --post_status="publish" --post_content="$(cat /tmp/wp-post-72.html)" --post_date="2014-02-27T15:00:00.000-08:00" --post_excerpt="Pois é pessoal... Está começando a grande festa da \"alegria\", marco dionisíaco da civilidade brasileira, responsável por um dos traços mas conhecidos da popozuda \"identidade nacional\" no mundo. A festa onde se pode tudo (e ai de quem achar que não pode!). Ou seria a \"festa da alegria produzida pel" --post_category='cotidiano'
rm -f /tmp/wp-post-72.html

echo '  [74/375] material: UFBA abre concurso com 70 vagas para professores...'
$WP post create --post_type="material" --post_title="UFBA abre concurso com 70 vagas para professores" --post_status="publish" --post_content="$(cat /tmp/wp-post-73.html)" --post_date="2014-01-24T19:57:00.001-08:00" --post_excerpt="As inscrições para o primeiro concurso docente de 2014 na UFBA serão abertas a partir da próxima segunda, 27/01.




A Universidade Federal da Bahia (UFBA) publicou nesta sexta-feira, 24, o edital de abertura do processo seletivo com 70 vagas para contratação de professores nos Campi de Salvador,"
rm -f /tmp/wp-post-73.html

echo '  [75/375] material: FICHAMENTO OU RESUMO CRÍTICO PARA AULA DE PRÁTICA ...'
$WP post create --post_type="material" --post_title="FICHAMENTO OU RESUMO CRÍTICO PARA AULA DE PRÁTICA NA DOCÊNCIA DAS MATÉRIAS PEDAGÓGICAS" --post_status="publish" --post_content="$(cat /tmp/wp-post-74.html)" --post_date="2014-01-24T11:41:00.000-08:00" --post_excerpt="ATENÇÃO ALUNOS E ALUNAS matriculados(as) no componente curricular PRÁTICA REFLEXIVA NA DOCÊNCIA DAS MATÉRIAS PEDAGÓGICAS (PEDAGOGIA - CFP/UFRB)!

Conforme alinhavado em classe, em nosso último encontro, NÃO TEREMOS AULAS PRESENCIAIS DESSE COMPONENTE NO DIA 28/01 das 08:00 às 12:00h, por isso, r"
rm -f /tmp/wp-post-74.html

echo '  [76/375] publicacao: Atividades de Elaboração dos Seminários de Organiz...'
$WP post create --post_type="publicacao" --post_title="Atividades de Elaboração dos Seminários de Organização da Educação Brasileira e Políticas Públicas" --post_status="publish" --post_content="$(cat /tmp/wp-post-75.html)" --post_date="2014-01-24T08:13:00.002-08:00" --post_excerpt="Comunico aos meus caros alunos e alunas do componente Organização da Educação Brasileira e Políticas Públicas (CFP/UFRB) que, nas datas de 27/01 (turma de Filosofia) e 28/01 (turma de Pedagogia), realizaremos atividades extra-classe, onde os educandos deverão se reunir nas respectivas equipes o"
rm -f /tmp/wp-post-75.html

echo '  [77/375] publicacao: Análise de cientista político sobre FHC desmonta m...'
$WP post create --post_type="publicacao" --post_title="Análise de cientista político sobre FHC desmonta mitos sobre economia e política" --post_status="publish" --post_content="$(cat /tmp/wp-post-76.html)" --post_date="2014-01-08T16:11:00.000-08:00" --post_excerpt="Para alguns especialistas, o texto denominado Carta Aberta a FHC se constitui em uma das manifestações públicas mais demolidoras da nossa história política recente e merece um lugar especial nos livros de História e Política do Brasil.


Fernando Henrique Cardoso, ex-presidente do Brasil. Foto: div"
rm -f /tmp/wp-post-76.html

echo '  [78/375] post: TEXTOS E LINKS PARA SEMINÁRIOS DE OEBPP - Organiza...'
$WP post create --post_type="post" --post_title="TEXTOS E LINKS PARA SEMINÁRIOS DE OEBPP - Organização da Educação Brasileira e Políticas Públicas" --post_status="publish" --post_content="$(cat /tmp/wp-post-77.html)" --post_date="2014-01-04T08:03:00.000-08:00" --post_excerpt="Atenção pessoas lindas!
Conforme combinamos nas turmas de OEBPP - Organização da Educação Brasileira e Políticas Públicas (1º Licenciatura em Pedagogia e 3º semestre de Licenciatura Filosofia) no CFP/UFRB seguem os links para pesquisas no site do MEC (http://portal.mec.gov.br/) onde encontrarão s..." --post_category='educacao'
rm -f /tmp/wp-post-77.html

echo '  [79/375] material: TEXTOS PARA PRÁTICA NA DOCÊNCIA DAS MATÉRIAS PEDAG...'
$WP post create --post_type="material" --post_title="TEXTOS PARA PRÁTICA NA DOCÊNCIA DAS MATÉRIAS PEDAGÓGICAS" --post_status="publish" --post_content="$(cat /tmp/wp-post-78.html)" --post_date="2014-01-04T07:36:00.002-08:00" --post_excerpt="Atenção, pessoas queridas da turma de Pedagogia do 8º semestre (CFP/UFRB)!
Confiram nos links abaixo os textos indicados para as leituras, visando nossos encontros pós-recesso, a partir do dia 21/01/2014. Os mesmos servirão de subsídios para as aulas e atividades de construção dos Memoriais e/ou ..."
rm -f /tmp/wp-post-78.html

echo '  [80/375] publicacao: SIM, JESUS NASCEU... POR ISSO É NATAL!...'
$WP post create --post_type="publicacao" --post_title="SIM, JESUS NASCEU... POR ISSO É NATAL!" --post_status="publish" --post_content="$(cat /tmp/wp-post-79.html)" --post_date="2013-12-25T11:32:00.000-08:00"
rm -f /tmp/wp-post-79.html

echo '  [81/375] livro: INTOLERÂNCIA E PERSEGUIÇÃO RELIGIOSAS: Motivos de ...'
$WP post create --post_type="livro" --post_title="INTOLERÂNCIA E PERSEGUIÇÃO RELIGIOSAS: Motivos de Oração no Natal" --post_status="publish" --post_content="$(cat /tmp/wp-post-80.html)" --post_date="2013-12-20T15:56:00.000-08:00" --post_excerpt="O NATAL DA IGREJA PERSEGUIDA



Nosso amigo e companheiro de ministério, Pr. Pedro Moura, nos informa que a Christian Solidarity Worlwide tem sugerido aos cristãos do muito inteiro que aproveitem as celebrações do Natal para incluir pedidos d"
rm -f /tmp/wp-post-80.html

echo '  [82/375] post: O HOMEM DA MINHA VIDA[1]...'
$WP post create --post_type="post" --post_title="O HOMEM DA MINHA VIDA[1]" --post_status="publish" --post_content="$(cat /tmp/wp-post-81.html)" --post_date="2013-12-19T22:10:00.000-08:00" --post_excerpt="Irenilson de Jesus Barbosa 





O
homem da minha vida, eu reconheci pelo choro,

Ali,
sem nenhum decoro, se me apresentou vindo à luz;

Junto
ao berço, ante o vidro, me pus, a admirá-lo perplexo,

Vendo
a ele e a mim no reflexo, multicor emoção que reluz.



O
homem da minha vida, nos veio na Cris" --post_category='filosofia'
rm -f /tmp/wp-post-81.html

echo '  [83/375] publicacao: Escola de Salvador será rebatizada com nome de Car...'
$WP post create --post_type="publicacao" --post_title="Escola de Salvador será rebatizada com nome de Carlos Marighella" --post_status="publish" --post_content="$(cat /tmp/wp-post-82.html)" --post_date="2013-12-13T17:45:00.001-08:00" --post_excerpt="Comunidade do Colégio Estadual Presidente Emílio Garrastazu Médici votou e decidiu substituir o nome do ditador pelo do ativista político.


Fonte: Carta Capital — publicado 12/12/2013 15:27



Reprodução / Colégio Estadual Presidente Emílio Garrastazu Médici






O Colégio Estadual Presidente Emí"
rm -f /tmp/wp-post-82.html

echo '  [84/375] publicacao: UFRB mantém IGC 4 junto ao MEC e se consolida entr...'
$WP post create --post_type="publicacao" --post_title="UFRB mantém IGC 4 junto ao MEC e se consolida entre as melhores do Brasil" --post_status="publish" --post_content="$(cat /tmp/wp-post-83.html)" --post_date="2013-12-12T12:18:00.000-08:00" --post_excerpt="Dados publicados pelo Instituto Nacional de Pesquisas Educacionais do MEC mostram que a UFRB se mantém entre as melhores universidades do país nos últimos três anos. 


A Universidade Federal do Recôncavo da Bahia (UFRB) mantém pelo terceiro ano consecutivo a nota quatro no Índice Geral de Cursos"
rm -f /tmp/wp-post-83.html

echo '  [85/375] post: UFRB abre concurso com mais de 60 vagas para profe...'
$WP post create --post_type="post" --post_title="UFRB abre concurso com mais de 60 vagas para professores" --post_status="publish" --post_content="$(cat /tmp/wp-post-84.html)" --post_date="2013-12-09T11:01:00.000-08:00" --post_excerpt="A Universidade Federal do Recôncavo da Bahia (UFRB) está com inscrições abertas para concursos públicos visando à contratação de pessoal docente. São mais de 60 vagas para atuar junto aos Centros de Ensino localizados nas cidades de Feira de Santana, Santo Amaro, Cruz das Almas e Santo Antônio d" --post_category='educacao'
rm -f /tmp/wp-post-84.html

echo '  [86/375] material: Cerca de 42 mil inscritos farão a prova do Concurs...'
$WP post create --post_type="material" --post_title="Cerca de 42 mil inscritos farão a prova do Concurso da Ufba neste domingo (08/12)" --post_status="publish" --post_content="$(cat /tmp/wp-post-85.html)" --post_date="2013-12-07T18:33:00.000-08:00" --post_excerpt="Ao todo, estão sendo oferecidas 122 vagas e os salários variam de R$1.547,23 a R$3.138,70


Neste domingo (08/12), 41.760 inscritos no concurso da Universidade Federal da Bahia (UFBA) farão a prova para cargos de nível fundamental, médio e superior da instituição. Quem ainda não sabe seu local de p"
rm -f /tmp/wp-post-85.html

echo '  [87/375] post: A África perde Madiba, o Indomável Apóstolo da Igu...'
$WP post create --post_type="post" --post_title="A África perde Madiba, o Indomável Apóstolo da Igualdade Racial" --post_status="publish" --post_content="$(cat /tmp/wp-post-86.html)" --post_date="2013-12-06T07:22:00.003-08:00" --post_excerpt="Nelson Mandela morre aos 95 anos


O líder sul-africano Nelson Mandela, 95, morreu nesta quinta (5) em sua residência, em Johannesburgo, para onde havia sido levado no dia 1º de setembro após passar quase três meses internado para tratamento de uma infecção pulmonar. O funeral deve durar entre dez" --post_category='filosofia'
rm -f /tmp/wp-post-86.html

echo '  [88/375] publicacao: Publicado o Edital do Concurso Jovem Aprendiz dos ...'
$WP post create --post_type="publicacao" --post_title="Publicado o Edital do Concurso Jovem Aprendiz dos Correios 2013/2014" --post_status="publish" --post_content="$(cat /tmp/wp-post-87.html)" --post_date="2013-12-05T07:49:00.000-08:00" --post_excerpt="Correios receberão inscrições para o processo seletivo nacional que visa ao preenchimento de 2.529 vagas do Programa Jovem Aprendiz.

A Empresa Brasileira de Correios e Telégrafos (ECT), publicou o edital n° 1.417/2013 de processo seletivo para contratação especial de jovens que integrarão o Progra"
rm -f /tmp/wp-post-87.html

echo '  [89/375] material: Prof. Irê posta informes sobre textos de suas disc...'
$WP post create --post_type="material" --post_title="Prof. Irê posta informes sobre textos de suas disciplinas do CFP/UFRB - 2013.2" --post_status="publish" --post_content="$(cat /tmp/wp-post-88.html)" --post_date="2013-12-04T05:45:00.000-08:00" --post_excerpt="Pessoas queridas,

Confiram, no link abaixo e nos e-mails das turmas, os textos prometidos aos educandos matriculados nas disciplinas/componentes curriculares Prática Reflexiva da Docência das Matérias Pedagógicas (PRDMP - 8º semestre) e Organização da Educação Brasileira e Políticas Públicas (OE..."
rm -f /tmp/wp-post-88.html

echo '  [90/375] post: Banco do Brasil anuncia novo concurso para nível m...'
$WP post create --post_type="post" --post_title="Banco do Brasil anuncia novo concurso para nível médio." --post_status="publish" --post_content="$(cat /tmp/wp-post-89.html)" --post_date="2013-11-29T08:48:00.000-08:00" --post_excerpt="Salários de Escriturários em torno de 2.700 reais e vagas na Bahia


O Banco do Brasil (BB) vai realizar um novo concurso para escriturário.



 Foi publicada no Diário Oficial da União desta quarta-feira, dia 27, a prorrogação do contrato do Banco do Brasil (BB) com a Fundação CESGRANRIO, para a a" --post_category='filosofia'
rm -f /tmp/wp-post-89.html

echo '  [91/375] material: UFRB PROMOVE CONCURSO PARA PROFESSORES EFETIVOS EM...'
$WP post create --post_type="material" --post_title="UFRB PROMOVE CONCURSO PARA PROFESSORES EFETIVOS EM SANTO AMARO" --post_status="publish" --post_content="$(cat /tmp/wp-post-90.html)" --post_date="2013-11-29T06:24:00.000-08:00" --post_excerpt="Professor Efetivo - Edital Nº 11/2013



A Universidade Federal do Recôncavo publicou Concurso para o CETENS - Centro de Ciência e Tecnologia em Energia e Sustentabilidade (em implantação na cidade de Santo Amaro), com 04 vagas para professor adjunto A e 12 vagas para professor assistente A. Confir"
rm -f /tmp/wp-post-90.html

echo '  [92/375] post: INCLUSÃO E TECNOLOGIAS ASSISTIVAS: Estudo revela p...'
$WP post create --post_type="post" --post_title="INCLUSÃO E TECNOLOGIAS ASSISTIVAS: Estudo revela potencial brasileiro" --post_status="publish" --post_content="$(cat /tmp/wp-post-91.html)" --post_date="2013-11-07T08:11:00.000-08:00" --post_excerpt="As universidades e os institutos de pesquisa e de tecnologia estão repletos de ideias e projetos que podem melhorar a qualidade de vida das pessoas com deficiência. Essa é uma das conclusões do Estudo de Mapeamento de Competências em Tecnologia Assistiva, realizado pelo Centro de Gestão e Estudo" --post_category='filosofia'
rm -f /tmp/wp-post-91.html

echo '  [93/375] publicacao: Museu Afro-Brasileiro promove atividades no Mês da...'
$WP post create --post_type="publicacao" --post_title="Museu Afro-Brasileiro promove atividades no Mês da Consciência Negra" --post_status="publish" --post_content="$(cat /tmp/wp-post-92.html)" --post_date="2013-11-05T09:42:00.000-08:00" --post_excerpt="Atividades serão focadas nos assuntos étnicos da Bahia









Em comemoração ao mês da Consciência Negra, o Museu Afro-Brasileiro da Universidade Federal da Bahia (MAFRO) promove nos dias 7, 14 e 21 de novembro, o Encontro “O MAFRO e Você” para celebrar o momento junto às comunidades negras, rel"
rm -f /tmp/wp-post-92.html

echo '  [94/375] publicacao: SEM LAMENTO, JESUS VENCEU A MORTE!...'
$WP post create --post_type="publicacao" --post_title="SEM LAMENTO, JESUS VENCEU A MORTE!" --post_status="publish" --post_content="$(cat /tmp/wp-post-93.html)" --post_date="2013-11-02T15:57:00.001-07:00" --post_excerpt="NESTE DIA, em que a saudade se confunde com homenagens, muitas pessoas se voltam para a realidade da morte, mantendo idéias as mais diversas e por vezes deprimentes, desesperançosas ou ilusórias sobre o tema, os que cremos na Bíblia, nos sentimos confortados. Assim, aproveitamos para reafirmar a co"
rm -f /tmp/wp-post-93.html

echo '  [95/375] post: UNEB abre inscrição para Mestrado em Educação, Cul...'
$WP post create --post_type="post" --post_title="UNEB abre inscrição para Mestrado em Educação, Cultura e Territórios Semiáridos" --post_status="publish" --post_content="$(cat /tmp/wp-post-94.html)" --post_date="2013-09-10T07:42:00.000-07:00" --post_excerpt="A Universidade do Estado da Bahia (UNEB) lançou edital para a seleção de alunos regulares para o Mestrado do Programa de Pós-Graduação em Educação, Cultura e Territórios Semiáridos (PPGESA), Primeira Turma, para Ingresso em 2014, do Departamento de Ciências Humanas (DCH), do Campus III, da UNEB" --post_category='educacao'
rm -f /tmp/wp-post-94.html

echo '  [96/375] post: O POETA...'
$WP post create --post_type="post" --post_title="O POETA" --post_status="publish" --post_content="$(cat /tmp/wp-post-95.html)" --post_date="2013-09-10T07:28:00.000-07:00" --post_excerpt="João Francisco



IMAGINEM O POETA, PENSANDO EM SUA POESIA,

REVIVENDO COM ALEGRIA, A RAZÃO DO SEU POEMA!

ESPALHANDO DE FORMA PLENA, A MENSAGEM QUE CONTAGIA

NOS SEUS VERSOS DE CADA DIA, UMA MENSAGEM SERENA.

IMAGINEM VER O POETA ESCREVENDO SEUS PENSAMENTOS!

LEVANDO CONHECIMENTO, AO NOSSO POVO," --post_category='filosofia'
rm -f /tmp/wp-post-95.html

echo '  [97/375] post: I Seminário Internacional de Educação do Campo no ...'
$WP post create --post_type="post" --post_title="I Seminário Internacional de Educação do Campo no CFP em Amargosa" --post_status="publish" --post_content="$(cat /tmp/wp-post-96.html)" --post_date="2013-09-04T06:20:00.002-07:00" --post_excerpt="O Centro de Formação de Professores da Universidade Federal do Recôncavo da Bahia (CFP-UFRB) realiza no período de 04 a 06/09/2013 o I Seminário Internacional de Educação do Campo e convida a todas e todos para participar do referido evento.

As atividades terão início hoje, dia 04 de Setembro, no" --post_category='filosofia'
rm -f /tmp/wp-post-96.html

echo '  [98/375] post: PORQUE A IMPRENSA MUDOU DE OPINIÃO SOBRE OS MÉDICO...'
$WP post create --post_type="post" --post_title="PORQUE A IMPRENSA MUDOU DE OPINIÃO SOBRE OS MÉDICOS CUBANOS?" --post_status="publish" --post_content="$(cat /tmp/wp-post-97.html)" --post_date="2013-08-26T20:27:00.001-07:00" --post_excerpt="Revista Veja aplaudiu médicos cubanos na época de FHC

Postado em: 26 ago 2013 às 22:36


Revista da Editora Abril afirma que “o milagre veio de Cuba” numa reportagem de 1999, quando o presidente era FHC e o ministro da Saúde, José Serra, ao descrever a situação de municípios que não tinham médicos" --post_category='filosofia'
rm -f /tmp/wp-post-97.html

echo '  [99/375] post: SEMANA NACIONAL DE COMBATE AO FUMO: CIGARRO? APAGU...'
$WP post create --post_type="post" --post_title="SEMANA NACIONAL DE COMBATE AO FUMO: CIGARRO? APAGUE ESSA IDÉIA!" --post_status="publish" --post_content="$(cat /tmp/wp-post-98.html)" --post_date="2013-08-26T07:48:00.000-07:00" --post_excerpt="Se prevenir nunca é demais e alertar não custa nada. Por esse motivo, é importante aproveitar o Dia Nacional de Combate ao Fumo para conscientizar as pessoas sobre os males do vício do cigarro.




O tabagismo é considerado pela Organização Mundial da Saúde (OMS) a principal causa de morte evitá" --post_category='filosofia'
rm -f /tmp/wp-post-98.html

echo '  [100/375] post: DESCASO E DESRESPEITO DA PETROBRÁS EXPÕEM FAMÍLIAS...'
$WP post create --post_type="post" --post_title="DESCASO E DESRESPEITO DA PETROBRÁS EXPÕEM FAMÍLIAS AO PERIGO EM POÇO DE PETRÓLEO NO LOBATO" --post_status="publish" --post_content="$(cat /tmp/wp-post-99.html)" --post_date="2013-08-13T06:46:00.000-07:00" --post_excerpt="DESCASO HISTÓRICO E ATUAL: A obra de exploração do poço no Lobato que marcou a exploração inicial de petróleo no Brasil, redescoberto após anos de abandono, se desenvolve ao lado da moradia, expondo a famílía a todos os perigos da obra e dos gases no local.




ENQUANTO A PETROBRAS e seu ex-presid" --post_category='politica'
rm -f /tmp/wp-post-99.html

echo '  [101/375] post: PREFEITA DE AMARGOSA PROPÕE REDUÇÃO DE SALÁRIOS DE...'
$WP post create --post_type="post" --post_title="PREFEITA DE AMARGOSA PROPÕE REDUÇÃO DE SALÁRIOS DE PROFESSORES" --post_status="publish" --post_content="$(cat /tmp/wp-post-100.html)" --post_date="2013-08-08T20:49:00.000-07:00" --post_excerpt="Na contramão do bom senso, a Prefeita de Amargosa-BA Karina Silva (PSB) encaminhou à Câmara Municipal, o Projeto de Lei nº 298/2013, o qual “dispõe sobre a revisão dos valores do piso vencimental dos servidores do Magistério do Município de Amargosa e dá outras providências”. O mesmo se encon" --post_category='filosofia'
rm -f /tmp/wp-post-100.html

echo '  [102/375] post: IGREJA BATISTA KÁRIS LANÇA CONCURSO DE LOGOMARCA O...'
$WP post create --post_type="post" --post_title="IGREJA BATISTA KÁRIS LANÇA CONCURSO DE LOGOMARCA OFICIAL EM SEU 5º ANIVERSÁRIO" --post_status="publish" --post_content="$(cat /tmp/wp-post-101.html)" --post_date="2013-07-27T17:09:00.001-07:00" --post_excerpt="As inscrições estarão abertas no período de 28 de julho a 08 de agosto de 2013. O prêmio simbólico para o(a) autor (a) da proposta escolhida será de R$ 150,00 (cento e cinquenta reais) e a logomarca será utilizada nos documentos, placas e demais peças publicitárias da Igreja Batista Káris durante a" --post_category='filosofia'
rm -f /tmp/wp-post-101.html

echo '  [103/375] post: EMPREGO: Um semestre de Dilma é melhor que oito an...'
$WP post create --post_type="post" --post_title="EMPREGO: Um semestre de Dilma é melhor que oito anos de FHC" --post_status="publish" --post_content="$(cat /tmp/wp-post-102.html)" --post_date="2013-07-24T21:23:00.000-07:00" --post_excerpt="Apesar de termos o segundo maior crescimento de PIB do mundo, estarmos realizando as três maiores competições esportivas do planeta (Copa das Confederações 2013, Copa do Mundo 2014 e Olimpíadas 2016) a imprensa brasileira ocupa o lugar da oposição, manipula dados e notícias e pinta o pior dos cenár" --post_category='filosofia'
rm -f /tmp/wp-post-102.html

echo '  [104/375] publicacao: NEM SE DESPEDIU DE MIM......'
$WP post create --post_type="publicacao" --post_title="NEM SE DESPEDIU DE MIM..." --post_status="publish" --post_content="$(cat /tmp/wp-post-103.html)" --post_date="2013-07-24T16:35:00.001-07:00" --post_excerpt="Consternados com a realidade da morte de Dominguinhos, os amigos e admiradores de todo o Brasil se despedem de seu maior sanfoneiro, um dos artistas mais completos da história da música brasileira. Targino Gondim é o autor do texto abaixo e achamos mais que justo reproduzi-lo em memória do grande"
rm -f /tmp/wp-post-103.html

echo '  [105/375] post: Estaleiro Enseada do Paraguaçu divulga cerca de 6 ...'
$WP post create --post_type="post" --post_title="Estaleiro Enseada do Paraguaçu divulga cerca de 6 mil vagas de trabalho em Maragojipe" --post_status="publish" --post_content="$(cat /tmp/wp-post-104.html)" --post_date="2013-07-16T07:07:00.000-07:00" --post_excerpt="Imagem virtual do Estaleiro na Enseada do Paraguaçu: as obras do Pólo Naval em Maragojipe estão em andamento. 

A Estaleiro Enseada do Paraguaçu, instalada em Maragojipe, lançou sua página oficial na internet. O site www.eepsa.com.br serve para os candidatos interessados em trabalhar na obra reali" --post_category='filosofia'
rm -f /tmp/wp-post-104.html

echo '  [106/375] post: Igreja Batista Káris promove diálogo sobre as mani...'
$WP post create --post_type="post" --post_title="Igreja Batista Káris promove diálogo sobre as manifestações em todo o Brasil" --post_status="publish" --post_content="$(cat /tmp/wp-post-105.html)" --post_date="2013-07-02T14:42:00.001-07:00" --post_excerpt="Dentro do \"Projeto Quinta de Primeira\" - que compreende uma série de atividades especiais que se realizam sempre na primeira quinta feira de cada mês - a Igreja Batista Káris (IBK) promove no próximo dia 04/07 um diálogocom educadores que buscarão entender e refletir sobre as origens, a natureza e" --post_category='educacao'
rm -f /tmp/wp-post-105.html

echo '  [107/375] material: Depois da forte pressão popular, Câmara dos Deputa...'
$WP post create --post_type="material" --post_title="Depois da forte pressão popular, Câmara dos Deputados rejeita a PEC 37" --post_status="publish" --post_content="$(cat /tmp/wp-post-106.html)" --post_date="2013-06-25T18:53:00.002-07:00" --post_excerpt="Iolando Lourenço e Ivan Richard l Agência Brasil






Jose Cruz l Ag. Brasil

Deputados no plenário da Câmara em sessão de votação da PEC 37





Brasília - A pressão das manifestações populares das últimas semanas, em todo o país, resultou nesta terça-feira, 25, na derrubada da Proposta de Emend"
rm -f /tmp/wp-post-106.html

echo '  [108/375] post: "CURA GAY": A REVOLTA CONTRA UM PROJETO QUE NÃO EX...'
$WP post create --post_type="post" --post_title="\"CURA GAY\": A REVOLTA CONTRA UM PROJETO QUE NÃO EXISTE" --post_status="publish" --post_content="$(cat /tmp/wp-post-107.html)" --post_date="2013-06-20T12:39:00.002-07:00" --post_excerpt="Irenilson Barbosa

Tenho acompanhado com interesse
a mobilização de diversos sujeitos sociais, indignados ou revoltados com a
suposta aprovação de um projeto de decreto legislativo que oficializaria a “cura
gay”, ou seja: Segundo a quase totalidade da imprensa e dos inconformados
ativistas das rede" --post_category='filosofia'
rm -f /tmp/wp-post-107.html

echo '  [109/375] post: Vitória conquista prêmio com a campanha "Meu Sangu...'
$WP post create --post_type="post" --post_title="Vitória conquista prêmio com a campanha \"Meu Sangue é Rubro-Negro\"" --post_status="publish" --post_content="$(cat /tmp/wp-post-108.html)" --post_date="2013-06-19T11:08:00.000-07:00" --post_excerpt="Campanha feita em 2012 é mais uma vez premiada
Por Ítalo Oliveira | Yahoo! Esporte Interativo – 52 minutos atrás






Ver foto
Yahoo! Esporte Interativo/Site Oficial do Vitória - Vitória ganha quatro prêmios em Cannes









Exibir galeria
Clubes nordestinos com mais sócios-torcedores

 Veja t" --post_category='filosofia'
rm -f /tmp/wp-post-108.html

echo '  [110/375] post: EMBRIAGADOS PELA BELEZA DAS PASSEATAS...'
$WP post create --post_type="post" --post_title="EMBRIAGADOS PELA BELEZA DAS PASSEATAS" --post_status="publish" --post_content="$(cat /tmp/wp-post-109.html)" --post_date="2013-06-18T10:09:00.000-07:00" --post_excerpt="Irenilson Barbosa







Neste dia 18 de junho de 2013, o Brasil acordou de ressaca.
Ressaca do que? De passeatas. Mais de duas dezenas de cidades (26), incluindo-se 12 capitais, assistiram passeatas ao vivo ou pela TV. Foram passeatas de
protestos. Protestavam contra o que? Ah,
nisso está o inedit" --post_category='politica'
rm -f /tmp/wp-post-109.html

echo '  [111/375] livro: Governo dos EUA viola privacidade de internautas e...'
$WP post create --post_type="livro" --post_title="Governo dos EUA viola privacidade de internautas em todo o mundo e quer punir quem denuncia o crime" --post_status="publish" --post_content="$(cat /tmp/wp-post-110.html)" --post_date="2013-06-13T06:06:00.001-07:00" --post_excerpt="Com apenas 29 anos, Edward desistiu de sua carreira para denunciar o absurdo programa PRISM, uma medida do governo americano para espionar todos os nossos emails, mensagens de Skype e publicações no Facebook durante anos. Se milhões de pessoas agirem urgentemente em defesa de Edward Snowden, poder"
rm -f /tmp/wp-post-110.html

echo '  [112/375] post: No Dia dos Namorados, um carinho todo especial pra...'
$WP post create --post_type="post" --post_title="No Dia dos Namorados, um carinho todo especial pra ela..." --post_status="publish" --post_content="$(cat /tmp/wp-post-111.html)" --post_date="2013-06-12T14:55:00.001-07:00" --post_category='filosofia'
rm -f /tmp/wp-post-111.html

echo '  [113/375] post: UFRB abre inscrições para cursos de idiomas...'
$WP post create --post_type="post" --post_title="UFRB abre inscrições para cursos de idiomas" --post_status="publish" --post_content="$(cat /tmp/wp-post-112.html)" --post_date="2013-06-12T08:22:00.000-07:00" --post_excerpt="Estão abertas até o dia 28 de junho as inscrições para os cursos do Programa de Desenvolvimento Acadêmico em Línguas da Universidade Federal do Recôncavo da Bahia (UFRB). Serão oferecidas turmas de Língua Inglesa, Língua Espanhola e Produção Textual em Língua Portuguesa nos quatro campi da UFRB par" --post_category='educacao'
rm -f /tmp/wp-post-112.html

echo '  [114/375] post: Dilma sanciona projeto de lei que transforma 2 de ...'
$WP post create --post_type="post" --post_title="Dilma sanciona projeto de lei que transforma 2 de Julho em data nacional" --post_status="publish" --post_content="$(cat /tmp/wp-post-113.html)" --post_date="2013-06-10T20:53:00.000-07:00" --post_excerpt="Foto: Reprodução




A presidente Dilma Rousseff sancionou, na semana passada, o projeto que institui o dia 2 de Julho como data histórica no calendário das efemérides nacionais. A deputada federal Alice Portugal (PCdoB-BA), autora do projeto de lei 61/2008, que eleva o dia da Independência da" --post_category='filosofia'
rm -f /tmp/wp-post-113.html

echo '  [115/375] post: SENAD prorroga inscrição em Concurso sobre Educaçã...'
$WP post create --post_type="post" --post_title="SENAD prorroga inscrição em Concurso sobre Educação na Prevenção do Uso de Drogas" --post_status="publish" --post_content="$(cat /tmp/wp-post-114.html)" --post_date="2013-06-10T09:33:00.002-07:00" --post_excerpt="Prorrogado até 10/07/2013 - SENAD promove Concurso Nacional de Cartazes, Vídeos, Fotografias, Jingles e Monografias (25/03/2013)


A Secretaria Nacional de Políticas sobre Drogas - SENAD, do Ministério da Justiça, com o objetivo de incentivar a participação dos diferentes níveis estudantis em ativi" --post_category='educacao'
rm -f /tmp/wp-post-114.html

echo '  [116/375] post: Seminário Internacional de Educação do Campo na UF...'
$WP post create --post_type="post" --post_title="Seminário Internacional de Educação do Campo na UFRB" --post_status="publish" --post_content="$(cat /tmp/wp-post-115.html)" --post_date="2013-06-10T07:16:00.000-07:00" --post_excerpt="Tema:



“A Educação dos Camponeses na América Latina: da subalternidade à emancipação”



Mesa de Abertura:



João Pedro Stédile (MST) e Prof Dr. Samuel H. Carvajal Ruiz (Universidad Bolivariana de Venezuela)





Informações e contato:

SITÍO - http://www.ufrb.edu.br/educampo/siec

BLO" --post_category='educacao'
rm -f /tmp/wp-post-115.html

echo '  [117/375] publicacao: PRECONCEITO: Evangélicos reúnem mais de 70 mil em ...'
$WP post create --post_type="publicacao" --post_title="PRECONCEITO: Evangélicos reúnem mais de 70 mil em dia útil pela liberdade de expressão e imprensa finge que não viu" --post_status="publish" --post_content="$(cat /tmp/wp-post-116.html)" --post_date="2013-06-08T07:24:00.000-07:00" --post_excerpt="Independente de concordar ou não com o movimento, é inadmissível a conduta da imprensa brasileira neste episódio e em tantos outros envolvendo evangélicos. Quando se trata de crimes ou escândalos individuais, o preconceito vem à tona com extensas coberturas como se todo evangélico fosse delinquent"
rm -f /tmp/wp-post-116.html

echo '  [118/375] publicacao: Inscrições abertas para Professor Substituto no CF...'
$WP post create --post_type="publicacao" --post_title="Inscrições abertas para Professor Substituto no CFP da UFRB" --post_status="publish" --post_content="$(cat /tmp/wp-post-117.html)" --post_date="2013-06-07T08:41:00.000-07:00" --post_excerpt="O Centro de Formação de Professores (CFP) da Universidade Federal do Recôncavo da Bahia (UFRB) torna público que estão abertas as inscrições para o processo seletivo simplificado com vistas à contratação de docente por tempo determinado. A oferta é de uma vaga na área de docências, saberes e prát"
rm -f /tmp/wp-post-117.html

echo '  [119/375] post: EMPREGOS EM MARAGOJIPE: 1,6 mil vagas em estaleiro...'
$WP post create --post_type="post" --post_title="EMPREGOS EM MARAGOJIPE: 1,6 mil vagas em estaleiro até o final de 2013" --post_status="publish" --post_content="$(cat /tmp/wp-post-118.html)" --post_date="2013-06-05T08:28:00.002-07:00" --post_excerpt="Estaleiro abrirá 1,6 mil vagas até o final do ano; confira as oportunidades

Com o Estaleiro Enseada do Paraguaçu, mais de 5 mil empregos diretos devem ser criados, bem como 10 mil indiretos




Victor Longo

victor.longo@redebahia.com.br



Você tem interesse em trabalhar na indústria naval e está" --post_category='filosofia'
rm -f /tmp/wp-post-118.html

echo '  [120/375] post: DIA DO PASTOR BATISTA: Uma brevíssima homenagem e ...'
$WP post create --post_type="post" --post_title="DIA DO PASTOR BATISTA: Uma brevíssima homenagem e a minha gratidão" --post_status="publish" --post_content="$(cat /tmp/wp-post-119.html)" --post_date="2013-06-05T07:54:00.000-07:00" --post_excerpt="Esta semana os batistas homenageiam seus pastores, tendo no segundo domingo de junho (09/06), o DIA DO PASTOR. Alguns receberão efusivas homenagens, outros apenas um abraço e as usuais felicitações... Talvez alguém nem se lembre, mas terá valido a pena. Quero que você que é pastor também se lembre" --post_category='filosofia'
rm -f /tmp/wp-post-119.html

echo '  [121/375] post: LAURO DE FREITAS ABRE INSCRIÇÕES PARA SELEÇÃO DE C...'
$WP post create --post_type="post" --post_title="LAURO DE FREITAS ABRE INSCRIÇÕES PARA SELEÇÃO DE CADETES MIRINS" --post_status="publish" --post_content="$(cat /tmp/wp-post-120.html)" --post_date="2013-06-03T17:53:00.001-07:00" --post_excerpt="A Prefeitura Municipal de Lauro de Freitas abre, nesta terça-feira (21), as inscrições para a Escola dos Cadetes Mirins. Os postos de inscrições para o processo de seleção serão instalados nas unidades escolares da rede municipal, obedecendo a um calendário preparado pela coordenação do projeto" --post_category='educacao'
rm -f /tmp/wp-post-120.html

echo '  [122/375] post: Software brasileiro que traduz mundo digital para ...'
$WP post create --post_type="post" --post_title="Software brasileiro que traduz mundo digital para surdos é premiado pela ONU" --post_status="publish" --post_content="$(cat /tmp/wp-post-121.html)" --post_date="2013-06-01T11:07:00.001-07:00" --post_excerpt="Rate This



Hugo, o avatar do aplicativo, traduz texto, áudio e imagens para a linguagem de sinais

Programa Mãos que Falam, idealizado por três alagoanos, traduz sons, textos e até fotos para a Linguagem Brasileira de Sinais. Público alvo são pessoas com deficiência audi" --post_category='filosofia'
rm -f /tmp/wp-post-121.html

echo '  [123/375] post: Marinha abre concurso para padre e pastor: Salário...'
$WP post create --post_type="post" --post_title="Marinha abre concurso para padre e pastor: Salário de R$ 7.400" --post_status="publish" --post_content="$(cat /tmp/wp-post-122.html)" --post_date="2013-05-20T18:50:00.001-07:00" --post_excerpt="Foto: Feira OnLine/Reprodução

O prazo está quase se encerrando - as inscrições estão abertas só até o dia 22 de maio - mas a Marinha do Brasil está com duas vagas para cargos de padre e pastor para capelania.

De acordo com o edital do concurso, o salário para os cargos é de R$ 7.400. Para conc" --post_category='filosofia'
rm -f /tmp/wp-post-122.html

echo '  [124/375] material: PELO DIREITO DE DISCORDAR!...'
$WP post create --post_type="material" --post_title="PELO DIREITO DE DISCORDAR!" --post_status="publish" --post_content="$(cat /tmp/wp-post-123.html)" --post_date="2013-05-11T12:01:00.001-07:00" --post_excerpt="Me solidarizo com o texto abaixo e título em epígrafe, de autoria do Pr. Ariovaldo Ramos e por isso o publico neste nosso blogue que é um dos nossos redutos de liberdade de expressão. Confira e tire suas conclusões.

Por Ariovaldo Ramos

Fui advertido de que nesse momento, que estamos vivendo na I"
rm -f /tmp/wp-post-123.html

echo '  [125/375] publicacao: Divulgado o calendário de inscrições e provas do E...'
$WP post create --post_type="publicacao" --post_title="Divulgado o calendário de inscrições e provas do ENEM 2013" --post_status="publish" --post_content="$(cat /tmp/wp-post-124.html)" --post_date="2013-05-08T20:43:00.000-07:00" --post_excerpt="As inscrições do Enem 2013 (Exame Nacional do Ensino Médio) começam na próxima segunda-feira, dia 13 de maio. Os estudantes terão até 27 de maio para fazer a inscrição no exame e poderão realizar o pagamento da inscrição até o dia 29 de maio. O edital do Enem 2013 será publicado amanhã (9). 
As"
rm -f /tmp/wp-post-124.html

echo '  [126/375] livro: "ESCUTA ESSA!" Livro digital de diversos autores r...'
$WP post create --post_type="livro" --post_title="\"ESCUTA ESSA!\" Livro digital de diversos autores reúne música, internet e literatura" --post_status="publish" --post_content="$(cat /tmp/wp-post-125.html)" --post_date="2013-05-08T09:36:00.000-07:00" --post_excerpt="Escrito por autores de diferentes estados, e-book reúne 31 contos inspirados na nova música brasileiraVivendo do Ócio, Cícero, Tulipa Ruiz, Vanguart. Poderia ser a lista de artistas e bandas a compor um festival alternativo de música. No caso do \"Escuta Essa\", e-book colaborativo lançado on-line na"
rm -f /tmp/wp-post-125.html

echo '  [127/375] post: UFRB realiza Colóquio sobre Inclusão no Ensino Sup...'
$WP post create --post_type="post" --post_title="UFRB realiza Colóquio sobre Inclusão no Ensino Superior" --post_status="publish" --post_content="$(cat /tmp/wp-post-126.html)" --post_date="2013-04-25T08:10:00.000-07:00" --post_excerpt="Data: Sexta-feira 26 Abril 2013
Local: Auditório da Reitoria - Campus Cruz das Almas




O Núcleo de Políticas de Inclusão, juntamente com Grupo de Estudos Educação, Diversidade e Inclusão, 
promove o Colóquio sobre Inclusão no Ensino Superior: construindo caminhos para desconstrução de 
barreiras" --post_category='educacao'
rm -f /tmp/wp-post-126.html

echo '  [128/375] publicacao: Lei impede exigência de pós-graduação para novos p...'
$WP post create --post_type="publicacao" --post_title="Lei impede exigência de pós-graduação para novos professores de federais" --post_status="publish" --post_content="$(cat /tmp/wp-post-127.html)" --post_date="2013-04-18T07:45:00.001-07:00" --post_excerpt="Uma lei de iniciativa do governo federal que entrou em vigor em março determinou que as universidades federais não podem mais exigir nos concursos para professor os títulos de mestre ou doutor dos candidatos.

MEC diz que vai devolver autonomia a universidades

Na prática, quem só tiver diploma de"
rm -f /tmp/wp-post-127.html

echo '  [129/375] livro: Resultado final do Concurso Banco do Brasil: Confi...'
$WP post create --post_type="livro" --post_title="Resultado final do Concurso Banco do Brasil: Confira a lista de aprovados" --post_status="publish" --post_content="$(cat /tmp/wp-post-128.html)" --post_date="2013-04-16T12:34:00.000-07:00" --post_excerpt="Foi divulgado nesta terça-feira (16), o resultado final do concurso do Banco do Brasil para formação de cadastro de reserva do cargo de escriturário (nível médio).

Cerca de 339.173 candidatos participaram do concurso cujas vagas são para os estados do Acre, Mato Grosso, Paraíba, Paraná, Amapá, R"
rm -f /tmp/wp-post-128.html

echo '  [130/375] post: UFRB ABRE CONCURSO PARA DOCENTES COM 28 VAGAS PARA...'
$WP post create --post_type="post" --post_title="UFRB ABRE CONCURSO PARA DOCENTES COM 28 VAGAS PARA O CFP" --post_status="publish" --post_content="$(cat /tmp/wp-post-129.html)" --post_date="2013-04-11T20:49:00.000-07:00" --post_excerpt="Concurso Docente Edital Nº 06/2013| I




São 28 vagas para diversas Matérias/Áreas de Conhecimento do Centro de Formação de Professores. As inscrições estarão abertas no período de 10/04/2013 a 06/05/2013.

Edital

Edital Nº 06/2013

Extrato Edital Nº 06/2013

Inscrição

Inscrição

GRU (instruç" --post_category='filosofia'
rm -f /tmp/wp-post-129.html

echo '  [131/375] post: Seleção do Programa Jovens Talentos para a Ciência...'
$WP post create --post_type="post" --post_title="Seleção do Programa Jovens Talentos para a Ciência na UFRB" --post_status="publish" --post_content="$(cat /tmp/wp-post-130.html)" --post_date="2013-04-06T17:07:00.000-07:00" --post_excerpt="O Programa Bolsa Jovens Talentos para a Ciência (PJTC) tem como objetivo promover o estímulo à formação científica de estudantes ingressantes em cursos de graduação em universidades federais e institutos federais de educação, ciência e tecnologia, por meio da concessão de bolsas de estudo, com vis" --post_category='educacao'
rm -f /tmp/wp-post-130.html

echo '  [132/375] post: Dilma sanciona lei que obriga matrícula de criança...'
$WP post create --post_type="post" --post_title="Dilma sanciona lei que obriga matrícula de crianças com 4 anos na Pré-Escola" --post_status="publish" --post_content="$(cat /tmp/wp-post-131.html)" --post_date="2013-04-05T17:43:00.000-07:00" --post_excerpt="“A educação infantil, primeira etapa da educação básica, tem como finalidade o desenvolvimento integral da criança de até 5 anos, em seus aspectos físico, psicológico, intelectual e social, complementando a ação da família e da comunidade”, diz a lei. Foto: Reprodução


A presidente Dilma Rou" --post_category='educacao'
rm -f /tmp/wp-post-131.html

echo '  [133/375] post: Curso de Filosofia da UFRB é reconhecido pelo MEC...'
$WP post create --post_type="post" --post_title="Curso de Filosofia da UFRB é reconhecido pelo MEC" --post_status="publish" --post_content="$(cat /tmp/wp-post-132.html)" --post_date="2013-04-03T21:06:00.000-07:00" --post_excerpt="O Curso de Licenciatura em Filosofia da Universidade Federal do Recôncavo da Bahia (UFRB) obteve o reconhecimento pelo Ministério da Educação (MEC). Com isso, passa a integrar a lista de cursos ofertados pela instituição que concluíram o primeiro ciclo avaliativo.





De acordo com a avaliação d" --post_category='educacao'
rm -f /tmp/wp-post-132.html

echo '  [134/375] post: Prorrogadas as inscrições para professores em curs...'
$WP post create --post_type="post" --post_title="Prorrogadas as inscrições para professores em cursos da RENAFOR" --post_status="publish" --post_content="$(cat /tmp/wp-post-133.html)" --post_date="2013-03-28T09:30:00.001-07:00" --post_excerpt="Atendendo a solicitação do Instituto Anísio Teixeira (IAT) divulgamos que foram prorrogadas as inscrições dos cursos de aperfeiçoamento para professores das séries finais do Ensino Fundamental, ofertados pela Rede Nacional de Formação Continuada (RENAFOR), para os Municípios de Feira de Santana," --post_category='educacao'
rm -f /tmp/wp-post-133.html

echo '  [135/375] post: Senado aprova Projeto de Lei que obriga cirurgia d...'
$WP post create --post_type="post" --post_title="Senado aprova Projeto de Lei que obriga cirurgia de reparação da mama pelo SUS" --post_status="publish" --post_content="$(cat /tmp/wp-post-134.html)" --post_date="2013-03-28T08:27:00.000-07:00" --post_excerpt="Foi aprovado no último dia 26 de março de 2013, pelo Plenário do Senado Federal, o Projeto de Lei 
proposto pela ex-deputada Rebecca Garcia, que obriga a realização de cirurgia plástica para a 
reconstrução da mama pelo SUS, em casos de mutilação decorrente do tratamento contra o câncer." --post_category='filosofia'
rm -f /tmp/wp-post-134.html

echo '  [136/375] livro: Cientistas anunciam cura para leucemia...'
$WP post create --post_type="livro" --post_title="Cientistas anunciam cura para leucemia" --post_status="publish" --post_content="$(cat /tmp/wp-post-135.html)" --post_date="2013-03-26T20:39:00.000-07:00" --post_excerpt="Reprogramação das células de defesa para combater o câncer é esperança contra uma forma aguda da doença.








Um estudo publicado esta semana lançou novas perspectivas no tratamento de uma forma de leucemia aguda e de difícil tratamento, a leucemia linfocítica aguda (LLA).









Uma equipe"
rm -f /tmp/wp-post-135.html

echo '  [137/375] post: VAGAS DE EMPREGOS E ESTÁGIOS REMUNERADOS...'
$WP post create --post_type="post" --post_title="VAGAS DE EMPREGOS E ESTÁGIOS REMUNERADOS" --post_status="publish" --post_content="$(cat /tmp/wp-post-136.html)" --post_date="2013-03-26T08:55:00.002-07:00" --post_excerpt="Visando criar alternativas de geração de renda aos nossos leitores e seguidores, divulgamos mais uma vez uma relação com diversas vagas de empregos e estágios remunerados, disponibilizadas em comunicado de Fidélis Santana que nos presta esse importante serviço. Os candidatos deverão comparecer ao" --post_category='filosofia'
rm -f /tmp/wp-post-136.html

echo '  [138/375] post: O Segredo do Cativar...'
$WP post create --post_type="post" --post_title="O Segredo do Cativar" --post_status="publish" --post_content="$(cat /tmp/wp-post-137.html)" --post_date="2013-03-21T23:10:00.000-07:00" --post_excerpt="PORQUÊ ME CATIVASTE
CATIVAR

Quem és tu? ... perguntou o principezinho... tu és bem bonita...Sou uma raposa ... ela respondeu ...Príncipe : .vem brincar comigo... estou tão triste...Raposa : ...eu não posso brincar contigo! Não me cativaram ainda.Príncipe : ...ah ! desculpe-me... o qu" --post_category='cultura'
rm -f /tmp/wp-post-137.html

echo '  [139/375] publicacao: SINDROME DE DOWN E COMBATE À DISCRIMINAÇÃO RACIAL ...'
$WP post create --post_type="publicacao" --post_title="SINDROME DE DOWN E COMBATE À DISCRIMINAÇÃO RACIAL NO MESMO DIA" --post_status="publish" --post_content="$(cat /tmp/wp-post-138.html)" --post_date="2013-03-21T11:49:00.000-07:00" --post_excerpt="Em 21 de março comemora-se o Dia Internacional contra a Discriminação Racial, em referência ao Massacre de Sharpeville, instituída pela ONU.Você conhece a história desse dia?Em 21 de março de 1960, em Joanesburgo, na África do Sul, 20.000 pessoas faziam um protesto contra a Lei do Passe, qu"
rm -f /tmp/wp-post-138.html

echo '  [140/375] post: GAROTO CAMPEÃO: TARCÍSIO EMANNUEL VENCE CONCURSO C...'
$WP post create --post_type="post" --post_title="GAROTO CAMPEÃO: TARCÍSIO EMANNUEL VENCE CONCURSO CULTURAL DO IFBA" --post_status="publish" --post_content="$(cat /tmp/wp-post-139.html)" --post_date="2013-03-21T09:19:00.000-07:00" --post_excerpt="Tarcísio Emannuel, 17 anos, aluno de Eletrônica no IFBA: O cara é campeão!



O vencedor do concurso cultural para escolha da marca da Comissão Interna de Sustentabilidade Ambiental (CISA) do campus de Salvador do IFBA foi o estudante Tarcísio Emannuel Fonseca Barbosa. A mudança de nome do grupo j" --post_category='filosofia'
rm -f /tmp/wp-post-139.html

echo '  [141/375] post: 21 de Março - Dia Internacional da Síndrome de Dow...'
$WP post create --post_type="post" --post_title="21 de Março - Dia Internacional da Síndrome de Down" --post_status="publish" --post_content="$(cat /tmp/wp-post-140.html)" --post_date="2013-03-21T06:35:00.000-07:00" --post_excerpt="A Síndrome de Down é um acontecimento genético natural e universal. Isso quer dizer que a síndrome não é resultado da ação ou do descuido de mães ou pais, como muitos pensam. E nem é uma doença. Ela é causada por um erro na divisão das células durante a formação do bebê (ainda feto). Só para vo" --post_category='filosofia'
rm -f /tmp/wp-post-140.html

echo '  [142/375] post: 14 de Março - DIA NACIONAL DA POESIA...'
$WP post create --post_type="post" --post_title="14 de Março - DIA NACIONAL DA POESIA" --post_status="publish" --post_content="$(cat /tmp/wp-post-141.html)" --post_date="2013-03-14T10:31:00.000-07:00" --post_excerpt="\"Que é a poesia? uma ilha cercada de palavras por todos os lados\" 




Poeta brasileiro homenageado com o dia da poesia

A poesia é a arte da linguagem humana, desde o gênero lírico, que expressa
sentimentos através do ritmo e das palavras recitadas ou cantadas. Seus fins estéticos
transformaram a" --post_category='filosofia'
rm -f /tmp/wp-post-141.html

echo '  [143/375] post: Rodoviários fecham a estação da Lapa e prometem ma...'
$WP post create --post_type="post" --post_title="Rodoviários fecham a estação da Lapa e prometem manifestações no fim da tarde" --post_status="publish" --post_content="$(cat /tmp/wp-post-142.html)" --post_date="2013-03-11T13:09:00.001-07:00" --post_excerpt="Rodoviários fecharam a entrada e a saída da estação da Lapa, em Salvador, na tarde desta segunda-feira (11/03). Segundo a Transalvador, orgão (ir)responsável pelo trânsito na capital baiana, a ação teve início por volta das 16h, com o objetivo de questionar a derrubada de um banheiro que serve ao..." --post_category='filosofia'
rm -f /tmp/wp-post-142.html

echo '  [144/375] post: RENAFOR oferece Curso de Aperfeiçoamento para prof...'
$WP post create --post_type="post" --post_title="RENAFOR oferece Curso de Aperfeiçoamento para professores" --post_status="publish" --post_content="$(cat /tmp/wp-post-143.html)" --post_date="2013-03-11T12:36:00.001-07:00" --post_excerpt="No dia 23 de Março de 2013 terá início o Curso de Aperfeiçoamento da Rede Nacional de Formação Continuada (RENAFOR). O objetivo da RENAFOR é contribuir para a organização da prática docente, com ênfase na experimentação pedagógica do professor que atua nas séries finais do ensino fundamental das á" --post_category='educacao'
rm -f /tmp/wp-post-143.html

echo '  [145/375] post: 14 DE MARÇO: DIA MUNDIAL DO RIM...'
$WP post create --post_type="post" --post_title="14 DE MARÇO: DIA MUNDIAL DO RIM" --post_status="publish" --post_content="$(cat /tmp/wp-post-144.html)" --post_date="2013-03-11T11:35:00.000-07:00" --post_excerpt="Com o tema: PARE DE AGREDIR O SEU RIM, comemora-se no dia 14 de março de 2013, o Dia Mundial do Rim.



O número de pessoas que sofrem de doenças renais é muito grande. Algumas sofrem de doenças que não são graves. Outras apresentam doenças como a diabetes e pressão alta que, se não tratadas de" --post_category='filosofia'
rm -f /tmp/wp-post-144.html

echo '  [146/375] post: AS CRIATURAS MAIS LINDAS...'
$WP post create --post_type="post" --post_title="AS CRIATURAS MAIS LINDAS" --post_status="publish" --post_content="$(cat /tmp/wp-post-145.html)" --post_date="2013-03-07T22:29:00.001-08:00" --post_excerpt="No Dia Internacional da Mulher, 08 de Março, uma brevíssima homenagem a essas pessoas que fazem a vida parecer sempre linda, mesmo em meio aos seus turbilhões de perguntas, ansiedades, ciúmes, amizade e graça... Meus versos, meu cheiro e minha homenagem a vocês, criaturas realmente lindas!" --post_category='cotidiano'
rm -f /tmp/wp-post-145.html

echo '  [147/375] livro: GRITANDO... QUASE SEM PALAVRAS...'
$WP post create --post_type="livro" --post_title="GRITANDO... QUASE SEM PALAVRAS" --post_status="publish" --post_content="$(cat /tmp/wp-post-146.html)" --post_date="2013-03-05T05:00:00.000-08:00" --post_excerpt="Em tempos de escassez de atenção às pessoas e um notável esquecimento do outro, um gesto pessoal se dissemina na internet e ganha proporções de um exemplo de sensibilidade, dado por alguém que se importa com gente mais do que com coisas. O publico como um alento e um renovo na certeza e na espera"
rm -f /tmp/wp-post-146.html

echo '  [148/375] publicacao: Hemeroteca Digital Brasileira oferece acesso a per...'
$WP post create --post_type="publicacao" --post_title="Hemeroteca Digital Brasileira oferece acesso a periódicos e publicações antigas" --post_status="publish" --post_content="$(cat /tmp/wp-post-147.html)" --post_date="2013-03-02T17:04:00.000-08:00" --post_excerpt="A Fundação Biblioteca Nacional oferece aos seus usuários a HEMEROTECA DIGITAL BRASILEIRA, portal de periódicos nacionais que proporciona ampla consulta, pela internet, ao seu acervo de periódicos – jornais, revistas, anuários, boletins etc. – e de publicações seriadas.

Na HEMEROTECA DIGITAL BRASI"
rm -f /tmp/wp-post-147.html

echo '  [149/375] publicacao: Nota Pública informa retorno às aulas no CFP/UFRB ...'
$WP post create --post_type="publicacao" --post_title="Nota Pública informa retorno às aulas no CFP/UFRB ainda hoje" --post_status="publish" --post_content="$(cat /tmp/wp-post-148.html)" --post_date="2013-02-28T09:26:00.000-08:00" --post_excerpt="Recebemos e repassamos a nota abaixo, comunicando o restabelecimento da vigilância no Centro de Formação de Professores da UFRB e o imediato retorno às aulas. Confira o texto na íntegra:

\"NOTA PÚBLICA



Os docentes do Centro de Formação de Professores (CFP), reunidos na manhã desta quinta-feira..."
rm -f /tmp/wp-post-148.html

echo '  [150/375] post: SENAD prorroga inscrições em Curso para Prevenção ...'
$WP post create --post_type="post" --post_title="SENAD prorroga inscrições em Curso para Prevenção do Uso de Drogas" --post_status="publish" --post_content="$(cat /tmp/wp-post-149.html)" --post_date="2013-02-25T13:01:00.000-08:00" --post_category='filosofia'
rm -f /tmp/wp-post-149.html

echo '  [151/375] post: NOTÍCIAS DA UFRB: Editais e Processos Seletivos pa...'
$WP post create --post_type="post" --post_title="NOTÍCIAS DA UFRB: Editais e Processos Seletivos para Mestrado e Docência" --post_status="publish" --post_content="$(cat /tmp/wp-post-150.html)" --post_date="2013-02-23T06:31:00.001-08:00" --post_excerpt="Acesso principal ao Centro de Formação de Professores - CFP (Amargosa)


Edital de seleção extra para mestrado em Ciência Animal

A Universidade Federal do Recôncavo da Bahia, através do Programa de Pós-graduação em Ciência Animal do Centro de Ciências Agrárias, Ambientais e Biológicas (CCAAB)," --post_category='educacao'
rm -f /tmp/wp-post-150.html

echo '  [152/375] post: UM AMIGO ESPECIAL[1]...'
$WP post create --post_type="post" --post_title="UM AMIGO ESPECIAL[1]" --post_status="publish" --post_content="$(cat /tmp/wp-post-151.html)" --post_date="2013-02-21T08:40:00.000-08:00" --post_excerpt="Irenilson de Jesus Barbosa







Um amigo especial não é alguém irreal, quase até sobre-humano,

Ou que aparece de ano em ano e nos diz as palavras mais afáveis;

Mas é aquele das horas instáveis, quando rugem os desenganos,

Quando se fecham todos os panos e aplausos são desagradáveis.



Um ami" --post_category='filosofia'
rm -f /tmp/wp-post-151.html

echo '  [153/375] material: UFRB fará inscrições em Cadastro Seletivo para vag...'
$WP post create --post_type="material" --post_title="UFRB fará inscrições em Cadastro Seletivo para vagas remanescentes 2013.1" --post_status="publish" --post_content="$(cat /tmp/wp-post-152.html)" --post_date="2013-02-16T16:10:00.000-08:00" --post_excerpt="A Universidade Federal do Recôncavo da Bahia (UFRB), através da sua Pró-Reitora de Graduação(PROGRAD), divulga o Edital Nº 002/2013 que trata sobre o Cadastro Seletivo presencial para ocupação das vagas remanescentes do Sisu 2013.1. Nele, são ofertadas 674 vagas para cursos diversos de graduação na"
rm -f /tmp/wp-post-152.html

echo '  [154/375] publicacao: RIR É CONTAGIOSO... ESTÁ RINDO DE QUÊ?...'
$WP post create --post_type="publicacao" --post_title="RIR É CONTAGIOSO... ESTÁ RINDO DE QUÊ?" --post_status="publish" --post_content="$(cat /tmp/wp-post-153.html)" --post_date="2013-01-18T06:27:00.001-08:00" --post_excerpt="O texto abaixo, de autoria de Leandro Sarmatz, foi publicado na revista Superinteressante de fevereiro de 2002, com o título \"RIR, O MELHOR REMÉDIO\" e trás um curioso relato que enseja uma discussão sobre o riso. Confira... e ria, se puder. Cheiro! 

E m janeiro de 1962, um surto de riso num int"
rm -f /tmp/wp-post-153.html

echo '  [155/375] material: UFRB divulga resultado e datas de matrícula dos se...'
$WP post create --post_type="material" --post_title="UFRB divulga resultado e datas de matrícula dos selecionados no SiSU 2013.1" --post_status="publish" --post_content="$(cat /tmp/wp-post-154.html)" --post_date="2013-01-16T12:43:00.001-08:00" --post_excerpt="O Ministério da Educação (MEC) divulgou a primeira chamada do Sistema de Seleção Unificada (SiSU) 2013.1, que selecionou candidatos do Enem às vagas em instituições públicas de ensino superior.

Os candidatos classificados para as 1.310 vagas ofertadas pela Universidade Federal do Recôncavo da"
rm -f /tmp/wp-post-154.html

echo '  [156/375] publicacao: CIÊNCIA: Ler poesia é mais útil para o cérebro que...'
$WP post create --post_type="publicacao" --post_title="CIÊNCIA: Ler poesia é mais útil para o cérebro que livros de autoajuda" --post_status="publish" --post_content="$(cat /tmp/wp-post-155.html)" --post_date="2013-01-15T19:07:00.000-08:00" --post_excerpt="DA FOLHA DE SÃO PAULO


Ler autores clássicos, como Shakespeare, William Wordsworth e T.S. Eliot, estimula a mente e a poesia pode ser mais eficaz em tratamentos do que os livros de autoajuda, segundo um estudo da Universidade de Liverpool publicado nesta terça-feira (15).

Especialistas em ciência"
rm -f /tmp/wp-post-155.html

echo '  [157/375] post: UM DIA PARA CELEBRAR: Há 84 anos nascia o líder Ma...'
$WP post create --post_type="post" --post_title="UM DIA PARA CELEBRAR: Há 84 anos nascia o líder Martin Luther King Jr." --post_status="publish" --post_content="$(cat /tmp/wp-post-156.html)" --post_date="2013-01-15T08:04:00.002-08:00" --post_excerpt="Ele foi um pastor batista e ativista político norte-americano. Tornou-se um dos mais importantes líderes do movimento dos direitos civis dos negros nos Estados Unidos, e no mundo, com uma campanha de não violência e de amor ao próximo.


Ordenado ministro Batista, King tornou-se um ativista dos" --post_category='politica'
rm -f /tmp/wp-post-156.html

echo '  [158/375] publicacao: Notas de candidatos cotistas estão entre as maiore...'
$WP post create --post_type="publicacao" --post_title="Notas de candidatos cotistas estão entre as maiores do SISU" --post_status="publish" --post_content="$(cat /tmp/wp-post-157.html)" --post_date="2013-01-14T15:08:00.000-08:00" --post_excerpt="De acordo com um balanço preliminar do Sistema de Seleção Unificada (Sisu), ao contrário do que dizem os críticos às cotas, os alunos cotistas vêm apresentando um alto desempenho no programa. Entre as dez maiores notas de corte do país, três foram obtidas por candidatos que poderão se beneficiar d"
rm -f /tmp/wp-post-157.html

echo '  [159/375] post: Nióbio – A riqueza que o Brasil despreza...'
$WP post create --post_type="post" --post_title="Nióbio – A riqueza que o Brasil despreza" --post_status="publish" --post_content="$(cat /tmp/wp-post-158.html)" --post_date="2013-01-14T06:12:00.001-08:00" --post_excerpt="Embora eu não conheça a fundo esta questão, nem a posição político-partidária do autor do texto abaixo, concordamos que esse debate precisa ser feito por toda a sociedade brasileira para que ninguém explore e exproprie nossas riquezas, as quais poderiam fazer de nós um povo bem melhor atendido em" --post_category='filosofia'
rm -f /tmp/wp-post-158.html

echo '  [160/375] post: Primeira chamada de aprovados no SISU já está disp...'
$WP post create --post_type="post" --post_title="Primeira chamada de aprovados no SISU já está disponível para consulta" --post_status="publish" --post_content="$(cat /tmp/wp-post-159.html)" --post_date="2013-01-14T04:16:00.000-08:00" --post_excerpt="Brasília - O resultado do Sistema de Seleção Unificada (Sisu) já pode ser consultado, por enquanto na central de atendimento do Ministério da Educação (MEC), por meio do telefone 0800-616161. Ao longo do dia, a consulta poderá ser feita também na página do programa e nas instituições participantes." --post_category='filosofia'
rm -f /tmp/wp-post-159.html

echo '  [161/375] post: Secretaria de Educação oferece 11 mil vagas gratui...'
$WP post create --post_type="post" --post_title="Secretaria de Educação oferece 11 mil vagas gratuitas para cursos técnicos na Bahia" --post_status="publish" --post_content="$(cat /tmp/wp-post-160.html)" --post_date="2013-01-11T06:21:00.000-08:00" --post_excerpt="Candidato deverá aguardar o sorteio eletrônico que será realizado no dia 05 de fevereiro



Começaram, na quarta-feira (09/01), as inscrições para mais de 11 mil vagas de cursos técnicos para concluintes do nível médio da rede pública estadual. As oportunidades estão sendo oferecidas pela Secretari" --post_category='filosofia'
rm -f /tmp/wp-post-160.html

echo '  [162/375] post: A viagem para meus interiores...'
$WP post create --post_type="post" --post_title="A viagem para meus interiores" --post_status="publish" --post_content="$(cat /tmp/wp-post-161.html)" --post_date="2013-01-10T10:48:00.000-08:00" --post_excerpt="Cachoeira das Sete Voltas - Iguaí - Bahia




Jarbas Matos Santos *

1- Introdução 



O texto abaixo é a transcrição, com alguns acréscimos, da mensagem por mim ministrada na Igreja Batista Salvador Sal e Luz. Tem como objetivo demonstrar aos amados leitores o valor da intimidade com Deus, experi" --post_category='filosofia'
rm -f /tmp/wp-post-161.html

echo '  [163/375] material: SENAD oferece 10 mil vagas na 5ª edição do Curso S...'
$WP post create --post_type="material" --post_title="SENAD oferece 10 mil vagas na 5ª edição do Curso SUPERA" --post_status="publish" --post_content="$(cat /tmp/wp-post-162.html)" --post_date="2013-01-10T06:45:00.000-08:00" --post_excerpt="A Secretaria Nacional de Políticas sobre Drogas (SENAD) abriu em 26/12/2012 as inscrições para 10 mil vagas na 5ª edição do Curso SUPERA - \"Sistema para detecção do Uso abusivo e dependência de substâncias psicoativas: encaminhamento, intervenção breve, reinserção social e acompanhamento\".

O curso"
rm -f /tmp/wp-post-162.html

echo '  [164/375] publicacao: NOTA DE FALECIMENTO...'
$WP post create --post_type="publicacao" --post_title="NOTA DE FALECIMENTO" --post_status="publish" --post_content="$(cat /tmp/wp-post-163.html)" --post_date="2013-01-07T09:46:00.000-08:00" --post_excerpt="Faleceu ontem a pessoa que atrapalhava sua vida...
Um dia, quando os funcionários chegaram para trabalhar, encontraram na portaria um cartaz enorme, no qual estava escrito:\"Faleceu ontem a pessoa que atrapalhava sua vida na Empresa. Você está convidado para o velório na quadra de esportes\".No iní..."
rm -f /tmp/wp-post-163.html

echo '  [165/375] post: LA DEMONIZACIÓN DE CHAVEZ...'
$WP post create --post_type="post" --post_title="LA DEMONIZACIÓN DE CHAVEZ" --post_status="publish" --post_content="$(cat /tmp/wp-post-164.html)" --post_date="2013-01-06T10:58:00.002-08:00" --post_excerpt="por EDUARDO GALEANO[1]







Hugo Chávez
es un demonio. ¿Por qué? Porque
alfabetizó a 2 millones de venezolanos que no sabían leer ni escribir, aunque
vivían en un país que tiene la riqueza natural más importante del mundo, que es
el petróleo. Yo viví en ese país algunos años y conocí muy bien lo" --post_category='filosofia'
rm -f /tmp/wp-post-164.html

echo '  [166/375] publicacao: Centro especializado em Campinas mostra tecnologia...'
$WP post create --post_type="publicacao" --post_title="Centro especializado em Campinas mostra tecnologias para inclusão" --post_status="publish" --post_content="$(cat /tmp/wp-post-165.html)" --post_date="2013-01-05T06:49:00.001-08:00" --post_excerpt="Confira, abaixo, um vídeo com matéria jornalística exibida na EPTV (São Carlos/Araraquara), mostrando recursos tecnológicos utilizados e disseminados pelo recém criado Centro Nacional de Referência em Tecnologia Assistiva, entidade federal que funciona em Campinas desde julho do ano passado, os q"
rm -f /tmp/wp-post-165.html

echo '  [167/375] post: A política e o PT em 2012: uma análise por José Di...'
$WP post create --post_type="post" --post_title="A política e o PT em 2012: uma análise por José Dirceu" --post_status="publish" --post_content="$(cat /tmp/wp-post-166.html)" --post_date="2013-01-04T14:30:00.000-08:00" --post_excerpt="Das eleições municipais à instalação da Comissão Nacional da Verdade, passando por questões de grande relevância como a aprovação da Lei de Cotas Sociais em universidades públicas federais e do Novo Código Florestal, o ano de 2012 foi marcado por uma agenda política extensa, cujas resoluções traze" --post_category='politica'
rm -f /tmp/wp-post-166.html

echo '  [168/375] post: Incêndio [mais que suspeito] no prédio da Secretar...'
$WP post create --post_type="post" --post_title="Incêndio [mais que suspeito] no prédio da Secretaria Municipal da Educação em Salvador" --post_status="publish" --post_content="$(cat /tmp/wp-post-167.html)" --post_date="2013-01-03T20:43:00.000-08:00" --post_excerpt="Envolta em denúncias de contratos fraudulentos a Secretaria de Educação do Município, que se mantém com o mesmo secretário na suposta \"nova gestão\" carlista, agora arde em chamas com um incêndio de causas ainda não esclarecidas. Pelo visto a Velha Política da Bahia - que na verdade já (des)governo" --post_category='politica'
rm -f /tmp/wp-post-167.html

echo '  [169/375] publicacao: Publicada Lei que trata do Plano de Carreiras e Ca...'
$WP post create --post_type="publicacao" --post_title="Publicada Lei que trata do Plano de Carreiras e Cargos do Magistério Federal" --post_status="publish" --post_content="$(cat /tmp/wp-post-168.html)" --post_date="2013-01-02T12:52:00.002-08:00" --post_excerpt="LEI Nº 12.772, DE 28 DE DEZEMBRO DE 2012.








A referida Lei, aprovada pelo Congresso e sancionada pela presidência da República, ao apagar das luzes do ano de 2012, dispõe sobre a estruturação do Plano de Carreiras e Cargos de Magistério Federal; sobre a Carreira do Magistério Superior, de qu"
rm -f /tmp/wp-post-168.html

echo '  [170/375] publicacao: Inscrições para o Sisu 2013 começam no dia 07 de j...'
$WP post create --post_type="publicacao" --post_title="Inscrições para o Sisu 2013 começam no dia 07 de janeiro" --post_status="publish" --post_content="$(cat /tmp/wp-post-169.html)" --post_date="2013-01-02T10:04:00.002-08:00" --post_excerpt="Os estudantes que prestaram o Exame Nacional do Ensino Médio (Enem) podem se inscrever no Sistema de Seleção Unificada (Sisu) a partir do dia 7 de janeiro de 2013. Com o Sisu, o estudante concorre a uma vaga para cursos nas universidades e institutos federais de ensino superior no Brasil, entre el"
rm -f /tmp/wp-post-169.html

echo '  [171/375] post: SISU 2013 - MEC DIVULGA RELAÇÃO DE CURSOS E VAGAS...'
$WP post create --post_type="post" --post_title="SISU 2013 - MEC DIVULGA RELAÇÃO DE CURSOS E VAGAS" --post_status="publish" --post_content="$(cat /tmp/wp-post-170.html)" --post_date="2012-12-27T19:29:00.000-08:00" --post_excerpt="by SISU on 27/12/2012









Após a divulgação do cronograma oficial, no dia 26 de dezembro, foram divulgadas também todas as informações sobre as vagas do Sisu 2013. Os estudantes que participaram do Enem 2012 (Exame Nacional do Ensino Médio) poderão concorrer a 129.279 vagas em 3.751 cursos," --post_category='filosofia'
rm -f /tmp/wp-post-170.html

echo '  [172/375] post: AH, EU QUERO!...'
$WP post create --post_type="post" --post_title="AH, EU QUERO!" --post_status="publish" --post_content="$(cat /tmp/wp-post-171.html)" --post_date="2012-12-23T12:01:00.000-08:00" --post_excerpt="Irenilson Barbosa




Ah, sim! Agora, hoje eu quero assim... 

Quero viver sob os cuidados de um Deus, em quem eu creio sem reservas... Ele que é generoso em perdoar e rico em bondade, a despeito de minhas falhas e defeitos enormes. 

Manter altivo o sorriso, para além das adversidades e das vaida" --post_category='filosofia'
rm -f /tmp/wp-post-171.html

echo '  [173/375] post: NÃO DEIXE O MUNDO ACABAR...'
$WP post create --post_type="post" --post_title="NÃO DEIXE O MUNDO ACABAR" --post_status="publish" --post_content="$(cat /tmp/wp-post-172.html)" --post_date="2012-12-20T11:46:00.000-08:00" --post_excerpt="Irenilson de Jesus Barbosa



Não deixe o mundo
acabar sem me dar um cheiro

Sem um sorriso faceiro,
o que lhe dispa a alma...

Não negue a mão que acalma, o cuidar primeiro,

Pois, sendo o
derradeiro, prefiro a pressa à calma.



Não deixe o mundo
acabar sem dizer que me ama

Sem acender de nov" --post_category='filosofia'
rm -f /tmp/wp-post-172.html

echo '  [174/375] post: (Sem título)...'
$WP post create --post_type="post" --post_title="(Sem título)" --post_status="publish" --post_content="$(cat /tmp/wp-post-173.html)" --post_date="2012-12-19T22:38:00.002-08:00" --post_excerpt="Parece que
 foi ontem que acordei com a novidade

Naquela
 longínqua cidade, além da Serra dos Cristais

A mãe, feliz
 e sem ais, informou com amabilidade:

Chegou o dia,
 na verdade... Nasce hoje! não tarda mais!



E assim
 seguiu, tranquila, sem temor e em alegria" --post_category='filosofia'
rm -f /tmp/wp-post-173.html

echo '  [175/375] publicacao: UFRB se consolida entre as melhores universidades ...'
$WP post create --post_type="publicacao" --post_title="UFRB se consolida entre as melhores universidades do Brasil: IGC 4" --post_status="publish" --post_content="$(cat /tmp/wp-post-174.html)" --post_date="2012-12-10T12:33:00.000-08:00" --post_excerpt="Os indicadores de qualidade da educação superior 2011 divulgados pelo Ministério da Educação na última quinta-feira (06) confirmaram o destaque da Universidade Federal do Recôncavo da Bahia no cenário nacional. A UFRB manteve a nota quatro no Índice Geral de Cursos (IGC), sendo cinco a nota máxi"
rm -f /tmp/wp-post-174.html

echo '  [176/375] post: Reeditando indicações de textos para os Seminários...'
$WP post create --post_type="post" --post_title="Reeditando indicações de textos para os Seminários Temáticos de OEBPP" --post_status="publish" --post_content="$(cat /tmp/wp-post-175.html)" --post_date="2012-11-01T21:26:00.002-07:00" --post_excerpt="Atendendo a pedidos, reedito links com orientações e subsídios para as apresentações das equipes nas aulas do componente curricular Organização da Educação Brasileira e Políticas Públicas (OEBPP) oferecido às  Licenciaturas do CFP/UFRB. Confira os links para textos e documentos sobre níveis e moda" --post_category='educacao'
rm -f /tmp/wp-post-175.html

echo '  [177/375] post: DIA DE FINADOS: Devemos celebrar?...'
$WP post create --post_type="post" --post_title="DIA DE FINADOS: Devemos celebrar?" --post_status="publish" --post_content="$(cat /tmp/wp-post-176.html)" --post_date="2012-11-01T21:04:00.001-07:00" --post_excerpt="Neste dia 2 de novembro, milhões de pessoas sairão de suas casas e irão a missas, cemitérios e jazigos familiares oferecendo flores e acendendo velas em memória de pessoas queridas. Mas será que isso é um costume verdadeiramente cristão? tem base ou origem nas Escrituras Sagradas? Está de acor" --post_category='filosofia'
rm -f /tmp/wp-post-176.html

echo '  [178/375] livro: A real reforma do Estado*...'
$WP post create --post_type="livro" --post_title="A real reforma do Estado*" --post_status="publish" --post_content="$(cat /tmp/wp-post-177.html)" --post_date="2012-10-25T11:20:00.003-07:00" --post_excerpt="Após nove anos, completados no sábado 20, o Bolsa Família tornou-se um programa social aclamado no mundo. A quase totalidade dos preconceitos e mitos que alimentavam a oposição à sua existência foi desmentida pelos fatos. O programa não colocou sob o cabresto de Lula e do PT o voto dos eleit"
rm -f /tmp/wp-post-177.html

echo '  [179/375] livro: Ato na USP apóia Projeto Político do PT: "resposta...'
$WP post create --post_type="livro" --post_title="Ato na USP apóia Projeto Político do PT: \"resposta da civilização à barbárie\"" --post_status="publish" --post_content="$(cat /tmp/wp-post-178.html)" --post_date="2012-10-25T09:17:00.000-07:00" --post_excerpt="Enviar !Imprimir !



São Paulo - O Coletivo de Estudantes em Defesa da Educação Pública promoveu terça-feira, às 17h, na USP, o ato “São Paulo quer Mudança”. O evento contou com professores da instituição que resolveram se colocar no debate das eleições de segundo turno. Maril"
rm -f /tmp/wp-post-178.html

echo '  [180/375] publicacao: Seminários temáticos de OEBPP começam em 22/10 e v...'
$WP post create --post_type="publicacao" --post_title="Seminários temáticos de OEBPP começam em 22/10 e vão até 20/11" --post_status="publish" --post_content="$(cat /tmp/wp-post-179.html)" --post_date="2012-10-22T11:48:00.001-07:00" --post_excerpt="Lembramos aos nossos alunos e alunas queridas que nos próximos dias 22 e 23/10 (conforme a turma) começam os nossos seminários temáticos de OEBPP!



Por esta razão, publico a seguir, mais uma vez (visto que todos já foram anteriormente informados em sala de aula), as datas e respectivos tem"
rm -f /tmp/wp-post-179.html

echo '  [181/375] post: Dilma sanciona lei que transforma Dia da Consciênc...'
$WP post create --post_type="post" --post_title="Dilma sanciona lei que transforma Dia da Consciência Negra em feriado nacional" --post_status="publish" --post_content="$(cat /tmp/wp-post-180.html)" --post_date="2012-10-19T13:35:00.001-07:00" --post_excerpt="Foi assinada, no último dia 10, pela presidenta da República a Lei 12.519, que cria o feriado nacional do Dia da Nacional de Zumbi e da Consciência Negra, que passa a ser comemorado em 20 de novembro.

A data já era adotada por estabelecimentos escolares e instituições públicas e privadas por" --post_category='filosofia'
rm -f /tmp/wp-post-180.html

echo '  [182/375] publicacao: BATISTAS BAIANOS CELEBRAM 130 ANOS COM CONGRESSO D...'
$WP post create --post_type="publicacao" --post_title="BATISTAS BAIANOS CELEBRAM 130 ANOS COM CONGRESSO DE AÇÃO SOCIAL EM SALVADOR" --post_status="publish" --post_content="$(cat /tmp/wp-post-181.html)" --post_date="2012-10-18T12:45:00.000-07:00" --post_excerpt="O evento cujo tema é a TRANSFORMAÇÃO DA COMUNIDADE PELO EVANGELHO INTEGRAL será realizado na Igreja Batista Sião, em Salvador, de 19 a 21 de outubro e marcará comemorações pelos 130 anos das Igrejas Batistas na Bahia e no Brasil. Confira os detalhes, se inscreva e participe dessa festa.



II Congr"
rm -f /tmp/wp-post-181.html

echo '  [183/375] post: Comissão da Câmara aprova meta de investir 10% do ...'
$WP post create --post_type="post" --post_title="Comissão da Câmara aprova meta de investir 10% do PIB na educação" --post_status="publish" --post_content="$(cat /tmp/wp-post-182.html)" --post_date="2012-10-16T21:08:00.000-07:00" --post_excerpt="Plano ainda prevê 50% da renda de tributos do pré-sal para o setor. Proposta segue para o Senado; depois, se não for alterado, vai à sanção.





A Comissão de Constituição e Justiça da Câmara aprovou nesta terça-feira (16) o Plano Nacional de Educação (PNE), que prevê a aplicação, em até 10 anos," --post_category='educacao'
rm -f /tmp/wp-post-182.html

echo '  [184/375] material: UFRB convoca aprovados na 3ª chamada do Cadastro S...'
$WP post create --post_type="material" --post_title="UFRB convoca aprovados na 3ª chamada do Cadastro Seletivo 2012.2" --post_status="publish" --post_content="$(cat /tmp/wp-post-183.html)" --post_date="2012-10-15T17:19:00.001-07:00" --post_excerpt="A Universidade Federal do Recôncavo da Bahia (UFRB) divulgou a relação dos candidatos aprovados na 3ª chamadado Cadastro Seletivo 2012.2. A matrícula dos aprovados será feita no campus de Cruz das Almas, a 146 km de Salvador, no dia 17 de outubro, das 8h às 11h30 e das 13h30 às 16h30, conforme esc"
rm -f /tmp/wp-post-183.html

echo '  [185/375] publicacao: Dilma publica decreto que regulamenta cotas nas un...'
$WP post create --post_type="publicacao" --post_title="Dilma publica decreto que regulamenta cotas nas universidades e escolas técnicas" --post_status="publish" --post_content="$(cat /tmp/wp-post-184.html)" --post_date="2012-10-15T16:59:00.000-07:00" --post_excerpt="Mariana Tokarnia (Repórter da Agência Brasil)



Brasília - Estudantes de baixa renda e os que se declaram pretos, pardos ou indígenas terão prioridade no caso de não preenchimento das vagas reservadas às escolas públicas em instituições de ensino superior e técnico. A determinação é da nova Lei d"
rm -f /tmp/wp-post-184.html

echo '  [186/375] post: Concurso abre inscrição na Bahia: salários podem f...'
$WP post create --post_type="post" --post_title="Concurso abre inscrição na Bahia: salários podem ficar acima de R$ 4 mil" --post_status="publish" --post_content="$(cat /tmp/wp-post-185.html)" --post_date="2012-10-15T15:26:00.002-07:00" --post_excerpt="A Superintendência de Estudos Econômicos e Sociais da Bahia abre inscrições, nesta segunda-feira (15) para concurso de nível superior, com salários de R$ 2.149,13, acrescido de Gratificação da Atividade de Pesquisa Aplicada (GPA) no valor de 100%, chegando à remuneração final de R$ 4.298,26.Serão" --post_category='filosofia'
rm -f /tmp/wp-post-185.html

echo '  [187/375] post: Presidência da CBBA escreve aos pastores e líderes...'
$WP post create --post_type="post" --post_title="Presidência da CBBA escreve aos pastores e líderes batistas da Bahia" --post_status="publish" --post_content="$(cat /tmp/wp-post-186.html)" --post_date="2012-10-13T08:15:00.001-07:00" --post_excerpt="Inicialmente, hesitei em publicar este documento, enviado aos pastores e líderes batistas pela atual diretoria da Convenção Batista Baiana, por entender que é assunto pertinente apenas aos batistas. Mas, como a matéria já se acha divulgada numa rede social e porque entendo também que não temos do q" --post_category='filosofia'
rm -f /tmp/wp-post-186.html

echo '  [188/375] post: DIVULGANDO SELEÇÃO DE INSTRUTORES PARA CURSOS PROF...'
$WP post create --post_type="post" --post_title="DIVULGANDO SELEÇÃO DE INSTRUTORES PARA CURSOS PROFISSIONALIZANTES" --post_status="publish" --post_content="$(cat /tmp/wp-post-187.html)" --post_date="2012-10-13T07:39:00.000-07:00" --post_excerpt="SELEÇÃO DE INSTRUTORES (AS) PARA CURSOS PROFISSIONALIZANTES – BA

Contato para encaminhar currículo ou obter maiores informações: seleção.profissional@yahoo.com.br

Ao encaminhar o currículo, informar no campo ASSUNTO, a área (curso a ministrar) pretendida (o).



Curso: Educação para a cidadania e" --post_category='filosofia'
rm -f /tmp/wp-post-187.html

echo '  [189/375] post: Josi: Um testemunho de fé e superação!...'
$WP post create --post_type="post" --post_title="Josi: Um testemunho de fé e superação!" --post_status="publish" --post_content="$(cat /tmp/wp-post-188.html)" --post_date="2012-10-11T16:44:00.001-07:00" --post_excerpt="\"Quem prepara aos corvos o seu alimento, quando os seus filhotes gritam a Deus e andam vagueando, por não terem o que comer? (Jó 38.41) Considerai os corvos, que nem semeiam, nem segam, nem têm despensa nem celeiro, e Deus os alimenta; quanto mais valeis vós do que as aves?  (Jó 38:41; Lucas 1" --post_category='filosofia'
rm -f /tmp/wp-post-188.html

echo '  [190/375] post: A direita "risonha" com o julgamento do "mensalão"...'
$WP post create --post_type="post" --post_title="A direita \"risonha\" com o julgamento do \"mensalão\" e condenação de ícones do PT" --post_status="publish" --post_content="$(cat /tmp/wp-post-189.html)" --post_date="2012-10-10T13:41:00.001-07:00" --post_excerpt="O foguetório de analistas e profetas omissos, associados a adversários políticos raivosos, desde que esse país ainda era uma ditadura e os condenados eram perseguidos políticos, está no ar. 

Dado está o espetáculo, para a decepção de pessoas incautas, algumas justamente alarmadas e indignadas com" --post_category='politica'
rm -f /tmp/wp-post-189.html

echo '  [191/375] post: Joaquim Barbosa revela que vota no PT e critica pa...'
$WP post create --post_type="post" --post_title="Joaquim Barbosa revela que vota no PT e critica parcialidade da imprensa na cobertura sobre mensalões" --post_status="publish" --post_content="$(cat /tmp/wp-post-190.html)" --post_date="2012-10-10T07:13:00.000-07:00" --post_excerpt="Fonte: Carta Capital




Joaquim Barbosa durante sessão do STF na quarta-feira 3. Na quarta-feira 10 ele deve ser conduzido à presidência do colegiado. Foto: Fabio Rodrigues Pozzebom/ABr


No momento em que está no centro das atenções por ser o relator do chamado “mensalão”, e é alçado à condição..." --post_category='filosofia'
rm -f /tmp/wp-post-190.html

echo '  [192/375] post: Capes aprova Mestrado Profissional em Educação do ...'
$WP post create --post_type="post" --post_title="Capes aprova Mestrado Profissional em Educação do Campo da UFRB" --post_status="publish" --post_content="$(cat /tmp/wp-post-191.html)" --post_date="2012-10-05T16:22:00.003-07:00" --post_excerpt="A Coordenação de Aperfeiçoamento de Pessoal de Nível Superior (Capes) divulgou nesta quarta-feira, 3, os resultados da apreciação de propostas de cursos novos de 2012. Dentre os cursos aprovados está o Mestrado Profissional em Educação do Campo da Universidade Federal do Recôncavo da Bahia (UF" --post_category='educacao'
rm -f /tmp/wp-post-191.html

echo '  [193/375] publicacao: Brasil atinge em 8 anos a meta de redução da pobre...'
$WP post create --post_type="publicacao" --post_title="Brasil atinge em 8 anos a meta de redução da pobreza estabelecida para 25 anos" --post_status="publish" --post_content="$(cat /tmp/wp-post-192.html)" --post_date="2012-10-05T08:13:00.000-07:00" --post_excerpt="Enquanto países europeus anunciam aumento dos impostos e cortes orçamentários que afetam diretamente as conquistas sociais, o Brasil pode comemorar um de seus principais cartões de visita: conseguiu cumprir em oito anos a meta do milênio estipulada pela Organização das Nações Unidas (ONU) de re"
rm -f /tmp/wp-post-192.html

echo '  [194/375] publicacao: UFRB promove II RECONCITEC com mais de 5 mil inscr...'
$WP post create --post_type="publicacao" --post_title="UFRB promove II RECONCITEC com mais de 5 mil inscritos" --post_status="publish" --post_content="$(cat /tmp/wp-post-193.html)" --post_date="2012-10-03T16:48:00.001-07:00" --post_excerpt="A II Reunião Anual de Ciência, Tecnologia, Inovação e Cultura no Recôncavo da Bahia – RECONCITEC, promovida pela Universidade Federal do Recôncavo da Bahia (UFRB), já registra mais de 5 mil inscritos na manhã desta quarta-feira, 3, faltando apenas duas semanas para o evento.




De 17 a 19 de out"
rm -f /tmp/wp-post-193.html

echo '  [195/375] publicacao: SUS e SUAS firmam parceria para acolhimento de pes...'
$WP post create --post_type="publicacao" --post_title="SUS e SUAS firmam parceria para acolhimento de pessoas com deficiência" --post_status="publish" --post_content="$(cat /tmp/wp-post-194.html)" --post_date="2012-10-03T05:25:00.000-07:00" --post_excerpt="Aproximar as ações de assistência social e de saúde, especialmente nos cuidados com jovens e adultos com deficiência. Com esse objetivo, o Sistema Único da Assistência Social (Suas) e o Sistema Único de Saúde (SUS) firmaram parceria para a prestação de serviços de forma conjunta.


Os gestores l"
rm -f /tmp/wp-post-194.html

echo '  [196/375] post: Vitória derrota Goiás e segue líder a 3 vitórias d...'
$WP post create --post_type="post" --post_title="Vitória derrota Goiás e segue líder a 3 vitórias do retorno à Série A" --post_status="publish" --post_content="$(cat /tmp/wp-post-195.html)" --post_date="2012-09-22T17:38:00.000-07:00" --post_excerpt="Fotos






Élton, autor de 2 gols, e demais jogadores do Leão comemoram um dos gols do triunfo no Barradão
Foto: Romildo de Jesus/Agência Lance







Com o Barradão cheio, o Vitória manteve a série invicta de 11 jogos na Série B do Campeonato Brasileiro ao vencer o Goiás por 3 a 1, neste sábado," --post_category='filosofia'
rm -f /tmp/wp-post-195.html

echo '  [197/375] post: Garoto amputado faz golaço em futebol nos EUA...'
$WP post create --post_type="post" --post_title="Garoto amputado faz golaço em futebol nos EUA" --post_status="publish" --post_content="$(cat /tmp/wp-post-196.html)" --post_date="2012-09-22T07:00:00.000-07:00" --post_excerpt="De tempos em tempos, se descobre, inclusive na rotina de alguém com deficiência, o quanto a vida e os humanos são espetaculares e eles viram notícia. Nosso personagem de hoje é um garoto de 17 anos: Nico Calabria é o nome da fera. 

Em uma vitória de sua escola, a Concord-Carlisle, por 9 a 0 sob" --post_category='filosofia'
rm -f /tmp/wp-post-196.html

echo '  [198/375] post: PASTOR LIBERTADO NO IRÃ ESCREVE AOS CRISTÃOS QUE O...'
$WP post create --post_type="post" --post_title="PASTOR LIBERTADO NO IRÃ ESCREVE AOS CRISTÃOS QUE ORARAM POR SUA VIDA" --post_status="publish" --post_content="$(cat /tmp/wp-post-197.html)" --post_date="2012-09-20T15:34:00.002-07:00" --post_excerpt="Depois de uma série de boatos sobre sua morte por enforcamento, ele foi milagrosamente libertado pelas autoridades iranianas, reencontrou-se com sua família e agora agradece as orações dos cristãos em todo o mundo pela sua libertação. Louvemos a Deus por isso!





Flagrante do comovente reencontr" --post_category='filosofia'
rm -f /tmp/wp-post-197.html

echo '  [199/375] post: SETEMBRO AZUL: Amargosa recebe seminário de surdos...'
$WP post create --post_type="post" --post_title="SETEMBRO AZUL: Amargosa recebe seminário de surdos" --post_status="publish" --post_content="$(cat /tmp/wp-post-198.html)" --post_date="2012-09-20T08:54:00.000-07:00" --post_category='filosofia'
rm -f /tmp/wp-post-198.html

echo '  [200/375] publicacao: DOCENTES DA UFRB ENCAMINHAM PROPOSTAS PARA NOVO CA...'
$WP post create --post_type="publicacao" --post_title="DOCENTES DA UFRB ENCAMINHAM PROPOSTAS PARA NOVO CALENDÁRIO" --post_status="publish" --post_content="$(cat /tmp/wp-post-199.html)" --post_date="2012-09-19T18:39:00.001-07:00" --post_excerpt="A Diretoria da Associação dos Professores Universitários do Recôncavo divulgou e encaminhou nota abaixo para apreciação da UFRB, contendo deliberações da Assembléia realizada hoje em Cruz das Almas, sobre o novo calendário acadêmico após o término da greve docente. 

DELIBERAÇÕES DA ASSEMBLEIA GERA"
rm -f /tmp/wp-post-199.html

echo '  [201/375] publicacao: UFBA DIVULGA CALENDÁRIO E SELEÇÃO PARA ALUNO ESPEC...'
$WP post create --post_type="publicacao" --post_title="UFBA DIVULGA CALENDÁRIO E SELEÇÃO PARA ALUNO ESPECIAL 2012.2 - MESTRADO E DOUTORADO" --post_status="publish" --post_content="$(cat /tmp/wp-post-200.html)" --post_date="2012-09-19T08:10:00.000-07:00" --post_excerpt="CALENDÁRIO ACADÊMICO:

INÍCIO -21 DE NOVEMBRO 2012

TÉRMINO-08 DE ABRIL 2013


SELEÇÃO PARA ALUNO(A) ESPECIAL

SEMESTRE 2012.2

CALENDÁRIO DE INSCRIÇÃO: Período: 17/09 a 24/09/2012

Exclusivamente por via postal, com data de envio até 24/09/2012.


DIVULGAÇÃO DO RESULTADO

Dia: 08/10/2012.

Local:"
rm -f /tmp/wp-post-200.html

echo '  [202/375] post: UMA REFLEXÃO QUE LI E ACHEI QUE VALE A PENA VOCÊ L...'
$WP post create --post_type="post" --post_title="UMA REFLEXÃO QUE LI E ACHEI QUE VALE A PENA VOCÊ LER" --post_status="publish" --post_content="$(cat /tmp/wp-post-201.html)" --post_date="2012-09-17T10:19:00.000-07:00" --post_excerpt="ALZHEIMER 
 
Roberto Goldkorn (psicólogo e escritor)


Meu pai está com Alzheimer. Logo ele, que durante toda vida se dizia 'o Infalível'. Logo ele, que um dia, ao tentar me ensinar matemática, disse que as minhas orelhas eram tão grandes que batiam no teto. Logo ele que repetiu, ao longo desses" --post_category='cotidiano'
rm -f /tmp/wp-post-201.html

echo '  [203/375] post: I Seminário de Psicopedagogia & Sociedade em Cruz ...'
$WP post create --post_type="post" --post_title="I Seminário de Psicopedagogia & Sociedade em Cruz das Almas" --post_status="publish" --post_content="$(cat /tmp/wp-post-202.html)" --post_date="2012-09-16T21:31:00.000-07:00" --post_excerpt="O Instituto de Educação Casa do Professor (IECP) realizará, nos dias 27 e 28 de outubro do ano em curso, o Iº “SEMINÁRIO DE PSICOPEDAGOGIA &amp; SOCIEDADE: o processo de aprendizagem como prioridade no século XXI”, cujas atividades acontecerão na Biblioteca Municipal de Cruz das Almas, situada à Ru" --post_category='educacao'
rm -f /tmp/wp-post-202.html

echo '  [204/375] material: Professor Irenilson Barbosa apresenta trabalho aca...'
$WP post create --post_type="material" --post_title="Professor Irenilson Barbosa apresenta trabalho acadêmico no II SEMFEP em Salvador" --post_status="publish" --post_content="$(cat /tmp/wp-post-203.html)" --post_date="2012-09-14T07:04:00.001-07:00" --post_excerpt="Sob o tema LINGUAGEM E FORMAÇÃO DE PROFESSORES-PESQUISADORES: AS VOZES DOS SUJEITOS E SEUS SIGNOS NA PESQUISA EDUCACIONAL, nosso editor, prof. Irenilson de Jesus Barbosa1 apresenta comunicação científica no II SEMFEP - Seminário de Formação de Professores em Exercício - na Faculdade de Educação"
rm -f /tmp/wp-post-203.html

echo '  [205/375] material: PROFESSORES DIVULGAM NOTA SOBRE FIM DA GREVE NA UF...'
$WP post create --post_type="material" --post_title="PROFESSORES DIVULGAM NOTA SOBRE FIM DA GREVE NA UFRB" --post_status="publish" --post_content="$(cat /tmp/wp-post-204.html)" --post_date="2012-09-13T16:12:00.002-07:00"
rm -f /tmp/wp-post-204.html

echo '  [206/375] post: UFRB noticia cursos em destaque no GE, parceria co...'
$WP post create --post_type="post" --post_title="UFRB noticia cursos em destaque no GE, parceria com a ESAF e inscrições em vagas remanescentes" --post_status="publish" --post_content="$(cat /tmp/wp-post-205.html)" --post_date="2012-09-12T22:17:00.000-07:00" --post_excerpt="Cursos da UFRB são avaliados pelo Guia do Estudante

Posted: 12 Sep 2012 11:07 AM PDT




Os cursos de museologia, agronomia, engenharia de pesca, engenharia florestal, zootecnia e nutrição da Universidade Federal do Recôncavo da Bahia foram avaliados na edição do Guia do Estudante e se destacam e" --post_category='educacao'
rm -f /tmp/wp-post-205.html

echo '  [207/375] post: UFRB cria curso de Engenharia da Computação em Cru...'
$WP post create --post_type="post" --post_title="UFRB cria curso de Engenharia da Computação em Cruz das Almas" --post_status="publish" --post_content="$(cat /tmp/wp-post-206.html)" --post_date="2012-09-11T14:22:00.001-07:00" --post_excerpt="A Universidade Federal do Recôncavo da Bahia (UFRB) acaba de criar o curso de Engenharia da Computação, que será oferecido pelo Centro de Ciências Exatas e Tecnológicas (CETEC), no campus de Cruz das Almas. Esta é a mais nova terminalidade em engenharia a ser disponibilizada para os estudantes d" --post_category='educacao'
rm -f /tmp/wp-post-206.html

echo '  [208/375] post: Paraolímpico ou paralímpico?...'
$WP post create --post_type="post" --post_title="Paraolímpico ou paralímpico?" --post_status="publish" --post_content="$(cat /tmp/wp-post-207.html)" --post_date="2012-09-06T13:39:00.000-07:00" --post_excerpt="Muita gente só se deu conta da novidade quando, a certa altura da cerimônia de encerramento dos Jogos de Londres, domingo, foi anunciada a realização dos Jogos Paralímpicos de 2016 no Rio de Janeiro.



Espera aí: “paralímpicos”?! Os jogos não deveriam ser “paraolímpicos”, como sempre foram?" --post_category='filosofia'
rm -f /tmp/wp-post-207.html

echo '  [209/375] post: Daniel Dias ganha mais um ouro e vira o maior bras...'
$WP post create --post_type="post" --post_title="Daniel Dias ganha mais um ouro e vira o maior brasileiro em Paralímpíadas" --post_status="publish" --post_content="$(cat /tmp/wp-post-208.html)" --post_date="2012-09-06T13:20:00.000-07:00" --post_excerpt="Com vitória nos 50m costas em Londres, nadador iguala 13 pódios de Clodoaldo e Ádria, mas se destaca com oito títulos e ainda vai disputar mais três provas




Ao tocar a borda em primeiro lugar nos 50m costas da classe S5, em 34s99, nesta quinta-feira, Daniel Dias fez mais do que quebrar o rec" --post_category='filosofia'
rm -f /tmp/wp-post-208.html

echo '  [210/375] post: Projeto que destina 10% do PIB para educação irá d...'
$WP post create --post_type="post" --post_title="Projeto que destina 10% do PIB para educação irá direto para o Senado" --post_status="publish" --post_content="$(cat /tmp/wp-post-209.html)" --post_date="2012-09-05T07:16:00.002-07:00" --post_excerpt="Acredito que os maiores problemas da educação sejam a gestão dos recursos e sua correta aplicação, impedindo os desvios de finalidade e corrupção já conhecidos, e não apenas do volume de dinheiro disponibilizado. Contudo, não há dúvidas de que quando se tem mais recursos pode-se realizar muito mais" --post_category='educacao'
rm -f /tmp/wp-post-209.html

echo '  [211/375] material: NOVOS CURSOS DA UFRB SÃO RECONHECIDOS PELO MEC...'
$WP post create --post_type="material" --post_title="NOVOS CURSOS DA UFRB SÃO RECONHECIDOS PELO MEC" --post_status="publish" --post_content="$(cat /tmp/wp-post-210.html)" --post_date="2012-09-04T14:22:00.000-07:00" --post_excerpt="Mais cinco cursos de graduação da Universidade Federal do Recôncavo da Bahia (UFRB) obtiveram o reconhecimento pelo Ministério da Educação (MEC). Passam a integrar a lista de cursos ofertados pela instituição que concluíram o primeiro ciclo avaliativo os cursos de Licenciatura em História, Engenha"
rm -f /tmp/wp-post-210.html

echo '  [212/375] material: EM ASSEMBLÉIA, DOCENTES DA UFRB MANTÉM ADESÃO À GR...'
$WP post create --post_type="material" --post_title="EM ASSEMBLÉIA, DOCENTES DA UFRB MANTÉM ADESÃO À GREVE NACIONAL" --post_status="publish" --post_content="$(cat /tmp/wp-post-211.html)" --post_date="2012-09-04T14:14:00.001-07:00"
rm -f /tmp/wp-post-211.html

echo '  [213/375] post: Encontro nacional sobre o ensino de Libras em Salv...'
$WP post create --post_type="post" --post_title="Encontro nacional sobre o ensino de Libras em Salvador: inscrições abertas" --post_status="publish" --post_content="$(cat /tmp/wp-post-212.html)" --post_date="2012-09-04T07:43:00.000-07:00" --post_excerpt="Com o objetivo de debater sobre ensino da língua de sinais no Brasil, o Departamento de Educação (DEDC) do Campus I da UNEB, em Salvador, realiza o VI Encontro Nacional de Estudantes de Letras/Libras (Eneel).

Com o tema Professores e intérpretes de libras em formação: quais mudanças? o eve" --post_category='educacao'
rm -f /tmp/wp-post-212.html

echo '  [214/375] publicacao: ABNT divulga normas de acessibilidade que favorece...'
$WP post create --post_type="publicacao" --post_title="ABNT divulga normas de acessibilidade que favorecem pessoas com deficiência" --post_status="publish" --post_content="$(cat /tmp/wp-post-213.html)" --post_date="2012-09-04T06:03:00.000-07:00" --post_excerpt="MINISTÉRIO PÚBLICO FEDERALTERMO DE AJUSTAMENTO DE CONDUTA

Pelo presente instrumento, com fundamento no artigo 5.º, § 6º, da Lei n.º 7.347/85, de um lado, o MINISTÉRIO PÚBLICO FEDERAL, pela Procuradora da República infra-assinada, doravante denominado COMPROMITENTE, e de outro lado a ASSOCIAÇ"
rm -f /tmp/wp-post-213.html

echo '  [215/375] material: Comando de Greve na UFRB convoca docentes para reu...'
$WP post create --post_type="material" --post_title="Comando de Greve na UFRB convoca docentes para reunião em Cruz das Almas" --post_status="publish" --post_content="$(cat /tmp/wp-post-214.html)" --post_date="2012-08-29T19:01:00.000-07:00"
rm -f /tmp/wp-post-214.html

echo '  [216/375] post: UFRB lança edital de submissão de propostas para V...'
$WP post create --post_type="post" --post_title="UFRB lança edital de submissão de propostas para VI Fórum 20 de Novembro" --post_status="publish" --post_content="$(cat /tmp/wp-post-215.html)" --post_date="2012-08-29T13:56:00.000-07:00" --post_excerpt="A Universidade Federal do Recôncavo da Bahia (UFRB) por meio de sua Pró-Reitoria de Políticas Afirmativas e Assuntos Estudantis (PROPAAE) torna público o Edital de Submissão de Propostas para o VI Fórum 20 de Novembro - Pró-Igualdade Racial e Inclusão Social do Recôncavo. O evento marca o Dia da" --post_category='educacao'
rm -f /tmp/wp-post-215.html

echo '  [217/375] post: Assembléia de 24/08 mantém greve na UFBA por unani...'
$WP post create --post_type="post" --post_title="Assembléia de 24/08 mantém greve na UFBA por unanimidade" --post_status="publish" --post_content="$(cat /tmp/wp-post-216.html)" --post_date="2012-08-25T10:03:00.000-07:00" --post_excerpt="Ao contrário do que tem sido noticiado e até servido de mote para brincadeiras nas redes sociais, mais uma vez reunidos em Assembleia, no dia 24/08/2012, os 151 professores presentes votarampela continuação da greve. Confira o momento da votação no vídeo:




Na Assembleia do dia 24/08/2012, o" --post_category='filosofia'
rm -f /tmp/wp-post-216.html

echo '  [218/375] post: Docentes em greve protocolam contraproposta no MEC...'
$WP post create --post_type="post" --post_title="Docentes em greve protocolam contraproposta no MEC e no Planejamento" --post_status="publish" --post_content="$(cat /tmp/wp-post-217.html)" --post_date="2012-08-23T13:28:00.000-07:00" --post_excerpt="Posted on agosto 23, 2012



Às vésperas de completar 100 dias de paralisação, o Comando Nacional de Greve do ANDES-SN protocolou na manhã desta quinta-feira (23) a contraproposta elaborada pelos docentes e aprovada em suas assembleias. O documento foi entregue nos ministérios da Educação (MEC) e" --post_category='filosofia'
rm -f /tmp/wp-post-217.html

echo '  [219/375] post: COMANDO DE GREVE DA UFRB DIVULGA ANÁLISE DAS PROPO...'
$WP post create --post_type="post" --post_title="COMANDO DE GREVE DA UFRB DIVULGA ANÁLISE DAS PROPOSTAS DO GOVERNO" --post_status="publish" --post_content="$(cat /tmp/wp-post-218.html)" --post_date="2012-08-23T11:14:00.002-07:00" --post_excerpt="Foto da reunião de docentes no \"Café da Manhã da Greve\" na Reitoria da UFRB, em 22/08/2012.



Atendendo à solicitação da Assembleia Permanente de Greve a Associação dos Professores Uiversitários do Recôncavo da Bahia e o Comando de Greve da UFRB disponibiliza para apreciação dos(as) docentes da" --post_category='educacao'
rm -f /tmp/wp-post-218.html

echo '  [220/375] post: UEFS REALIZARÁ II SEMINÁRIO DE ESTÁGIO SUPERVISION...'
$WP post create --post_type="post" --post_title="UEFS REALIZARÁ II SEMINÁRIO DE ESTÁGIO SUPERVISIONADO DAS LICENCIATURAS" --post_status="publish" --post_content="$(cat /tmp/wp-post-219.html)" --post_date="2012-08-23T06:14:00.000-07:00" --post_excerpt="Com o tema FORMAÇÃO DOCENTE, COTIDIANO ESCOLAR E ESTÁGIO CURRICULAR: DESAFIOS E PERSPECTIVAS o evento se realizará no período de 29 de Outubro a 01 de Novembro de 2012, no campus da UEFS em Feira de Santana(BA). Inscrições abertas.

O II Seminário de Estágio Supervisionado dos Cursos de Licenciatu" --post_category='educacao'
rm -f /tmp/wp-post-219.html

echo '  [221/375] material: CAMINHADA APAE - Semana Nacional da Pessoa com Def...'
$WP post create --post_type="material" --post_title="CAMINHADA APAE - Semana Nacional da Pessoa com Deficiência" --post_status="publish" --post_content="$(cat /tmp/wp-post-220.html)" --post_date="2012-08-22T19:51:00.000-07:00"
rm -f /tmp/wp-post-220.html

echo '  [222/375] material: Semana Nacional da Pessoa com Deficiência - Progra...'
$WP post create --post_type="material" --post_title="Semana Nacional da Pessoa com Deficiência - Programação da APAE Salvador" --post_status="publish" --post_content="$(cat /tmp/wp-post-221.html)" --post_date="2012-08-21T13:55:00.000-07:00"
rm -f /tmp/wp-post-221.html

echo '  [223/375] material: APUR CONVOCA DOCENTES PARA CAFÉ DA GREVE NA REITOR...'
$WP post create --post_type="material" --post_title="APUR CONVOCA DOCENTES PARA CAFÉ DA GREVE NA REITORIA DA UFRB" --post_status="publish" --post_content="$(cat /tmp/wp-post-222.html)" --post_date="2012-08-21T12:48:00.000-07:00"
rm -f /tmp/wp-post-222.html

echo '  [224/375] post: FACED/UFBA ADIA SELEÇÃO PARA MESTRADO E DOUTORADO ...'
$WP post create --post_type="post" --post_title="FACED/UFBA ADIA SELEÇÃO PARA MESTRADO E DOUTORADO PARA 2013" --post_status="publish" --post_content="$(cat /tmp/wp-post-223.html)" --post_date="2012-08-21T12:34:00.005-07:00" --post_excerpt="O Programa de Pós-Graduação em Educação da Faculdade de Educação da UFBA (PPGE/FACED) comunica aos interessados em concorrer ao Mestrado e Doutorado em Educação que não haverá seleção este ano para alunos regulares.

 

A seleção será realizada no final do semestre letivo de 2013.1, para ingresso" --post_category='educacao'
rm -f /tmp/wp-post-223.html

echo '  [225/375] post: Muçulmanos paquistaneses querem a morte de criança...'
$WP post create --post_type="post" --post_title="Muçulmanos paquistaneses querem a morte de criança cristã com síndrome de Down" --post_status="publish" --post_content="$(cat /tmp/wp-post-224.html)" --post_date="2012-08-21T06:48:00.000-07:00" --post_excerpt="No Paquistão, mais uma acusação contra um cristão pode terminar em morte, desta vez, Ramsha, uma menina de apenas 11 anos, foi acusada de blasfêmia, por ter rasgado 10 páginas do Alcorão. Segundo as autoridades policiais, a garota, que é analfabeta e teria síndrome de Down, mesmo com muita dificu" --post_category='filosofia'
rm -f /tmp/wp-post-224.html

echo '  [226/375] publicacao: Assembleia de docentes da UFBA vota pela manutençã...'
$WP post create --post_type="publicacao" --post_title="Assembleia de docentes da UFBA vota pela manutenção da greve" --post_status="publish" --post_content="$(cat /tmp/wp-post-225.html)" --post_date="2012-08-21T04:54:00.000-07:00" --post_excerpt="A Assembleia dos docentes da UFBA, realizada no dia 20 de agosto, votou pela manutenção da greve, entendendo que, além de não ter suas reividicações atendidas, quanto às condições de trabalho, a malha salarial proposta pelo governo destoa da que propõe a categoria.

O Comando Local de Greve pu"
rm -f /tmp/wp-post-225.html

echo '  [227/375] livro: Vitória tem a melhor campanha de todos os tempos d...'
$WP post create --post_type="livro" --post_title="Vitória tem a melhor campanha de todos os tempos da Série B" --post_status="publish" --post_content="$(cat /tmp/wp-post-226.html)" --post_date="2012-08-20T11:13:00.003-07:00" --post_excerpt="O Vitória, com 13 triunfos, sete em casa e seis fora, dois empates – um em casa e outro fora -, uma derrota em casa e duas fora, 41 pontos ganhos, tem o melhor aproveitamento de todos os tempos dos times que participaram da Série B do Campeonato Brasileiro desde que passou a ser disputado no sist"
rm -f /tmp/wp-post-226.html

echo '  [228/375] livro: DATAS DE VESTIBULARES E PROCESSOS SELETIVOS PARA U...'
$WP post create --post_type="livro" --post_title="DATAS DE VESTIBULARES E PROCESSOS SELETIVOS PARA UNIVERSIDADES EM TODO O BRASIL" --post_status="publish" --post_content="$(cat /tmp/wp-post-227.html)" --post_date="2012-08-20T08:26:00.001-07:00" --post_excerpt="Confira as datas das inscrições e das provas das principais instituições de ensino superior do País e evite \"sustos\" na véspera dos provões. Tome cuidado porque algumas datas coincidem: faça sua escolha baseado no nosso calendário, e rumo à universidade! http://ow.ly/d3bdO. Na UFRB o processo sel"
rm -f /tmp/wp-post-227.html

echo '  [229/375] post: Estudo afirma que consumo de nozes melhora a quali...'
$WP post create --post_type="post" --post_title="Estudo afirma que consumo de nozes melhora a qualidade do esperma" --post_status="publish" --post_content="$(cat /tmp/wp-post-228.html)" --post_date="2012-08-17T11:27:00.000-07:00" --post_excerpt="DESTAQUES EM CIÊNCIA








UE estuda proposta para retirar marcas dos maços de cigarro
AFP - 5 horas atrás



Cérebro vale mais do que músculos no caratê
AFP - 6 horas atrás





Mais em Ciência »







Washington, 15 ago (EFE).- Comer 75 gramas de nozes por dia melhora a vitalidade, a mobi" --post_category='filosofia'
rm -f /tmp/wp-post-228.html

echo '  [230/375] post: Estudo afirma que consumo de nozes melhora a quali...'
$WP post create --post_type="post" --post_title="Estudo afirma que consumo de nozes melhora a qualidade do esperma" --post_status="publish" --post_content="$(cat /tmp/wp-post-229.html)" --post_date="2012-08-16T19:47:00.001-07:00" --post_excerpt="DESTAQUES EM CIÊNCIA





UE estuda proposta para retirar marcas dos maços de cigarro
AFP - 5 horas atrás



Cérebro vale mais do que músculos no caratê
AFP - 6 horas atrás





Mais em Ciência »







Washington, 15 ago (EFE).- Comer 75 gramas de nozes por dia melhora a vitalidade, a mob" --post_category='filosofia'
rm -f /tmp/wp-post-229.html

echo '  [231/375] material: DOCENTES DA UFRB MANTÊM A GREVE E REIVINDICAM REAB...'
$WP post create --post_type="material" --post_title="DOCENTES DA UFRB MANTÊM A GREVE E REIVINDICAM REABERTURA DAS NEGOCIAÇÕES" --post_status="publish" --post_content="$(cat /tmp/wp-post-230.html)" --post_date="2012-08-16T17:05:00.001-07:00" --post_excerpt="Docentes mantêm a greve e reivindicam reabertura das negociações

Em assembleia dessa quinta-feira (16), os professores da Universidade Federal do Recôncavo da Bahia (UFRB) votaram, por unanimidade, pela manutenção da greve. O principal motivo que levou a essa decisão é a reivindicação de rea"
rm -f /tmp/wp-post-230.html

echo '  [232/375] publicacao: MEC ADMITE ERRO E CORRIGE NOTA DA ESCOLA EM SALVAD...'
$WP post create --post_type="publicacao" --post_title="MEC ADMITE ERRO E CORRIGE NOTA DA ESCOLA EM SALVADOR, APONTADA COMO A DE PIOR IDEB DO PAÍS" --post_status="publish" --post_content="$(cat /tmp/wp-post-231.html)" --post_date="2012-08-16T16:53:00.000-07:00" --post_excerpt="O Ministério da Educação errou ao divulgar a nota de 0,1 como média da Escola Estadual 29 de Março no Índice de Desenvolvimento da Educação Básica (Ideb). Na verdade, a nota real da unidade de ensino baiana é 2,4. Na quarta-feira (15), a Secretaria Estadual da Educação já havia apontado o erro do"
rm -f /tmp/wp-post-231.html

echo '  [233/375] post: Concurso Público da Marinha do Brasil 2012...'
$WP post create --post_type="post" --post_title="Concurso Público da Marinha do Brasil 2012" --post_status="publish" --post_content="$(cat /tmp/wp-post-232.html)" --post_date="2012-08-15T09:07:00.000-07:00" --post_excerpt="As inscrições estarão abertas até o dia 09 de setembro de 2012. Confira as informações básicas e o link para o edital no texto abaixo.






A Diretoria de Ensino da Marinha publicou o edital de abertura doconcurso público 2012, para formação no Corpo Auxiliar de Praças, que tem como objetivo a ad" --post_category='educacao'
rm -f /tmp/wp-post-232.html

echo '  [234/375] post: ALICE VAZ[1]...'
$WP post create --post_type="post" --post_title="ALICE VAZ[1]" --post_status="publish" --post_content="$(cat /tmp/wp-post-233.html)" --post_date="2012-08-15T06:41:00.000-07:00" --post_excerpt="Por Irenilson de Jesus Barbosa








A
flor, a mais linda, dos pais
ufanos,

Louvando os bons feitos de sua filha;

Ilha bem banhada por ternos planos,

Criança adornada em boa mantilha,

Eis, como ela brilha ao passar dos anos!



Vai, mui linda moça, e conquista a vida!

Ainda há muita lida e" --post_category='filosofia'
rm -f /tmp/wp-post-233.html

echo '  [235/375] livro: Escola com pior IDEB do Brasil divide espaço com m...'
$WP post create --post_type="livro" --post_title="Escola com pior IDEB do Brasil divide espaço com mercadinho em Salvador" --post_status="publish" --post_content="$(cat /tmp/wp-post-234.html)" --post_date="2012-08-14T19:01:00.000-07:00" --post_excerpt="Escola Estadual 29 de Março, em Jardim Santo Inácio, recebeu média de 0,1 em análise do MEC. Dados sobre educação básica foram divulgados nesta terça-feira, 14/08/2012.





Não há fachada que identifique prédio da escola sobre estabelecimentos comerciais (Foto: Egi Santana/G1)

Situada n"
rm -f /tmp/wp-post-234.html

echo '  [236/375] post: Governo reabre negociações com servidores federais...'
$WP post create --post_type="post" --post_title="Governo reabre negociações com servidores federais em greve" --post_status="publish" --post_content="$(cat /tmp/wp-post-235.html)" --post_date="2012-08-14T14:19:00.000-07:00" --post_excerpt="Por Geralda Doca (economia.online@oglobo.com.br) | Agência O Globo – 1 hora 59 minutos atrás







Email






Imprimir










DESTAQUES EM ECONOMIA





Wall Street fecha estável
AFP - 7 minutos atrás



Bolsa da Colômbia: IGBC fecha em alta de 0,23%
EFE - 8 minutos atrás





Mais em Econo" --post_category='filosofia'
rm -f /tmp/wp-post-235.html

echo '  [237/375] publicacao: UFRB recebe 55º Congresso Nacional de Estudantes d...'
$WP post create --post_type="publicacao" --post_title="UFRB recebe 55º Congresso Nacional de Estudantes de Agronomia" --post_status="publish" --post_content="$(cat /tmp/wp-post-236.html)" --post_date="2012-08-14T13:49:00.002-07:00" --post_excerpt="A Universidade Federal do Recôncavo da Bahia (UFRB), campus de Cruz das Almas, sedia o 55º Congresso Nacional dos Estudantes de Agronomia, que teve início na noite de ontem (13/08) e vai até a próxima terça-feira (21/08).O CONEA tem como objetivo apontar coletivamente os rumos de atuação da Fed"
rm -f /tmp/wp-post-236.html

echo '  [238/375] post: NASCEU NOSSA MENINA[1]...'
$WP post create --post_type="post" --post_title="NASCEU NOSSA MENINA[1]" --post_status="publish" --post_content="$(cat /tmp/wp-post-237.html)" --post_date="2012-08-13T22:07:00.003-07:00" --post_excerpt="Irenilson de Jesus Barbosa


 

 
 

 
 
 





Já
nasceu nossa menina,

Como
todas, pequenina;

Para
os pais é a mais linda

Para
todos, tão franzina,

Oh,
prazer que não se finda!



Já
nasceu nossa menina,

Nosso
mundo se ilumina,

A
mocinha veio a lume,

É
longa espera que culmina,

Nessa
flor" --post_category='filosofia'
rm -f /tmp/wp-post-237.html

echo '  [239/375] publicacao: JURISTA EXPLICA PORQUE SÓ É DOUTOR QUEM FAZ DOUTOR...'
$WP post create --post_type="publicacao" --post_title="JURISTA EXPLICA PORQUE SÓ É DOUTOR QUEM FAZ DOUTORADO" --post_status="publish" --post_content="$(cat /tmp/wp-post-238.html)" --post_date="2012-08-13T14:23:00.000-07:00" --post_excerpt="Confira abaixo uma discussão esclarecedora sobre o tema e as relações entre as formas de tratamento e a titulação nas diversas carreiras. O texto é do jurista e professor Marco Antônio Ribeiro Tura e foi publicado no Jusbrasil.com.br

\"No momento em que nós do Ministério Público da União nos prep..."
rm -f /tmp/wp-post-238.html

echo '  [240/375] post: UM DIA DE SAUDADE...'
$WP post create --post_type="post" --post_title="UM DIA DE SAUDADE" --post_status="publish" --post_content="$(cat /tmp/wp-post-239.html)" --post_date="2012-08-12T12:21:00.000-07:00" --post_excerpt="Irenilson
de Jesus Barbosa[1]







































O dia
amanheceu com uma saudade doída

De uma
pessoa querida, seus gestos e seu olhar;

O dia
amanheceu faltando um pedaço da vida,

Com sombra
adormecida querendo fazer-se notar.



O dia
se fez tão aquém, trazendo uma falta dan" --post_category='filosofia'
rm -f /tmp/wp-post-239.html

echo '  [241/375] material: EDITAL PARA AGENTES CULTURAIS DA JUVENTUDE NEGRA...'
$WP post create --post_type="material" --post_title="EDITAL PARA AGENTES CULTURAIS DA JUVENTUDE NEGRA" --post_status="publish" --post_content="$(cat /tmp/wp-post-240.html)" --post_date="2012-08-08T09:26:00.000-07:00" --post_excerpt="Para entrar em contato com a Assessoria de Comunicação da Fundação Cultural Palmares, acesse o portal www.palmares.gov.br e clique no \"Fale conosco\"."
rm -f /tmp/wp-post-240.html

echo '  [242/375] post: Assembléia de docentes confirma continuidade da gr...'
$WP post create --post_type="post" --post_title="Assembléia de docentes confirma continuidade da greve na UFBA" --post_status="publish" --post_content="$(cat /tmp/wp-post-241.html)" --post_date="2012-08-08T08:39:00.001-07:00" --post_excerpt="Confira o video que relata momento da votação que consagrou a continuidade da greve 
.
laro que não vou parodiar Afonso Celso escrevendo “Porque me ufano da UFBA” uma vez que a UFBA – como o Brasil do imortal – abriga muitas mazelas com as quais jamais poderia concordar, mas que me orgulho de mui" --post_category='educacao'
rm -f /tmp/wp-post-241.html

echo '  [243/375] publicacao: Senado aprova sistema de cotas para universidades ...'
$WP post create --post_type="publicacao" --post_title="Senado aprova sistema de cotas para universidades brasileiras" --post_status="publish" --post_content="$(cat /tmp/wp-post-242.html)" --post_date="2012-08-08T08:03:00.000-07:00" --post_excerpt="Proposta encerrou tramitação no Congresso e vai para sanção presidencial. Reserva combina critérios de renda, etnia e permanência em escola pública.






Senador Paulo Paim(PT-RS) foi o relator do Projeto 



Os senadores aprovaram em plenário, na noite desta terça-feira (7), o projeto que dest"
rm -f /tmp/wp-post-242.html

echo '  [244/375] post: Pugilista baiana Adriana Araújo conquista medalha ...'
$WP post create --post_type="post" --post_title="Pugilista baiana Adriana Araújo conquista medalha no boxe após 44 anos" --post_status="publish" --post_content="$(cat /tmp/wp-post-243.html)" --post_date="2012-08-08T07:12:00.001-07:00" --post_excerpt="Depois de 44 anos, o Brasil, enfim, conquistou outra medalha olímpica no boxe, e logo na estreia do pugilismo feminino nos Jogos. A peso-leve (60 kg) Adriana Araújo foi superada pela russa Sofya Ochigava nas semifinais terminou a competição com o bronze, já que nesse esporte não há disputa pe" --post_category='filosofia'
rm -f /tmp/wp-post-243.html

echo '  [245/375] post: Como podemos ter paz no vale?...'
$WP post create --post_type="post" --post_title="Como podemos ter paz no vale?" --post_status="publish" --post_content="$(cat /tmp/wp-post-244.html)" --post_date="2012-08-06T08:09:00.003-07:00" --post_excerpt="(Adaptado de Hernandes Dias Lopes - Estudos Novo Tempo) 








Mesmo as postagens mais despretensiosas nas redes sociais nos revelam crenças e até algumas verdades. Os dias em que vivemos são turbulentos e alguns chegam a desesperar, ansiando, ao menos, por alguns momentos de paz. A paz parece" --post_category='filosofia'
rm -f /tmp/wp-post-244.html

echo '  [246/375] post: ANDES-SN INFORMA SOBRE NEGOCIAÇÕES SOBRE A GREVE D...'
$WP post create --post_type="post" --post_title="ANDES-SN INFORMA SOBRE NEGOCIAÇÕES SOBRE A GREVE DOCENTE NAS FEDERAIS" --post_status="publish" --post_content="$(cat /tmp/wp-post-245.html)" --post_date="2012-08-02T21:44:00.002-07:00" --post_excerpt="Leia abaixo a íntegra do comunicado da ANDES-Sindicato Nacional sobre a reunião com o governo federal a respeito da greve docente nas universidades federais brasileiras.



COMUNICADO ESPECIAL - 02/08/2012

INFORME DA REUNIÃO NA SRT/MPOG DO DIA 01 DE AGOSTO DE 2012



Presentes:

CNG/ANDES-SN (Mar" --post_category='educacao'
rm -f /tmp/wp-post-245.html

echo '  [247/375] post: Cientistas anunciam que flores podem curar infecçã...'
$WP post create --post_type="post" --post_title="Cientistas anunciam que flores podem curar infecção hospitalar" --post_status="publish" --post_content="$(cat /tmp/wp-post-246.html)" --post_date="2012-08-02T13:06:00.000-07:00" --post_excerpt="A maria-sem-vergonha não se faz de difícil. Cresce em qualquer lugar úmido. E se espalha, dando flores com generosidade. Esta espécie tão comum e também o copo-de-leite, ambas de origem africana, venceram outros 50 tipos de flores numa pesquisa feita em um laboratório, da Universidade Católi" --post_category='filosofia'
rm -f /tmp/wp-post-246.html

echo '  [248/375] material: DIA MUNDIAL DA AMAMENTAÇÃO INICIA SEMANA DO ALEITA...'
$WP post create --post_type="material" --post_title="DIA MUNDIAL DA AMAMENTAÇÃO INICIA SEMANA DO ALEITAMENTO MATERNO" --post_status="publish" --post_content="$(cat /tmp/wp-post-247.html)" --post_date="2012-08-01T13:17:00.002-07:00" --post_excerpt="Criança busca o olhar da mãe para sentir-se amada e protegida

No dia primeiro de agosto comemora-se o dia mundial da amamentação.

A data foi criada a fim de promover o exercício da amamentação natural, com o objetivo de combater a desnutrição infantil, além de possibilitar a criação de bancos de"
rm -f /tmp/wp-post-247.html

echo '  [249/375] material: APUR PUBLICA NOTAS DE SOLIDARIEDADE À GREVE DOS SE...'
$WP post create --post_type="material" --post_title="APUR PUBLICA NOTAS DE SOLIDARIEDADE À GREVE DOS SERVIDORES FEDERAIS E DE REPÚDIO AO PROIFES" --post_status="publish" --post_content="$(cat /tmp/wp-post-248.html)" --post_date="2012-07-27T12:20:00.000-07:00"
rm -f /tmp/wp-post-248.html

echo '  [250/375] post: Uso de analgésicos pode estar relacionado a câncer...'
$WP post create --post_type="post" --post_title="Uso de analgésicos pode estar relacionado a câncer no rim" --post_status="publish" --post_content="$(cat /tmp/wp-post-249.html)" --post_date="2012-07-25T15:20:00.001-07:00" --post_excerpt="As descobertas sugerem que quanto mais alguém usa esses medicamentos, chamados anti-inflamatórios não esteróides, ou AINEs, maior o risco de adquirir esse tipo de câncer.





Uso de analgésico pode estar ligado a câncer no rim


Pessoas que tomam regularmente medicamentos analgésicos, como o ibup" --post_category='filosofia'
rm -f /tmp/wp-post-249.html

echo '  [251/375] livro: UM CARDEAL SEM PASSADO...'
$WP post create --post_type="livro" --post_title="UM CARDEAL SEM PASSADO" --post_status="publish" --post_content="$(cat /tmp/wp-post-250.html)" --post_date="2012-07-20T09:29:00.000-07:00" --post_excerpt="José Ribamar Bessa Freire

Publicado em 15/07/2012 - Diário do Amazonas

  


O tratamento que a mídia deu à morte do cardeal dom Eugenio Sales, ocorrida na última segunda-feira, com direito à pomba branca no velório, me fez lembrar o filme alemão \"Uma cidade sem passado\", de 1990, dirigid"
rm -f /tmp/wp-post-250.html

echo '  [252/375] material: Ministro da Educação debate com reitores a propost...'
$WP post create --post_type="material" --post_title="Ministro da Educação debate com reitores a proposta para os professores" --post_status="publish" --post_content="$(cat /tmp/wp-post-251.html)" --post_date="2012-07-18T16:40:00.000-07:00" --post_excerpt="Qua, 18 de Julho de 2012 12:00


  





O Ministro da Educação, Aloizio Mercadante, esteve ontem (17) na Associação Nacional dos Dirigentes das Instituições Federais de Ensino Superior (Andifes) para apresentar argumentos técnicos e políticos da proposta de carreira ofertada aos professores das u"
rm -f /tmp/wp-post-251.html

echo '  [253/375] post: Hoje é Dia Internacional Nelson Mandela...'
$WP post create --post_type="post" --post_title="Hoje é Dia Internacional Nelson Mandela" --post_status="publish" --post_content="$(cat /tmp/wp-post-252.html)" --post_date="2012-07-18T07:58:00.000-07:00" --post_excerpt="O Mandela Day é reconhecido desde 2009 pela ONU como um chamado mundial a consagrar 67 minutos de nosso tempo a ajudar os semelhantes como homenagem aos valores defendidos pelo primeiro presidente negro de seu país. Estes 67 minutos correspondem aos 67 anos que Mandela consagrou ao combate polític" --post_category='politica'
rm -f /tmp/wp-post-252.html

echo '  [254/375] publicacao: GREVE NAS FEDERAIS: APUR publica nota sobre propos...'
$WP post create --post_type="publicacao" --post_title="GREVE NAS FEDERAIS: APUR publica nota sobre proposta do Governo aos docentes" --post_status="publish" --post_content="$(cat /tmp/wp-post-253.html)" --post_date="2012-07-16T09:32:00.000-07:00" --post_excerpt="NOTA PÚBLICA

O governo federal novamente desrespeita a categoria docente na mesa de negociações. Desta vez, decidiu divulgar, através da mídia, pontos da sua proposta, antes mesmo de terminar a reunião de negociação com as representações sindicais. Inclusive, a ministra Miriam Belchior se manifes"
rm -f /tmp/wp-post-253.html

echo '  [255/375] post: Vitória é Campeão da Copa 2 de Julho...'
$WP post create --post_type="post" --post_title="Vitória é Campeão da Copa 2 de Julho" --post_status="publish" --post_content="$(cat /tmp/wp-post-254.html)" --post_date="2012-07-13T17:25:00.000-07:00" --post_excerpt="Invicto, Vitória goleia Cruzeiro (MG) e sagra-se campeão: 5x2! 



Quinta, 12 de Julho de 2012, 22:44 h
Share on orkutShare on twitterShare on facebookShare on emailMore Sharing Ser








O volante Welisson foi eleito o melhor jogador

O Vitória goleou o Cruzeiro (MG), por 5 a 2, nesta quinta-f" --post_category='filosofia'
rm -f /tmp/wp-post-254.html

echo '  [256/375] post: CRISTÃOS BATISTAS ORAM POR POVOS MUÇULMANOS NO MÊS...'
$WP post create --post_type="post" --post_title="CRISTÃOS BATISTAS ORAM POR POVOS MUÇULMANOS NO MÊS DO RAMADÃ" --post_status="publish" --post_content="$(cat /tmp/wp-post-255.html)" --post_date="2012-07-11T15:55:00.000-07:00" --post_category='filosofia'
rm -f /tmp/wp-post-255.html

echo '  [257/375] post: VITÓRIA MOSTRA GARRA E VENCE PARANÁ DE VIRADA: 4X3...'
$WP post create --post_type="post" --post_title="VITÓRIA MOSTRA GARRA E VENCE PARANÁ DE VIRADA: 4X3" --post_status="publish" --post_content="$(cat /tmp/wp-post-256.html)" --post_date="2012-07-10T22:27:00.000-07:00" --post_excerpt="Usando camisa com três listras brancas no lugar das vermelhas em função de campanha por doação de sangue, o Vitória mostrou nesta terça-feira, em jogo válido pela 10ª rodada da Série B do Campeonato Brasileiro, que está com veias e artérias bem cheias. Na base da disposição, o time baiano" --post_category='cultura'
rm -f /tmp/wp-post-256.html

echo '  [258/375] post: Divulgando vagas de empregos e estágios...'
$WP post create --post_type="post" --post_title="Divulgando vagas de empregos e estágios" --post_status="publish" --post_content="$(cat /tmp/wp-post-257.html)" --post_date="2012-07-06T16:09:00.000-07:00" --post_excerpt="Como regularmente fazemos, divulgamos abaixo algumas oportunidades de estágios e emprego em Salvador para nossos leitores e demais interessados. Confiram as vagas e as instruções e aproveitem!



CANDIDATOS
DEVEM COMPARECER AO ESCRITÓRIO NA AV. TANCREDO NEVES, 1222, ED CATABAS
TOWER, S/103 (AO LADO" --post_category='filosofia'
rm -f /tmp/wp-post-257.html

echo '  [259/375] post: 50 DIAS DE GREVE DOCENTE NAS FEDERAIS - Governo di...'
$WP post create --post_type="post" --post_title="50 DIAS DE GREVE DOCENTE NAS FEDERAIS - Governo diz que \"falta agenda\" pra negociar" --post_status="publish" --post_content="$(cat /tmp/wp-post-258.html)" --post_date="2012-07-06T14:51:00.001-07:00" --post_excerpt="A greve nacional dos professores de universidades federais completa 50 dias neste sábado (07/07) e pode não acabar antes de 31 de julho. Segundo o Ministério do Planejamento, uma nova reunião com os representantes dos docentes ainda não foi marcada por “falta de agenda” e não deve acontecer ante" --post_category='educacao'
rm -f /tmp/wp-post-258.html

echo '  [260/375] post: VITÓRIA DÁ SHOW DE BOLA E SOLIDARIEDADE EM UNIFORM...'
$WP post create --post_type="post" --post_title="VITÓRIA DÁ SHOW DE BOLA E SOLIDARIEDADE EM UNIFORME" --post_status="publish" --post_content="$(cat /tmp/wp-post-259.html)" --post_date="2012-07-03T12:26:00.003-07:00" --post_excerpt="Neste último final de semana (30/06) o Vitória deu um show de solidariedade. Além de ganhar dentro de casa do Avai por 2x0 e se manter no G4 (grupo dos que se classificam para a série A no ano seguinte) pela série B, o rubro-negro baiano entrou em campo com uma camisa nada convencional. Não, não" --post_category='filosofia'
rm -f /tmp/wp-post-259.html

echo '  [261/375] publicacao: FORPROF/UNEB REALIZAM II SIMPÓSIO BAIANO DAS LICEN...'
$WP post create --post_type="publicacao" --post_title="FORPROF/UNEB REALIZAM II SIMPÓSIO BAIANO DAS LICENCIATURAS EM SALVADOR" --post_status="publish" --post_content="$(cat /tmp/wp-post-260.html)" --post_date="2012-07-03T11:46:00.001-07:00" --post_excerpt="A Universidade do Estado da Bahia assumiu a responsabilidade de organização do II Simpósio Baiano de Licenciaturas em 2012, nos dias 05 e 06 de julho, nas dependências do IAT (Instituto Anísio Teixeira), articulando com as demais IES Públicas que compõem o FORPROF (Fórum Permanente de Apoi"
rm -f /tmp/wp-post-260.html

echo '  [262/375] material: UFRB: ADIADA ASSEMBLÉIA DOCENTE DE AMANHÃ (20/06) ...'
$WP post create --post_type="material" --post_title="UFRB: ADIADA ASSEMBLÉIA DOCENTE DE AMANHÃ (20/06) EM CRUZ DAS ALMAS" --post_status="publish" --post_content="$(cat /tmp/wp-post-261.html)" --post_date="2012-06-19T09:31:00.000-07:00" --post_excerpt="Em mensagem enviada aos docentes, a APUR comunicou há pouco a suspensão da assembleia docente de amanhã, dia 20, em Cruz das Almas. O motivo, como pode ser conferido na mensagem do ANDES reproduzida abaixo, foi o adiamento, por parte do governo, da mesa de negociação. Segundo o informe, mais uma ..."
rm -f /tmp/wp-post-261.html

echo '  [263/375] post: UFRB: Conselho Universitário Apóia Greve dos Servi...'
$WP post create --post_type="post" --post_title="UFRB: Conselho Universitário Apóia Greve dos Servidores nas IFES" --post_status="publish" --post_content="$(cat /tmp/wp-post-262.html)" --post_date="2012-06-19T09:10:00.002-07:00" --post_excerpt="MOÇÃO DE APOIO ÀS REIVINDICAÇÕES DAS GREVES NACIONAIS D@S SERVIDORES DOCENTES E SERVIDORES TÉCNICOS ADMINISTRATIVOS





O Conselho Universitário da Universidade Federal do Recôncavo da Bahia em reunião extraordinária realizada no dia 15 de junho de 2012 no campus de Cruz das Almas reconhece a leg" --post_category='educacao'
rm -f /tmp/wp-post-262.html

echo '  [264/375] material: Justiça decide que áudios de operação que prendeu ...'
$WP post create --post_type="material" --post_title="Justiça decide que áudios de operação que prendeu Cachoeira são legais" --post_status="publish" --post_content="$(cat /tmp/wp-post-263.html)" --post_date="2012-06-18T15:01:00.000-07:00" --post_excerpt="PUBLICIDADE






FELIPE SELIGMANDE BRASÍLIA

Por dois votos a um, o Tribunal Regional Federal da 1ª Região decidiu nesta segunda-feira (18) que as gravações telefônicas da Operação Monte Carlo são legais. Os dois votos a favor foram anunciados hoje e contrariam posição do relator, Tourinho Neto,"
rm -f /tmp/wp-post-263.html

echo '  [265/375] post: GREVE: Governo cancela reunião com sindicato dos p...'
$WP post create --post_type="post" --post_title="GREVE: Governo cancela reunião com sindicato dos professores em Brasília" --post_status="publish" --post_content="$(cat /tmp/wp-post-264.html)" --post_date="2012-06-18T14:29:00.002-07:00" --post_excerpt="18/06/2012 - 17h52




Luciene Cruz

Repórter da Agência Brasil




Brasília – O governo federal cancelou a reunião de amanhã (19/06) com os sindicatos dos professores universitários para discutir a greve que começou no dia 17 de maio e atinge 55 instituições públicas de ensino superior no país. P" --post_category='educacao'
rm -f /tmp/wp-post-264.html

echo '  [266/375] publicacao: Greve dos professores federais completa um mês sem...'
$WP post create --post_type="publicacao" --post_title="Greve dos professores federais completa um mês sem previsão de término" --post_status="publish" --post_content="$(cat /tmp/wp-post-265.html)" --post_date="2012-06-18T13:35:00.000-07:00" --post_excerpt="A greve dos professores de universidades federais completou um mês neste domingo (17/06). No total, pelo menos 54 instituições são afetadas pela paralisação, sendo 49 universidades federais e cinco institutos.

A principal reivindicação dos docentes é a revisão do plano de carreira. Em acordo"
rm -f /tmp/wp-post-265.html

echo '  [267/375] publicacao: ENEM 2012 tem mais de 6,4 milhões de inscritos...'
$WP post create --post_type="publicacao" --post_title="ENEM 2012 tem mais de 6,4 milhões de inscritos" --post_status="publish" --post_content="$(cat /tmp/wp-post-266.html)" --post_date="2012-06-16T12:55:00.000-07:00" --post_excerpt="Em 2011 os inscritos correram também para chegar antes do fechamento dos portões em local de prova em São Paulo.



O número de inscritos para o Exame Nacional do Ensino Médio (Enem) de 2012 chegou a 6.497.466. Segundo balanço publicado no site do Ministério da Educação, foram registradas 27"
rm -f /tmp/wp-post-266.html

echo '  [268/375] publicacao: Servidores da Ufba e da UFRB iniciam greve por tem...'
$WP post create --post_type="publicacao" --post_title="Servidores da Ufba e da UFRB iniciam greve por tempo indeterminado" --post_status="publish" --post_content="$(cat /tmp/wp-post-267.html)" --post_date="2012-06-15T09:42:00.000-07:00" --post_excerpt="A paralisação foi aprovada em assembleia na última segunda (11/06), mas os servidores tiveram que aguardar o prazo legal de 72 horas para iniciar a greve a PARTIR DE HOJE!





Em assembleia realizada na manhã desta sexta-feira (15/06) na Reitoria da Universidade Federal da Bahia (Ufba), os servi"
rm -f /tmp/wp-post-267.html

echo '  [269/375] post: Prazo de inscrições para o ENEM 2012 termina nesta...'
$WP post create --post_type="post" --post_title="Prazo de inscrições para o ENEM 2012 termina nesta sexta-feira, 15/06" --post_status="publish" --post_content="$(cat /tmp/wp-post-268.html)" --post_date="2012-06-15T09:27:00.000-07:00" --post_excerpt="Saiba como fazer o registro para a avaliação federal



Prova do Enem será realizada nos dias 3 e 4 de novembro (Divulgação/Abr)



As inscrições para o Exame Nacional do Ensino Médio (Enem) terminam às 23h59 desta sexta-feira e devem ser realizadas exclusivamente pela internet. A taxa de inscriç" --post_category='filosofia'
rm -f /tmp/wp-post-268.html

echo '  [270/375] publicacao: Docentes da UFBA votam pela continuidade da greve...'
$WP post create --post_type="publicacao" --post_title="Docentes da UFBA votam pela continuidade da greve" --post_status="publish" --post_content="$(cat /tmp/wp-post-269.html)" --post_date="2012-06-14T07:22:00.003-07:00" --post_excerpt="Segundo nota do Comando de Greve (transcrita abaixo), os professores se reuniram em Assembléia no dia 13/06/2012 e decidiram pela continuidade da greve docente na UFBA.
.

Nota do Comando Local de Greve


Nesta quarta, 13/06/2012, às 15h30, 283 professores da UFBA reuniram-se em assembleia e reaf"
rm -f /tmp/wp-post-269.html

echo '  [271/375] post: A DESPEDIDA DO TREMA...'
$WP post create --post_type="post" --post_title="A DESPEDIDA DO TREMA" --post_status="publish" --post_content="$(cat /tmp/wp-post-270.html)" --post_date="2012-06-13T21:22:00.001-07:00" --post_excerpt="Confira que texto legal! muito interessante.

A verdadeiro autoria não sabemos, mas quem assina é um velho conhecido nosso...


Muita criatividade e bom humor, com acentuada inteligência. 


Logo, uma agradável leitura... 







Estou indo embora. Não há mais lugar para mim. Eu sou o trema. Você" --post_category='filosofia'
rm -f /tmp/wp-post-270.html

echo '  [272/375] post: HOMENAGEM À MISSIONÁRIA DOS BATISTAS BRASILEIROS, ...'
$WP post create --post_type="post" --post_title="HOMENAGEM À MISSIONÁRIA DOS BATISTAS BRASILEIROS, FALECIDA NESTE DIA 13/06/2012" --post_status="publish" --post_content="$(cat /tmp/wp-post-271.html)" --post_date="2012-06-13T21:08:00.000-07:00" --post_category='cultura'
rm -f /tmp/wp-post-271.html

echo '  [273/375] publicacao: Concursos para Professores no IF Baiano...'
$WP post create --post_type="publicacao" --post_title="Concursos para Professores no IF Baiano" --post_status="publish" --post_content="$(cat /tmp/wp-post-272.html)" --post_date="2012-06-13T17:46:00.001-07:00" --post_excerpt="Está aberto processo seletivo simplificado para professor substituto na área de Geografia com ênfase em Cartografia e Geoprocessamento (01 vaga) e de professor temporário, nas áreas de Ciências Biológicas (01 vaga), Física (01 vaga), Geografia (02 vagas), Língua Portuguesa (01 vaga), Inglês (01"
rm -f /tmp/wp-post-272.html

echo '  [274/375] post: GREVE NAS FEDERAIS: Governo se compromete a aprese...'
$WP post create --post_type="post" --post_title="GREVE NAS FEDERAIS: Governo se compromete a apresentar esboço de proposta na próxima terça (19/06)" --post_status="publish" --post_content="$(cat /tmp/wp-post-273.html)" --post_date="2012-06-13T17:22:00.000-07:00" --post_excerpt="Depois de recuar na proposta de condicionar o avanço das negociações a uma trégua do movimento grevista, representantes do governo, em reunião realizada nesta terça-feira (12/06) com as entidades do setor de educação, mudaram de posição e passaram a aceitar a antecipação do prazo para o fechame" --post_category='filosofia'
rm -f /tmp/wp-post-273.html

echo '  [275/375] post: A greve, o feijão e o sonho......'
$WP post create --post_type="post" --post_title="A greve, o feijão e o sonho..." --post_status="publish" --post_content="$(cat /tmp/wp-post-274.html)" --post_date="2012-06-13T08:26:00.000-07:00" --post_excerpt="por Aloízio Mercadante de Oliva






Aqui uma reportagem antiga, onde o atual Ministro da Educação explica o porquê da greve na época... Como o ponto de vista se alterou....







Postado por Renato Sfolia às 12:35
Enviar por e" --post_category='filosofia'
rm -f /tmp/wp-post-274.html

echo '  [276/375] material: ASSUFBA entrega ao reitor da UFRB o ofício de defl...'
$WP post create --post_type="material" --post_title="ASSUFBA entrega ao reitor da UFRB o ofício de deflagração de greve" --post_status="publish" --post_content="$(cat /tmp/wp-post-275.html)" --post_date="2012-06-12T13:52:00.000-07:00" --post_excerpt="O Sindicato dos Trabalhadores Técnico-Administrativos da UFBA e da UFRB (ASSUFBA) comunicou oficialmente ao reitor Paulo Gabriel Soledade Nacif a deflagração de greve da categoria a partir do dia 11 de junho, com paralisação das atividades a partir do dia 14 de junho.Confira o Ofício Nº 06/2012 -"
rm -f /tmp/wp-post-275.html

echo '  [277/375] post: O PROFESSOR ESTÁ NU!*...'
$WP post create --post_type="post" --post_title="O PROFESSOR ESTÁ NU!*" --post_status="publish" --post_content="$(cat /tmp/wp-post-276.html)" --post_date="2012-06-12T08:34:00.000-07:00" --post_excerpt="Irenilson de Jesus Barbosa




Foto: Spencer Tunick, no Mar Morto (Israel)





Ouvi dizer que, ainda ontem,
um professor ficou nu

Me digam! Me falem! Me
contem: será que ele surtou?

Teria perdido o cursor? Tão
longe dos mares do sul...
Que fato ou dado impreciso sua nudez desenhou?



Cresci ou" --post_category='filosofia'
rm -f /tmp/wp-post-276.html

echo '  [278/375] livro: Professora do CFP lança livro " A medida do tempo ...'
$WP post create --post_type="livro" --post_title="Professora do CFP lança livro \" A medida do tempo : Intuição e inteligência em Bergson\"" --post_status="publish" --post_content="$(cat /tmp/wp-post-277.html)" --post_date="2012-06-12T06:02:00.000-07:00" --post_excerpt="Divulgando o que promove a nossa Universidade e reconhece o valor e a produção científica de nossos docentes: Parabéns, prof. Geovana!


No próximo dia 15 de junho, às 11 horas, na Sala da Congregação da FFCH-UFBA, 

em São Lázaro, será lançado o livro A medida do tempo: Intuição e inteligência 
..."
rm -f /tmp/wp-post-277.html

echo '  [279/375] publicacao: PROGRAMA JOVEM APRENDIZ: Inscrições para vagas em ...'
$WP post create --post_type="publicacao" --post_title="PROGRAMA JOVEM APRENDIZ: Inscrições para vagas em Salvador" --post_status="publish" --post_content="$(cat /tmp/wp-post-278.html)" --post_date="2012-06-12T05:46:00.001-07:00" --post_excerpt="O ISBET, Instituto Brasileiro Pró Educação Trabalho e Desenvolvimento, está selecionando Jovens para diversas vagas para o Programa Jovem Aprendiz. Confira abaixo o perfil esperado dos candidatos, os requisitos e as características das 1000 (mil) vagas disponibilizadas:
IDADE: 18 e 21 anosESCOLAR..."
rm -f /tmp/wp-post-278.html

echo '  [280/375] post: Relatório do Plano Nacional de Educação mantém ape...'
$WP post create --post_type="post" --post_title="Relatório do Plano Nacional de Educação mantém apenas 7,5% do PIB para educação" --post_status="publish" --post_content="$(cat /tmp/wp-post-279.html)" --post_date="2012-06-06T13:50:00.000-07:00" --post_excerpt="Plano define diretrizes para a educação na próxima década e investimentos de 7,5% do PIB em vez de 10% como queriam os educadores.



Relatório do Plano Nacional mantém 7,5% do PIB para educação


O relator do Plano Nacional de Educação (PNE) deputado Angelo Vanhoni (PT-PR) manteve sua proposta de" --post_category='filosofia'
rm -f /tmp/wp-post-279.html

echo '  [281/375] publicacao: UFRB ANUNCIA CURSO DE MEDICINA: MEC aprova 60 vaga...'
$WP post create --post_type="publicacao" --post_title="UFRB ANUNCIA CURSO DE MEDICINA: MEC aprova 60 vagas" --post_status="publish" --post_content="$(cat /tmp/wp-post-280.html)" --post_date="2012-06-06T13:39:00.001-07:00" --post_excerpt="Posted: 06 Jun 2012 11:21 AM PDT


O Ministério da Educação aprovou a criação de 60 vagas que serão destinadas ao novo curso de medicina da Universidade Federal do Recôncavo da Bahia (UFRB). O anúncio foi feito na tarde desta terça-feira, dia 5 de maio, pelo ministro Aloizio Mercadante durante a"
rm -f /tmp/wp-post-280.html

echo '  [282/375] publicacao: Utilidade PÚblica: OPORTUNIDADE DE EMPREGO PARA MO...'
$WP post create --post_type="publicacao" --post_title="Utilidade PÚblica: OPORTUNIDADE DE EMPREGO PARA MOTORISTAS" --post_status="publish" --post_content="$(cat /tmp/wp-post-281.html)" --post_date="2012-06-06T13:16:00.002-07:00" --post_excerpt="Estão abertas até a próxima quinta-feira (07/06) as inscrições para seleção de motoristas da Secretaria da Saúde do Estado da Bahia (Sesab). Serão escolhidos 50 candidatos para contratação pelo prazo determinado de dois anos, com possibilidade de renovação por igual período, uma única vez. 

O pro"
rm -f /tmp/wp-post-281.html

echo '  [283/375] post: Confirmado curso de Medicina na UFRB em 2013...'
$WP post create --post_type="post" --post_title="Confirmado curso de Medicina na UFRB em 2013" --post_status="publish" --post_content="$(cat /tmp/wp-post-282.html)" --post_date="2012-06-06T13:00:00.000-07:00" --post_excerpt="Notícia foi publicada nesta terça no site do MEC; veja o quadro com as vagas disponíveis





As universidades públicas federais e instituições particulares de educação superior vão oferecer mais 2.415 vagas em cursos de Medicina a partir do segundo semestre deste ano. 

A expansão autorizada pel" --post_category='educacao'
rm -f /tmp/wp-post-282.html

echo '  [284/375] livro: Manobra previsível: Sobe o valor da passagem de ôn...'
$WP post create --post_type="livro" --post_title="Manobra previsível: Sobe o valor da passagem de ônibus em Salvador" --post_status="publish" --post_content="$(cat /tmp/wp-post-283.html)" --post_date="2012-06-01T17:25:00.000-07:00" --post_excerpt="O valor da passagem de ônibus de Salvador passa a custar R$ 2,80 a partir de segunda-feira (04/06). O anúncio foi feito na tarde desta sexta-feira (1) pelo secretário municipal de Transporte e Infraestrutura, José Mattos, na sede do órgão, no bairro da Federação. Segundo o secret"
rm -f /tmp/wp-post-283.html

echo '  [285/375] post: Ministro defende inclusão de alunos com deficiênci...'
$WP post create --post_type="post" --post_title="Ministro defende inclusão de alunos com deficiência em classes regulares" --post_status="publish" --post_content="$(cat /tmp/wp-post-284.html)" --post_date="2012-06-01T06:28:00.000-07:00" --post_excerpt="Quinta-feira, 31 de maio de 2012 - 19:27

Em entrevista coletiva concedida nesta quinta-feira, 31, o ministro da Educação, Aloizio Mercadante, defendeu a política de estímulo à educação especial em classes regulares. \"O Brasil tem que ter 100% das crianças e jovens com deficiência na escola. A esc" --post_category='educacao'
rm -f /tmp/wp-post-284.html

echo '  [286/375] post: Professores da Ufba decretam greve em assembleia e...'
$WP post create --post_type="post" --post_title="Professores da Ufba decretam greve em assembleia e aderem ao movimento docente nacional" --post_status="publish" --post_content="$(cat /tmp/wp-post-285.html)" --post_date="2012-05-29T22:56:00.002-07:00" --post_excerpt="Henrique Mendes






Raul Spinassé | Ag. ATARDE



Segundo a Apub, a aprovação da greve ainda passará por plebiscito, por questão regimental





Acompanhando o movimento organizado pelo Sindicato Nacional dos Docentes das Instituições de Ensino Superior (Andes), os professores da Universidade" --post_category='educacao'
rm -f /tmp/wp-post-285.html

echo '  [287/375] post: Profissão: desencanto!...'
$WP post create --post_type="post" --post_title="Profissão: desencanto!" --post_status="publish" --post_content="$(cat /tmp/wp-post-286.html)" --post_date="2012-05-29T11:29:00.000-07:00" --post_excerpt="Ricardo Henrique Andrade

Professor de Filosofia da UFRB – Amargosa

Email: reseandrade@gmail.com

 

 Se a profissão do brasileiro é a esperança, a do professor deve ser o desencanto. No início do seu governo, em 2007, Wagner enfrentou uma greve de professores com a força do otimismo das urnas. A" --post_category='educacao'
rm -f /tmp/wp-post-286.html

echo '  [288/375] post: SETPS ensaia o golpe do reajuste de tarifas de ôni...'
$WP post create --post_type="post" --post_title="SETPS ensaia o golpe do reajuste de tarifas de ônibus em Salvador" --post_status="publish" --post_content="$(cat /tmp/wp-post-287.html)" --post_date="2012-05-28T18:14:00.000-07:00" --post_excerpt="por Mariana Mendes - Ag. A TARDE






Eduardo Martins | Ag. A TARDE



Setps diz que custo com passageiro passará para R$ 3,15





O Sindicato das Empresas de Transportes de Passageiros de Salvador (Setps) não quer ter prejuízo com o reajuste salarial e benefícios concedidos aos rodoviários pel" --post_category='filosofia'
rm -f /tmp/wp-post-287.html

echo '  [289/375] post: Rodoviários acatam decisão do TRT e voltam ao trab...'
$WP post create --post_type="post" --post_title="Rodoviários acatam decisão do TRT e voltam ao trabalho" --post_status="publish" --post_content="$(cat /tmp/wp-post-288.html)" --post_date="2012-05-26T20:45:00.000-07:00" --post_excerpt="Fonte: Eduardo Martins | Ag. A TARDE






Durante os 4 dias de greve, população teve que recorrer ao transporte complementar e clandestino





Os rodoviários decidiram terminar a greve da categoria, iniciada na última quarta-feira, dia 23, neste sábado, 26. O movimento, que durou quase quatro d" --post_category='filosofia'
rm -f /tmp/wp-post-288.html

echo '  [290/375] publicacao: Dilma faz 12 vetos e 32 modificações no Código Flo...'
$WP post create --post_type="publicacao" --post_title="Dilma faz 12 vetos e 32 modificações no Código Florestal" --post_status="publish" --post_content="$(cat /tmp/wp-post-289.html)" --post_date="2012-05-25T20:02:00.002-07:00" --post_excerpt="Ambientalistas realizam manifestação pedindo o veto presidencial ao novo Código Florestal, em frente ao Palácio …
A presidente Dilma Rousseff vetou 12 artigos do projeto de lei do Código Florestal aprovado no final de abril pela Câmara dos Deputados. A presidente realizou também 32 modificações"
rm -f /tmp/wp-post-289.html

echo '  [291/375] post: MIL VAGAS PARA JOVEM APRENDIZ...'
$WP post create --post_type="post" --post_title="MIL VAGAS PARA JOVEM APRENDIZ" --post_status="publish" --post_content="$(cat /tmp/wp-post-290.html)" --post_date="2012-05-25T07:33:00.002-07:00" --post_excerpt="Isso mesmo: MIL VAGAS! E as inscrições são para Salvador.




O ISBET, Instituto Brasileiro Pró Educação Trabalho e Desenvolvimento, está selecionando Jovens para diversas vagas para o Programa Jovem Aprendiz, para tanto se você conhece alguém que possua o perfil abaixo, gentileza repassar essa i..." --post_category='educacao'
rm -f /tmp/wp-post-290.html

echo '  [292/375] post: Governo prorroga vacinação contra a gripe até 1º d...'
$WP post create --post_type="post" --post_title="Governo prorroga vacinação contra a gripe até 1º de junho" --post_status="publish" --post_content="$(cat /tmp/wp-post-291.html)" --post_date="2012-05-24T09:58:00.001-07:00" --post_excerpt="O Ministério da Saúde decidiu prorrogar até o dia 1º de junho a campanha de vacinação contra a gripe em todo o país. Inicialmente, a campanha seria encerrada amanhã, mas até esta quinta-feira apenas 52,4% do público-alvo havia recebido a dose, o que corresponde a 15,8 milhões de pessoas.



A met" --post_category='filosofia'
rm -f /tmp/wp-post-291.html

echo '  [293/375] post: GREVE NA UFRB: ATIVIDADES DE MOBILIZAÇÃO NO CFP...'
$WP post create --post_type="post" --post_title="GREVE NA UFRB: ATIVIDADES DE MOBILIZAÇÃO NO CFP" --post_status="publish" --post_content="$(cat /tmp/wp-post-292.html)" --post_date="2012-05-24T09:48:00.001-07:00" --post_excerpt="Divulgamos abaixo um comunicado do Prof. David Romão, dirigente da APUR e componente do Comando de Greve dos docentes da UFRB, feito pro e-mail aos docentes do CFP informando as ATIVIDADES DE MOBILIZAÇÃO do Centro de Formação de Professores /UFRB (conforme Reunião Sindical de 23 de maio):



\"-" --post_category='educacao'
rm -f /tmp/wp-post-292.html

echo '  [294/375] post: OS OLHOS DE MINHA MÃINHA[1]...'
$WP post create --post_type="post" --post_title="OS OLHOS DE MINHA MÃINHA[1]" --post_status="publish" --post_content="$(cat /tmp/wp-post-293.html)" --post_date="2012-05-23T11:20:00.001-07:00" --post_excerpt="Irenilson de Jesus Barbosa



Os olhos de minha mãinha são olhos de
recomeço

Da mão que embalou meu berço, mas perdeu-se
de meu olhar;

Agora retomam lugar de quem pode
enxergar de novo

E contemplar o seu povo, a quem soube
amar sem mirar.



Os olhos de minha mãinha são olhos assim,
redivivo" --post_category='cultura'
rm -f /tmp/wp-post-293.html

echo '  [295/375] post: Ajuda para os problemas predominantes...'
$WP post create --post_type="post" --post_title="Ajuda para os problemas predominantes" --post_status="publish" --post_content="$(cat /tmp/wp-post-294.html)" --post_date="2012-05-22T20:17:00.000-07:00" --post_excerpt="Max Lucado












“As armas que usamos na nossa luta não são do mundo; são armas poderosas de Deus, capazes de destruir fortalezas”. 2 Coríntios 10:4 NTLH

Algum problema predominante suga a sua vida?

Alguns são inclinados a trapacear. Outros rápidos para duvidar. Talvez você se preocupe. Sim" --post_category='filosofia'
rm -f /tmp/wp-post-294.html

echo '  [296/375] material: APUR DIVULGA CARTA ABERTA A RESPEITO DA GREVE DOCE...'
$WP post create --post_type="material" --post_title="APUR DIVULGA CARTA ABERTA A RESPEITO DA GREVE DOCENTE NA UFRB" --post_status="publish" --post_content="$(cat /tmp/wp-post-295.html)" --post_date="2012-05-21T19:55:00.000-07:00"
rm -f /tmp/wp-post-295.html

echo '  [297/375] publicacao: CHEGOU O TEMPO[1]...'
$WP post create --post_type="publicacao" --post_title="CHEGOU O TEMPO[1]" --post_status="publish" --post_content="$(cat /tmp/wp-post-296.html)" --post_date="2012-05-19T10:16:00.000-07:00" --post_excerpt="Irenilson de Jesus Barbosa




O tempo de cantar chegou, visto que é dia de alegria!

A nota triste já recuou e de longe ouve-se a cantoria.

Ficaram pra trás, o mal assaz, os “ais”, os “ois” e a saudade;

O que passou já não volta mais, fica a alegria, felicidade!



A festa é daqueles que supera"
rm -f /tmp/wp-post-296.html

echo '  [298/375] post: É HOJE O DIA... DENUNCIE A PEDOFILIA!...'
$WP post create --post_type="post" --post_title="É HOJE O DIA... DENUNCIE A PEDOFILIA!" --post_status="publish" --post_content="$(cat /tmp/wp-post-297.html)" --post_date="2012-05-18T18:06:00.000-07:00" --post_category='cultura'
rm -f /tmp/wp-post-297.html

echo '  [299/375] livro: CONDENADA NA JUSTIÇA A ESTUDANTE QUE DISSEMINOU PR...'
$WP post create --post_type="livro" --post_title="CONDENADA NA JUSTIÇA A ESTUDANTE QUE DISSEMINOU PRECONCEITO CONTRA NORDESTINOS NO TWITTER" --post_status="publish" --post_content="$(cat /tmp/wp-post-298.html)" --post_date="2012-05-18T06:29:00.000-07:00" --post_excerpt="Foto publicada em mural no Facebook 
(Nação Nordestina)



A estudante Mayara Petruso, que ficou famosa por ter perpetrado preconceito contra nordestinos através de sua conta no Twitter foi CONDENADA pela Justiça Federal, em ação movida pelo Ministério Público Federal. Ela foi condenada a 1 ano,"
rm -f /tmp/wp-post-298.html

echo '  [300/375] material: DOCENTES DA UFRB DEFLAGRARAM GREVE...'
$WP post create --post_type="material" --post_title="DOCENTES DA UFRB DEFLAGRARAM GREVE" --post_status="publish" --post_content="$(cat /tmp/wp-post-299.html)" --post_date="2012-05-18T05:32:00.000-07:00" --post_excerpt="EM ASSEMBLEIA GERAL DA APUR (Associação dos Professores Universitários do Recôncavo), realizada no último dia 17/05 em Cruz das Almas, DOCENTES DA UNIVERSIDADE FEDERAL DO RECÔNCAVO DA BAHIA DEFLAGRARAM GREVE POR TEMPO INDETERMINADO, SUSPENDENDO AS ATIVIDADES ACADÊMICAS A PARTIR DE SEGUNDA-FEIRA (2"
rm -f /tmp/wp-post-299.html

echo '  [301/375] post: MINC e MCTI abrem 946 oportunidades para concurso ...'
$WP post create --post_type="post" --post_title="MINC e MCTI abrem 946 oportunidades para concurso público" --post_status="publish" --post_content="$(cat /tmp/wp-post-300.html)" --post_date="2012-05-12T23:09:00.000-07:00" --post_excerpt="O Ministério da Cultura (MINC) e o Ministério de Ciência, Tecnologia e Inovação (MCTI) vão abrir ao todo 946 vagas para postos de trabalho.

No Ministério da Cultura será uma seleção simplificada para contratação temporária de 114 profissionais em cargos dos níveis médio, médio/técnico e superior." --post_category='filosofia'
rm -f /tmp/wp-post-300.html

echo '  [302/375] post: DIA DAS MÃES - A NOSSA HOMENAGEM...'
$WP post create --post_type="post" --post_title="DIA DAS MÃES - A NOSSA HOMENAGEM" --post_status="publish" --post_content="$(cat /tmp/wp-post-301.html)" --post_date="2012-05-12T17:06:00.000-07:00" --post_excerpt="Irenilson de Jesus Barbosa




No dia das mães, ofereço essa pequena homenagem a todas as mães e desejo a todas as famílias, um Dia das Mães repleto de afeto e comunhão, sob os cuidados do Senhor, visto que a honra aos pais é uma recomendação de Deus, expressa em sua Palavra, a Bíblia Sagrada:" --post_category='filosofia'
rm -f /tmp/wp-post-301.html

echo '  [303/375] post: CABELO: Vitória é Bi-Campeão Baiano Sub-20 ao venc...'
$WP post create --post_type="post" --post_title="CABELO: Vitória é Bi-Campeão Baiano Sub-20 ao vencer o Bahia" --post_status="publish" --post_content="$(cat /tmp/wp-post-302.html)" --post_date="2012-05-12T15:35:00.001-07:00" --post_excerpt="12 de maio de 2012




O Esporte Clube Vitória jogando hoje (12/05) à tarde, no Estádio Manoel Barradas Carneiro já fez o cabelo e sagrou-se Bi-campeão Baiano da Categoria Sub-20 ao vencer o Esporte Clube Bahia pelo placar de 2 x 0, gols marcados por Wilie aos 10 e 30 minutos do segundo tempo. Pla" --post_category='filosofia'
rm -f /tmp/wp-post-302.html

echo '  [304/375] post: Satélite registra maior foto já feita da Terra...'
$WP post create --post_type="post" --post_title="Satélite registra maior foto já feita da Terra" --post_status="publish" --post_content="$(cat /tmp/wp-post-303.html)" --post_date="2012-05-11T15:50:00.001-07:00" --post_excerpt="Cada pixel da imagem corresponde a 1 km de distância. Uma fotografia parecida é feita a cada meia hora para monitorar o clima.







Terra é retratada em imagem com 121 megapixels, a maior já feita em um só clique (Foto: Roscosmos)

saiba mais
Nasa divulga foto com maior definição já feita da Te" --post_category='filosofia'
rm -f /tmp/wp-post-303.html

echo '  [305/375] publicacao: É ANIVERSÁRIO DE LUCY: Os Meus Versos São pra Ela....'
$WP post create --post_type="publicacao" --post_title="É ANIVERSÁRIO DE LUCY: Os Meus Versos São pra Ela... Sempre!" --post_status="publish" --post_content="$(cat /tmp/wp-post-304.html)" --post_date="2012-05-10T07:50:00.000-07:00" --post_excerpt="Hoje é o aniversário de minha esposa, Luciene, a nossa Lucy Olhomiu. A \"dona\" dos \"olhinhos miúdos\" e atentos que me cativam há décadas. Um amor de adolescência que amadureceu e se fez o lastro de um relacionamento que já dura mais de 30 anos. Casado com ela há quase 22 anos, vejo renovado meu"
rm -f /tmp/wp-post-304.html

echo '  [306/375] post: PROFESSORA COM PARALISIA CEREBRAL DEFENDE TESE DE ...'
$WP post create --post_type="post" --post_title="PROFESSORA COM PARALISIA CEREBRAL DEFENDE TESE DE DOUTORADO NA USP" --post_status="publish" --post_content="$(cat /tmp/wp-post-305.html)" --post_date="2012-05-10T06:19:00.000-07:00" --post_excerpt="Na última terça-feira (09/05), às 14h, a artista plástica Ana Amália Tavares Barbosa, de 46 anos, defendeu com sucesso sua tese de doutorado em arte e educação no Museu de Arte Contemporânea da USP, iniciada quando já estava paralisado, devido a um AVC (acidente vascular cerebral).

Ela não fala," --post_category='educacao'
rm -f /tmp/wp-post-305.html

echo '  [307/375] post: Teologia e Eclesiologia...'
$WP post create --post_type="post" --post_title="Teologia e Eclesiologia" --post_status="publish" --post_content="$(cat /tmp/wp-post-306.html)" --post_date="2012-05-09T13:04:00.000-07:00" --post_excerpt="A FRAGILIDADE DO APOSTOLADO MODERNO

João Rodrigo Weronka

É curioso observar como algumas igrejas evangélicas tem facilidade em aceitar novidades. E é triste verificar a falta de empenho dos cristãos em observar as Escrituras e analisá-las com sensatez e cuidado. Triste também é saber que poucas" --post_category='filosofia'
rm -f /tmp/wp-post-306.html

echo '  [308/375] post: CELEIRO HOMILÉTICO...'
$WP post create --post_type="post" --post_title="CELEIRO HOMILÉTICO" --post_status="publish" --post_content="$(cat /tmp/wp-post-307.html)" --post_date="2012-05-08T08:13:00.002-07:00" --post_excerpt="Um
celeiro de idéias para sua reflexão bíblico-teológica:

 A Grande Comissão, Uma Missão Inacabada 

Autor: Hernandes Dias Lopes 


 

Texto Básico: Mateus 28.18-20 

 INTRODUÇÃO 

1. O método de Cristo é a igreja 


Uma estória [como ilustração]: Quando Cristo terminou sua obra, e chegou ao céu," --post_category='filosofia'
rm -f /tmp/wp-post-307.html

echo '  [309/375] post: VAGAS DE EMPREGOS E ESTÁGIOS...'
$WP post create --post_type="post" --post_title="VAGAS DE EMPREGOS E ESTÁGIOS" --post_status="publish" --post_content="$(cat /tmp/wp-post-308.html)" --post_date="2012-05-08T08:01:00.001-07:00" --post_excerpt="Normal
 0
 21
 
 
 false
 false
 false
 
 
 
 
 
 
 
 MicrosoftInternetExplorer4
 

 
 







Mais uma vez, disponibilizamos oportunidades de emprego e estágios em diversas áreas para nossos leitores e interessados. O candidatos deverão
dirigir-se diretamente ao escritório na Av. Tancredo Neve" --post_category='filosofia'
rm -f /tmp/wp-post-308.html

echo '  [310/375] post: Camila Pitanga pede "VETA, DILMA!" em cerimônia of...'
$WP post create --post_type="post" --post_title="Camila Pitanga pede \"VETA, DILMA!\" em cerimônia oficial" --post_status="publish" --post_content="$(cat /tmp/wp-post-309.html)" --post_date="2012-05-06T15:13:00.000-07:00" --post_excerpt="http://noticias.uol.com.br/videos/assistir.htm?video=camila-pitanga-apela-para-o-veta-dilma-em-cerimonia-0402CD9C376ECCB92326


Salvar como favorito

Dê sua nota:

1
2
3
4
5


Copiar URL e código embed









1

Mestre de cerimônias do evento que concedeu, nesta sexta-feira (04/05/2012), o tít" --post_category='filosofia'
rm -f /tmp/wp-post-309.html

echo '  [311/375] material: UFRB divulga retificação no processo de Transferên...'
$WP post create --post_type="material" --post_title="UFRB divulga retificação no processo de Transferências Interna e Externa, Portador de Diploma e Rematrícula" --post_status="publish" --post_content="$(cat /tmp/wp-post-310.html)" --post_date="2012-05-04T20:19:00.000-07:00" --post_excerpt="Os cursos de história, enfermagem e físicas foram incluídos no processo de Transferências Interna e Externa, Portador de Diploma e Rematrícula para o segundo semestre de 2012 da Universidade Federal do Recôncavo da Bahia (UFRB). Depois da alteração, foram acrescentadas 24 vagas na seleção, total"
rm -f /tmp/wp-post-310.html

echo '  [312/375] post: Uso excessivo de analgésicos pode transformar a do...'
$WP post create --post_type="post" --post_title="Uso excessivo de analgésicos pode transformar a dor simples em crônica" --post_status="publish" --post_content="$(cat /tmp/wp-post-311.html)" --post_date="2012-05-03T16:05:00.001-07:00" --post_excerpt="Medicação indevida pode causar dores, lesões nos rins e até levar ao óbito




Uso excessivo de analgésicos pode transformar a dor simples em crônica


A sociedade contemporânea e sua lógica de bem-estar relacionada ao consumo nos leva a uma vida agitada e corrida em que o tempo é uma matéria-prim" --post_category='cotidiano'
rm -f /tmp/wp-post-311.html

echo '  [313/375] publicacao: UFRB divulga edital de apoio à publicação de livro...'
$WP post create --post_type="publicacao" --post_title="UFRB divulga edital de apoio à publicação de livros" --post_status="publish" --post_content="$(cat /tmp/wp-post-312.html)" --post_date="2012-05-03T15:43:00.001-07:00" --post_excerpt="A Pró-Reitoria de Pesquisa e Pós-Graduação (PRPPG) da Universidade Federal do Recôncavo da Bahia (UFRB) torna público o edital de apoio à publicação de livros a serem impressos a partir do ano de 2012. A oportunidade é para docentes efetivos da instituição, que podem submeter até duas propostas pa"
rm -f /tmp/wp-post-312.html

echo '  [314/375] post: Diversas vagas de emprego e estágios em Salvador...'
$WP post create --post_type="post" --post_title="Diversas vagas de emprego e estágios em Salvador" --post_status="publish" --post_content="$(cat /tmp/wp-post-313.html)" --post_date="2012-05-03T09:35:00.002-07:00" --post_excerpt="Nosso blogue disponibiliza regularmente diversas oportunidades de emprego e estágio fornecidas por nosso parceiro FIDÉLIS SANTANA. Uma delas pode ser sua ou de alguém indicado por você. Confira e aproveite as oportunidades ou faça a sua parte para ajudar a alguém que você conhece.



Os candidatos" --post_category='filosofia'
rm -f /tmp/wp-post-313.html

echo '  [315/375] post: ENECULT abre inscrições e divulga programação para...'
$WP post create --post_type="post" --post_title="ENECULT abre inscrições e divulga programação para 2012" --post_status="publish" --post_content="$(cat /tmp/wp-post-314.html)" --post_date="2012-05-03T07:22:00.000-07:00" --post_excerpt="No próximo sábado (05), o VIII ENECULT começa a receber inscrições de participantes sem trabalhos. Os interessados devem acessar o site do evento e realizar cadastro para emissão do boleto bancário. Para mais detalhes acesse www.enecult.ufba.br. Vale lembrar que, como resultado da etapa de" --post_category='filosofia'
rm -f /tmp/wp-post-314.html

echo '  [316/375] post: A ORIGEM DO DIA DO TRABALHADOR...'
$WP post create --post_type="post" --post_title="A ORIGEM DO DIA DO TRABALHADOR" --post_status="publish" --post_content="$(cat /tmp/wp-post-315.html)" --post_date="2012-05-01T10:56:00.002-07:00" --post_excerpt="Entre as inúmeras datas comemorativas em nosso calendário, não poderia faltar o dia em que todos os trabalhadores são homenageados e também presenteados com um feriado. 1º de maio é o dia do trabalho, ou como preferimos, O DIA DO TRABALHADOR, celebrado na maioria dos países do mundo.



A origem d" --post_category='filosofia'
rm -f /tmp/wp-post-315.html

echo '  [317/375] post: Iniciado no CFP o Curso Educação Matemática no Ens...'
$WP post create --post_type="post" --post_title="Iniciado no CFP o Curso Educação Matemática no Ensino Médio" --post_status="publish" --post_content="$(cat /tmp/wp-post-316.html)" --post_date="2012-04-30T21:26:00.000-07:00" --post_excerpt="No sábado, do dia 14/04, começaram as atividades do EMEM, curso de formação continuada, o qual é ofertado sob a coordenação dos professores Leandro Diniz e Gilson Jesus. Tiveram interesse cerca de 60 professore(a)s do estado da Bahia, o(a)s quais enviaram e-mails buscando informações ou querendo ..." --post_category='educacao'
rm -f /tmp/wp-post-316.html

echo '  [318/375] livro: Revista do CCAAB recebe trabalhos para primeiro fa...'
$WP post create --post_type="livro" --post_title="Revista do CCAAB recebe trabalhos para primeiro fascículo" --post_status="publish" --post_content="$(cat /tmp/wp-post-317.html)" --post_date="2012-04-30T18:56:00.000-07:00" --post_excerpt="A Revista Arquivos de Pesquisa Animal, editada pelo Centro de Ciências Agrárias, Ambientais e Biológicas (CCAAB) da Universidade Federal do Recôncavo da Bahia (UFRB), divulga chamada de trabalhos para serem publicados em seu primeiro fascículo, que tem como previsão de lançamento julho de 2012. A"
rm -f /tmp/wp-post-317.html

echo '  [319/375] publicacao: Revista Griot do CFP/UFRB obtém conceito Qualis B5...'
$WP post create --post_type="publicacao" --post_title="Revista Griot do CFP/UFRB obtém conceito Qualis B5 da CAPES" --post_status="publish" --post_content="$(cat /tmp/wp-post-318.html)" --post_date="2012-04-30T18:50:00.000-07:00" --post_excerpt="A Griot - Revista de Filosofia do Centro de Formação de Professores (CFP) da Universidade Federal do Recôncavo da Bahia (UFRB) obteve o conceito Qualis B5 pela Coordenação de Aperfeiçoamento de Pessoal de Nível Superior (Capes) na recente classificação de periódicos científicos. A publicação, q"
rm -f /tmp/wp-post-318.html

echo '  [320/375] post: Inscrições abertas para Prêmio BNB de Talentos Uni...'
$WP post create --post_type="post" --post_title="Inscrições abertas para Prêmio BNB de Talentos Universitários" --post_status="publish" --post_content="$(cat /tmp/wp-post-319.html)" --post_date="2012-04-30T18:29:00.000-07:00" --post_excerpt="Até o próximo dia 28 de maio, podem ser realizadas as inscrições para o 11º Prêmio BNB de Talentos Universitários.


Os candidatos devem estar concluindo o último ano de graduação ou ter concluído em 2011, nas áreas de economia, comércio exterior, agronomia, turismo e sociologia, em qualquer Insti" --post_category='filosofia'
rm -f /tmp/wp-post-319.html

echo '  [321/375] post: Vitória vence Feirense e é finalista do Baianão pe...'
$WP post create --post_type="post" --post_title="Vitória vence Feirense e é finalista do Baianão pela 11ª vez consecutiva" --post_status="publish" --post_content="$(cat /tmp/wp-post-320.html)" --post_date="2012-04-28T14:43:00.001-07:00" --post_excerpt="O Esporte Clube Vitória era o grande favorito no jogo desta tarde no Barradão valendo vaga para as finais do Campeonato Baiano, e não deu outra. O time vermelho e preto fazendo jus a sua melhor estrutura, time, tradição e experiência em decisões e, sobretudo, contando com o apoio da sua torcida" --post_category='filosofia'
rm -f /tmp/wp-post-320.html

echo '  [322/375] post: Mercado de produtos para pessoa com deficiência de...'
$WP post create --post_type="post" --post_title="Mercado de produtos para pessoa com deficiência deve crescer 20% neste ano" --post_status="publish" --post_content="$(cat /tmp/wp-post-321.html)" --post_date="2012-04-28T09:55:00.000-07:00" --post_excerpt="Bens e serviços de tecnologia assistiva movimentaram R$ 1,5 bi no país em 2011; perspectiva é favorável, sobretudo, por apoio de novas linhas de crédito 

O Brasil acostumou-se nos últimos anos a notícias sobre a pujança da economia doméstica. Dentre tantos setores beneficiados um se destaca pelo" --post_category='filosofia'
rm -f /tmp/wp-post-321.html

echo '  [323/375] post: "EU TENHO UM SONHO"......'
$WP post create --post_type="post" --post_title="\"EU TENHO UM SONHO\"..." --post_status="publish" --post_content="$(cat /tmp/wp-post-322.html)" --post_date="2012-04-28T07:46:00.000-07:00" --post_excerpt="Martin Luther King Jr.




Em um dos mais célebres momentos da luta pelos direitos civis, nos EUA (a marcha de Washington. 28 de agosto, 1963), o meu colega pastor batista e irmão em Cristo, posteriormente agraciado com o Nobel da Paz (em 1964), Martin Luther King Jr, fez um dos mais memoráveis d" --post_category='filosofia'
rm -f /tmp/wp-post-322.html

echo '  [324/375] livro: IGREJA BATISTA BRASILEIRA EM WASHINGTON - DC FAZ C...'
$WP post create --post_type="livro" --post_title="IGREJA BATISTA BRASILEIRA EM WASHINGTON - DC FAZ CAMPANHA CONTRA A FOME" --post_status="publish" --post_content="$(cat /tmp/wp-post-323.html)" --post_date="2012-04-27T22:51:00.000-07:00" --post_excerpt="O pastor Carlos Lustosa Mendes, líder espiritual da Igreja Batista Brasileira em Washington - DC, nos EUA e nosso amigo há mais de 22 anos, desde o saudoso tempo de graduação em Teologia no Seminário Teológico Batista do Sul do Brasil (STBSB), realiza em Washington a CAMPANHA 30 HORAS DE FOME. Veja"
rm -f /tmp/wp-post-323.html

echo '  [325/375] post: Faça o bem secretamente...'
$WP post create --post_type="post" --post_title="Faça o bem secretamente" --post_status="publish" --post_content="$(cat /tmp/wp-post-324.html)" --post_date="2012-04-27T22:36:00.002-07:00" --post_excerpt="Max Lucado



“Gostam de orar em pé nas sinagogas, e às esquinas das ruas, para serem vistos pelos homens” (Mateus 6:5).



Esta é a definição prática de hipocrisia: “ser visto pelos homens”. A palavra grega para hipócrita, hypokrités, originalmente significava “ator”. Os atores do primeiro século" --post_category='filosofia'
rm -f /tmp/wp-post-324.html

echo '  [326/375] publicacao: Prorrogadas as inscrições para o PIBIC e o PIBITI...'
$WP post create --post_type="publicacao" --post_title="Prorrogadas as inscrições para o PIBIC e o PIBITI" --post_status="publish" --post_content="$(cat /tmp/wp-post-325.html)" --post_date="2012-04-27T22:18:00.002-07:00" --post_excerpt="Os editais do Programa Institucional de Bolsas de Iniciação em Desenvolvimento Tecnológico e Inovação (PIBITI) e do Programa Institucional de Bolsa de Iniciação Científica (PIBIC) tiveram seus períodos de inscrições prorrogados até 07 de maio. A data de divulgação dos resultados também foi alter"
rm -f /tmp/wp-post-325.html

echo '  [327/375] publicacao: Concurso AGU 2012 – 70 vagas com salário de R$ 14....'
$WP post create --post_type="publicacao" --post_title="Concurso AGU 2012 – 70 vagas com salário de R$ 14.970,60" --post_status="publish" --post_content="$(cat /tmp/wp-post-326.html)" --post_date="2012-04-27T12:17:00.001-07:00" --post_excerpt="Publicado em 27 abril, 2012


A Advocacia-Geral da União divulgou, no “Diário Oficial União” desta sexta-feira (27), na Seção 3, páginas 89 a 96, o edital de abertura do concurso público para provimento de 70 vagas para cargo de procurador da Fazenda Nacional de 2ª categoria. O rendimento inicia"
rm -f /tmp/wp-post-326.html

echo '  [328/375] post: COTAS RACIAIS NAS UNIVERSIDADES SÃO CONSTITUCIONAI...'
$WP post create --post_type="post" --post_title="COTAS RACIAIS NAS UNIVERSIDADES SÃO CONSTITUCIONAIS" --post_status="publish" --post_content="$(cat /tmp/wp-post-327.html)" --post_date="2012-04-27T07:41:00.000-07:00" --post_excerpt="Supremo Tribunal Federal decidiu por unanimidade







































 O Supremo Tribunal Federal decidiu nesta quinta-feira, 26/04/2012, que o 

sistema que garante cotas nas universidades aos grupos tradicionalmente excluídos 

da sociedade, como negros e índios, é constituci" --post_category='educacao'
rm -f /tmp/wp-post-327.html

echo '  [329/375] post: Nicotina: Adesivos e chicletes não ajudam a parar ...'
$WP post create --post_type="post" --post_title="Nicotina: Adesivos e chicletes não ajudam a parar de fumar" --post_status="publish" --post_content="$(cat /tmp/wp-post-328.html)" --post_date="2012-04-24T21:39:00.003-07:00" --post_excerpt="Nicotina: Adesivos e chicletes não ajudam a parar de fumar


Adesivos e chicletes de nicotina são usados por milhões de fumantes, mas eles podem não trazer nenhum benefício duradouro, de acordo com o mais rigoroso estudo de longo prazo já realizado.

O estudo incluiu cerca de 800 pessoas tentand" --post_category='filosofia'
rm -f /tmp/wp-post-328.html

echo '  [330/375] post: Nova vacina contra tuberculose conseguirá proteger...'
$WP post create --post_type="post" --post_title="Nova vacina contra tuberculose conseguirá proteger adultos" --post_status="publish" --post_content="$(cat /tmp/wp-post-329.html)" --post_date="2012-04-24T21:32:00.000-07:00" --post_excerpt="Nova vacina contra tuberculose conseguirá proteger adultos


A criação de uma vacina eficaz contra a bactéria causadora da tuberculose em roedores reavivou a esperança de uma proteção mais efetiva em pessoas adultas contra uma doença que a cada ano causa um milhão e meio de mortes.

A clássica v" --post_category='filosofia'
rm -f /tmp/wp-post-329.html

echo '  [331/375] post: Justiça Federal autoriza matrícula de crianças men...'
$WP post create --post_type="post" --post_title="Justiça Federal autoriza matrícula de crianças menores de 6 anos no país" --post_status="publish" --post_content="$(cat /tmp/wp-post-330.html)" --post_date="2012-04-24T21:11:00.003-07:00" --post_excerpt="Juiz Cláudio Kitner, de PE, estendeu decisão para todo o Brasil




Justiça Federal autoriza matrícula de crianças menores de 6 anos no país


A Justiça Federal em Pernambuco (JFPE) estendeu, na última sexta-feira (13/04), para instituições educacionais de todo o país, a decisão que confirma a gar" --post_category='filosofia'
rm -f /tmp/wp-post-330.html

echo '  [332/375] post: A última face de Cristo...'
$WP post create --post_type="post" --post_title="A última face de Cristo" --post_status="publish" --post_content="$(cat /tmp/wp-post-331.html)" --post_date="2012-04-19T20:52:00.000-07:00" --post_excerpt="Técnica 
 de reconstituição facial 
 põe em xeque imagem clássica 
 do rosto de Jesus
  
 
 
 
José 
 Eduardo Barella 
 

 

 
 
 BBC
  
 
 
 Resultado 
 da simulação, com base no crânio de um judeu do século 
 I: Cristo mais moreno
 


Rosto 
 fino, nariz alongado, olhos castanhos (às vezes verdes" --post_category='filosofia'
rm -f /tmp/wp-post-331.html

echo '  [333/375] post: Brasil é o quarto país com maior número de casos d...'
$WP post create --post_type="post" --post_title="Brasil é o quarto país com maior número de casos de anencefalia" --post_status="publish" --post_content="$(cat /tmp/wp-post-332.html)" --post_date="2012-04-19T19:27:00.002-07:00" --post_excerpt="As razões para que um país tenha mais ou menos casos são desconhecidas...

 
 

 

O Brasil é o quarto país do 
mundo com maior prevalência de nascimentos de bebês com anencefalia 
(ausência parcial ou total do cérebro), segundo a OMS (Organização 
Mundial da Saúde). A incidência é de cerca de" --post_category='filosofia'
rm -f /tmp/wp-post-332.html

echo '  [334/375] publicacao: Israel lembra o Dia do Holocausto com sirenes e ho...'
$WP post create --post_type="publicacao" --post_title="Israel lembra o Dia do Holocausto com sirenes e homenagens" --post_status="publish" --post_content="$(cat /tmp/wp-post-333.html)" --post_date="2012-04-19T16:08:00.001-07:00" --post_excerpt="A
 população israelense rememorou nesta quinta-feira, dia 19, o Dia do 
Holocausto – um dos mais solenes de seu calendário – com uma série de 
atos em todas as instituições públicas e com o simbólico toque das 
sirenes, que, por sua vez, paralisou todo o país às 4h da manhã (horário
 de Brasíl"
rm -f /tmp/wp-post-333.html

echo '  [335/375] post: Droga contra derrame é incluída no SUS...'
$WP post create --post_type="post" --post_title="Droga contra derrame é incluída no SUS" --post_status="publish" --post_content="$(cat /tmp/wp-post-334.html)" --post_date="2012-04-19T14:17:00.000-07:00" --post_excerpt="De acordo com o Ministério da Saúde, os hospitais públicos ainda precisam ser habilitados para prestar esse tipo de atendimento

 




 
 

 

O governo alterou o protocolo 
de tratamento contra AVC (Acidente Vascular Cerebral), que é hoje a 
principal causa de morte no país. 
A decisão, publicad..." --post_category='filosofia'
rm -f /tmp/wp-post-334.html

echo '  [336/375] post: III Encontro Baiano de Estudos em Cultura...'
$WP post create --post_type="post" --post_title="III Encontro Baiano de Estudos em Cultura" --post_status="publish" --post_content="$(cat /tmp/wp-post-335.html)" --post_date="2012-04-19T14:06:00.000-07:00" --post_excerpt="A hisórica
 cidade de Cachoeira, no Recôncavo da Bahia, sedia, de 18 a 20 de abril de 2012, o III Encontro Baiano de Estudos em 
Cultura (EBECULT). O evento 
promove a visibilidade da produção acadêmica desenvolvida no campo da 
cultura no Estado e incentiva o intercâmbio entre pesquisadores, 
gest" --post_category='cultura'
rm -f /tmp/wp-post-335.html

echo '  [337/375] material: Associação Diáspora promove Oficina de Energia Ren...'
$WP post create --post_type="material" --post_title="Associação Diáspora promove Oficina de Energia Renovável" --post_status="publish" --post_content="$(cat /tmp/wp-post-336.html)" --post_date="2012-04-19T12:44:00.000-07:00" --post_excerpt="Oficina de Energia Renovável

 \"Como Fazer um Aerogerador\"  

 

Quando? Domingo, dia 22 de Abril, às 10 horas.

 

Onde? Rua do Pirui, 124, Arembepe 

Localização: primeira casa à direita de quem entra na primeira via de acesso à praia do Piruí.

Venha aprender a construir um equipamento s"
rm -f /tmp/wp-post-336.html

echo '  [338/375] post: Lei declara Paulo Freire "Patrono da Educação Bras...'
$WP post create --post_type="post" --post_title="Lei declara Paulo Freire \"Patrono da Educação Brasileira\"" --post_status="publish" --post_content="$(cat /tmp/wp-post-337.html)" --post_date="2012-04-16T19:45:00.002-07:00" --post_excerpt="O projeto de lei foi aprovado no início de março pela Comissão de Educação, Cultura e Esporte do Senado, em decisão terminativa, por unanimidade.


Foto: Wikimedia

O escritor e educador Paulo Freire, em janeiro de 1977.

O Diário Oficial da União publicou (no último dia 16/04), uma lei que declara" --post_category='educacao'
rm -f /tmp/wp-post-337.html

echo '  [339/375] post: Inscrições abertas para o Prêmio Mercosul de Ciênc...'
$WP post create --post_type="post" --post_title="Inscrições abertas para o Prêmio Mercosul de Ciência e Tecnologia de 2012" --post_status="publish" --post_content="$(cat /tmp/wp-post-338.html)" --post_date="2012-04-16T11:47:00.001-07:00" --post_excerpt="Estão abertas, desde o dia 09/04, as inscrições para
 o Prêmio Mercosul de Ciência e Tecnologia de 2012, com o tema principal
 “Inovação tecnológica na saúde”. Estudantes e pesquisadores de todo o 
Brasil e dos demais países membros e associados do Mercosul (Argentina, 
Paraguai, Uruguai, Venezue..." --post_category='educacao'
rm -f /tmp/wp-post-338.html

echo '  [340/375] post: Ministério do Planejamento autoriza concurso com 7...'
$WP post create --post_type="post" --post_title="Ministério do Planejamento autoriza concurso com 725 vagas para Analista Social" --post_status="publish" --post_content="$(cat /tmp/wp-post-339.html)" --post_date="2012-04-13T18:16:00.001-07:00" --post_excerpt="Por Larissa Alberti | Redação IMP – 10/04/2012 12:23:00

Uma boa oportunidade para quem atua na área de Serviço Social. O governo federal anunciou que vai abrir concurso público para o provimento de 725 vagas para o cargo de Analista Técnico de Políticas Sociais. A ministra do Planejamento, Miriam" --post_category='politica'
rm -f /tmp/wp-post-339.html

echo '  [341/375] post: ‎13 de Abril - Dia do Hino Nacional Brasileiro...'
$WP post create --post_type="post" --post_title="‎13 de Abril - Dia do Hino Nacional Brasileiro" --post_status="publish" --post_content="$(cat /tmp/wp-post-340.html)" --post_date="2012-04-13T07:09:00.002-07:00" --post_excerpt="A história do Hino Nacional reflete alguns dos momentos mais importantes de nossa História. O hino surgiu no momento em que o Brasil atravessava um período difícil, pois D. Pedro I em razão de seus desmandos autoritários fazia a independência do país oscilar. Assim, ao calor das manifestações civ" --post_category='filosofia'
rm -f /tmp/wp-post-340.html

echo '  [342/375] post: PRÊMIO JOVENS INSPIRADORES...'
$WP post create --post_type="post" --post_title="PRÊMIO JOVENS INSPIRADORES" --post_status="publish" --post_content="$(cat /tmp/wp-post-341.html)" --post_date="2012-04-12T21:53:00.000-07:00" --post_excerpt="Veja a divulgação desse prêmio da Editora Abril e confira os detalhes
no link
http://veja.abril.com.br/premio-jovens-inspiradores/















Fundação Estudar" --post_category='cultura'
rm -f /tmp/wp-post-341.html

echo '  [343/375] post: MUNDO MODERNO......'
$WP post create --post_type="post" --post_title="MUNDO MODERNO..." --post_status="publish" --post_content="$(cat /tmp/wp-post-342.html)" --post_date="2012-04-12T21:34:00.003-07:00" --post_excerpt="(Chico Anysio)


Este monólogo fez parte do meu discurso de formatura em Pedagogia, em solenidade de Colação de Grau no Salão Nobre da Reitoria da Universidade Federal da Bahia. Na ocasião, o transcrevi de uma entrevista do grande mestre Chico Anysio, dada no Programa do Jô Soares, não lembro bem s" --post_category='educacao'
rm -f /tmp/wp-post-342.html

echo '  [344/375] publicacao: Nota Pública da Campanha Nacional pelo Direito à E...'
$WP post create --post_type="publicacao" --post_title="Nota Pública da Campanha Nacional pelo Direito à Educação sobre reunião com o Governo e a Comissão Especial do PNE" --post_status="publish" --post_content="$(cat /tmp/wp-post-343.html)" --post_date="2012-04-12T18:10:00.001-07:00" --post_excerpt="Brasil, 11 de abril de 2012.

O encontro a portas fechadas realizado ontem, 10 de abril, na sede do Ministério da Fazenda, entre o Ministro Guido Mantega e os parlamentares da Comissão Especial responsável pela análise da proposta do novo PNE (Plano Nacional de Educação), infelizmente, seguiu o"
rm -f /tmp/wp-post-343.html

echo '  [345/375] livro: CONCURSO NA ÁREA DE ENSINO DE QUÍMICA - UEA...'
$WP post create --post_type="livro" --post_title="CONCURSO NA ÁREA DE ENSINO DE QUÍMICA - UEA" --post_status="publish" --post_content="$(cat /tmp/wp-post-344.html)" --post_date="2012-04-12T09:11:00.003-07:00" --post_excerpt="A Universidade do Estado do Amazonas abriu concurso para a área de ensinode química (são 11 vagas ao todo). A UEA é hoje no Brasil a universidadeque melhor remunera seus docentes. O concurso é em regime de 40h (não éDE) sendo o salário inicial para Dr. de R$ 7.897,29 mais o adicional delocalidade,"
rm -f /tmp/wp-post-344.html

echo '  [346/375] post: Pesquisa revela que quase a metade da população br...'
$WP post create --post_type="post" --post_title="Pesquisa revela que quase a metade da população brasileira está acima do peso" --post_status="publish" --post_content="$(cat /tmp/wp-post-345.html)" --post_date="2012-04-11T07:35:00.002-07:00" --post_excerpt="Brasília – Estudo divulgado esta quarta (10) pelo Ministério da Saúde indica que o excesso de peso e a obesidade aumentaram no país no período de 2006 a 2011. De acordo com a pesquisa de Vigilância de Fatores de Risco e Proteção para Doenças Crônicas por Inquérito Telefônico (Vigitel), a proporçã..." --post_category='filosofia'
rm -f /tmp/wp-post-345.html

echo '  [347/375] post: SENADO APROVA NOVO REGIME PREVIDENCIÁRIO PARA SERV...'
$WP post create --post_type="post" --post_title="SENADO APROVA NOVO REGIME PREVIDENCIÁRIO PARA SERVIDORES FEDERAIS: Confira algumas mudanças" --post_status="publish" --post_content="$(cat /tmp/wp-post-346.html)" --post_date="2012-04-10T17:18:00.000-07:00" --post_excerpt="O Senado Federal aprovou no dia 28/03/2012, o novo modelo de previdência do servidor público federal. O Projeto de Lei da Câmara (PLC) 02/2012 , aprovado em votação simbólica, acaba com a garantia de aposentadoria integral a servidores que recebam acima do teto do Regime Geral da Previdência Soci" --post_category='filosofia'
rm -f /tmp/wp-post-346.html

echo '  [348/375] publicacao: Inscrições abertas para II Simpósio Baiano das Lic...'
$WP post create --post_type="publicacao" --post_title="Inscrições abertas para II Simpósio Baiano das Licenciaturas" --post_status="publish" --post_content="$(cat /tmp/wp-post-347.html)" --post_date="2012-04-10T14:06:00.003-07:00" --post_excerpt="Contextualização

O Simpósio Baiano das Licenciaturas é um evento que surge no contexto do FORPROF – Fórum Permanente de Apoio a Formação Docente, o qual foi instituído na Bahia no dia 21 de janeiro de 2010, pelo Exmo. Secretário da Educação do Estado da Bahia, obedecendo ao Decreto 6.755 da atua..."
rm -f /tmp/wp-post-347.html

echo '  [349/375] material: UFRB divulga aprovados em 3ª chamada para vagas re...'
$WP post create --post_type="material" --post_title="UFRB divulga aprovados em 3ª chamada para vagas remanescentes do SiSU" --post_status="publish" --post_content="$(cat /tmp/wp-post-348.html)" --post_date="2012-04-10T13:50:00.000-07:00" --post_excerpt="Os candidatos que se inscreveram no Cadastro Seletivo podem conferir o resultado dos aprovados na 3ª chamada da seleção para as vagas remanescentes do SiSU em cursos de graduação da Universidade Federal do Recôncavo da Bahia (UFRB).

A matrícula dos aprovados será feita exclusivamente no campus"
rm -f /tmp/wp-post-348.html

echo '  [350/375] publicacao: A DOCÊNCIA EM RISCO...'
$WP post create --post_type="publicacao" --post_title="A DOCÊNCIA EM RISCO" --post_status="publish" --post_content="$(cat /tmp/wp-post-349.html)" --post_date="2012-04-10T06:05:00.000-07:00" --post_excerpt="Denise Lemos



“Acabo de declinar um convite de um colega, que precisa de um parecerista para examinar seu processo de progressão acadêmica. Algo extremamente importante! Entretanto tive que dizer: não tenho agenda para os próximos 60 dias, inclusive, porque todas as quintas pela manhã tenho que"
rm -f /tmp/wp-post-349.html

echo '  [351/375] livro: O VAZIO QUE JESUS DEIXOU...'
$WP post create --post_type="livro" --post_title="O VAZIO QUE JESUS DEIXOU" --post_status="publish" --post_content="$(cat /tmp/wp-post-350.html)" --post_date="2012-04-07T07:31:00.000-07:00" --post_excerpt="O teólogo e Pr. Idenilton Barbosa publicou em seu Facebook essa importante mensagem sobre a Páscoa e a ressurreição de Cristo. Confira e reflita!




É comum, quando perdemos uma pessoa querida, sentirmos a sua ausência. Observamos com melancolia as coisas de que ela gostava, relembramos com sauda"
rm -f /tmp/wp-post-350.html

echo '  [352/375] publicacao: SIMPÓSIO INTERNACIONAL DISCUTE MEDICALIZAÇÃO DA ED...'
$WP post create --post_type="publicacao" --post_title="SIMPÓSIO INTERNACIONAL DISCUTE MEDICALIZAÇÃO DA EDUCAÇÃO E DA SOCIEDADE" --post_status="publish" --post_content="$(cat /tmp/wp-post-351.html)" --post_date="2012-04-07T06:59:00.000-07:00" --post_excerpt="O I SIMPÓSIO INTERNACIONAL e I SIMPÓSIO BAIANO MEDICALIZAÇÃO DA EDUCAÇÃO E DA SOCIEDADE: CIÊNCIA OU MITO?  a realizar-se no Centro de Convenções da Bahia, em Salvador, no período de 29 a 31 de maio de 2012, tem como principal objetivo aprofundar o debate na Bahia em torno da educação medicalizada."
rm -f /tmp/wp-post-351.html

echo '  [353/375] post: Presidenta Dilma Rousseff sanciona lei que obriga ...'
$WP post create --post_type="post" --post_title="Presidenta Dilma Rousseff sanciona lei que obriga a flexão de gênero em diplomas" --post_status="publish" --post_content="$(cat /tmp/wp-post-352.html)" --post_date="2012-04-07T06:44:00.001-07:00" --post_excerpt="Do Portal Planalto
A presidenta Dilma Rousseff sancionou a Lei 12.605  disponível para os nossos leitores no link &lt;http://www.planalto.gov.br/CCIVIL_03/_Ato2011-2014/2012/Lei/L12605.htm&gt;, publicada na quarta-feira (04/03/2012), no Diário Oficial da União (DOU), que obriga as instituições de" --post_category='filosofia'
rm -f /tmp/wp-post-352.html

echo '  [354/375] material: Setor das IFES convoca paralisação dos docentes pa...'
$WP post create --post_type="material" --post_title="Setor das IFES convoca paralisação dos docentes para 19 de abril" --post_status="publish" --post_content="$(cat /tmp/wp-post-353.html)" --post_date="2012-04-05T19:48:00.000-07:00" --post_excerpt="Atividades de mobilização e paralisação deverão marcar o mês de abril nas Instituições Federais de Ensino Superior (Ifes). Esta é uma das deliberações tiradas na reunião do Setor das Ifes, realizada nos últimos dias 29 e 30.Confira aqui o relatório da reunião.

Os 67 presentes (sendo sete diretores"
rm -f /tmp/wp-post-353.html

echo '  [355/375] post: UFRB lança nova versão do Manual do Estudante...'
$WP post create --post_type="post" --post_title="UFRB lança nova versão do Manual do Estudante" --post_status="publish" --post_content="$(cat /tmp/wp-post-354.html)" --post_date="2012-04-05T19:13:00.000-07:00" --post_excerpt="A Universidade Federal do Recôncavo da Bahia (UFRB) por meio da Pró-Reitoria de Graduação (PROGRAD) acaba de lançar uma nova versão do Manual do Estudante, documento que visa orientar a comunidade discente em sua vivência acadêmica. O Manual do Estudante 2012 serve de fonte de informação sobre as" --post_category='educacao'
rm -f /tmp/wp-post-354.html

echo '  [356/375] post: Ministério das Comunicações lança Edital do Projet...'
$WP post create --post_type="post" --post_title="Ministério das Comunicações lança Edital do Projeto Cidades Digitais" --post_status="publish" --post_content="$(cat /tmp/wp-post-355.html)" --post_date="2012-04-02T18:28:00.000-07:00" --post_excerpt="Desenvolvimento teve participação da RNP







O ministro das Comunicações, Paulo Bernardo, e a secretária de Inclusão Digital do Ministério das Comunicações (MiniCom), Lygia Puppato, lançaram na quarta-feria (dia 28 de março), em Brasília, o edital para o projeto-piloto para cidades digitais co" --post_category='filosofia'
rm -f /tmp/wp-post-355.html

echo '  [357/375] material: PROGRAD abre inscrição para Bolsista do Núcleo de ...'
$WP post create --post_type="material" --post_title="PROGRAD abre inscrição para Bolsista do Núcleo de Políticas de Inclusão" --post_status="publish" --post_content="$(cat /tmp/wp-post-356.html)" --post_date="2012-04-02T11:52:00.000-07:00" --post_excerpt="A Pró- Reitoria de Graduação abre 
inscrição no período de 29 de março a 04 de abril de 2012 para 
candidatos a Bolsista do Núcleo de Políticas de Inclusão. O (a) 
candidato (a) selecionado (a) auxiliará o estudante com deficiência 
visual no desenvolvimento de suas atividades acadêmic"
rm -f /tmp/wp-post-356.html

echo '  [358/375] post: Estudos revelam que bilíngues raciocinam melhor e ...'
$WP post create --post_type="post" --post_title="Estudos revelam que bilíngues raciocinam melhor e têm menos problemas mentais" --post_status="publish" --post_content="$(cat /tmp/wp-post-357.html)" --post_date="2012-03-29T15:22:00.001-07:00" --post_excerpt="Pesquisas mostram que habilidade adia demência e traz flexibilidade cognitiva










Crianças aprendendo inglês em colégio bilíngue: Mesmo sem saber, elas estão aprimorando suas funções cognitivas.NINA LIMA





NOVA YORK — Ter a capacidade de falar mais de um idioma pode ser sinônimo de melho" --post_category='filosofia'
rm -f /tmp/wp-post-357.html

echo '  [359/375] publicacao: Inscrições abertas em Editais PIBIC e PIBITI na UF...'
$WP post create --post_type="publicacao" --post_title="Inscrições abertas em Editais PIBIC e PIBITI na UFRB" --post_status="publish" --post_content="$(cat /tmp/wp-post-358.html)" --post_date="2012-03-29T15:01:00.000-07:00" --post_excerpt="Os editais do Programa Institucional de Bolsas de Iniciação em Desenvolvimento Tecnológico e Inovação (PIBITI) e do Programa Institucional de Bolsa de Iniciação Científica (PIBIC) estão com as inscrições abertas até 27 e 30 de abril, respectivamente.



Os candidatos deverão possuir disponibilidade"
rm -f /tmp/wp-post-358.html

echo '  [360/375] material: UFRB seleciona docentes temporários para o Centro ...'
$WP post create --post_type="material" --post_title="UFRB seleciona docentes temporários para o Centro de Ciências da Saúde" --post_status="publish" --post_content="$(cat /tmp/wp-post-359.html)" --post_date="2012-03-29T14:53:00.000-07:00" --post_excerpt="O Centro de Ciências da Saúde (CCS) da Universidade Federal do Recôncavo da Bahia (UFRB) torna pública a abertura das inscrições para processo seletivo simplificado, com vistas à contratação de professor temporário. As vagas são para graduados em Filosofia ou Sociologia e Enfermagem. Os códigos e"
rm -f /tmp/wp-post-359.html

echo '  [361/375] post: Vitória lança novos uniformes e loja oficial na To...'
$WP post create --post_type="post" --post_title="Vitória lança novos uniformes e loja oficial na Toca do Leão com presença de modelos Nicole Bahls e Anamara" --post_status="publish" --post_content="$(cat /tmp/wp-post-360.html)" --post_date="2012-03-27T18:57:00.000-07:00" --post_excerpt="Rubro-Negro deve estrear a nova camisa nesta quarta contra o Flu de Feira



Por GLOBOESPORTE.COMSalvador













Novos uniformes foram apresentados nesta terça(Foto: Raphael Carneiro/Globoesporte.com)





Na noite desta terça-feira, 27/03, o Vitória lançou o seu novo uniforme para a tempora" --post_category='filosofia'
rm -f /tmp/wp-post-360.html

echo '  [362/375] post: Vitória lança novos uniformes e inaugura loja na T...'
$WP post create --post_type="post" --post_title="Vitória lança novos uniformes e inaugura loja na Toca do Leão" --post_status="publish" --post_content="$(cat /tmp/wp-post-361.html)" --post_date="2012-03-27T15:19:00.002-07:00" --post_excerpt="O Esporte Clube Vitória, maior colecionador de títulos regionais do Brasil na última década (dos 10 disputados), lança na noite de hoje, na Toca do Leão, os seus novos uniformes para 2012. Com diversos convidados rubro-negros, o destaque será para a bela modelo Nicole Bahls, namorada do zagueiro r" --post_category='filosofia'
rm -f /tmp/wp-post-361.html

echo '  [363/375] post: PROGRAD da UFRB promove I Seminário de Docência Un...'
$WP post create --post_type="post" --post_title="PROGRAD da UFRB promove I Seminário de Docência Universitária" --post_status="publish" --post_content="$(cat /tmp/wp-post-362.html)" --post_date="2012-03-27T14:26:00.002-07:00" --post_excerpt="O Núcleo de Formação para Docência do Ensino Superior (NUFORDES), coordenado pelo prof. Neilton da Silva, vinculado à Coordenadoria de Ensino e Integração Acadêmica (CEIAC), da Pró-reitoria de Graduação da UFRB, tem a honra de convidá-lo(a) para participar do Iº Seminário de Docência Universitári" --post_category='educacao'
rm -f /tmp/wp-post-362.html

echo '  [364/375] post: VI ENCONTRO ESTADUAL DE HISTÓRIA da ANPUH/BA e XXI...'
$WP post create --post_type="post" --post_title="VI ENCONTRO ESTADUAL DE HISTÓRIA da ANPUH/BA e XXIII CICLO DE ESTUDOS HISTÓRICOS da UESC" --post_status="publish" --post_content="$(cat /tmp/wp-post-363.html)" --post_date="2012-03-27T13:48:00.001-07:00" --post_excerpt="POVOS INDÍGENAS, AFRICANIDADES E DIVERSIDADE CULTURAL

CAMPUS DA UESC – ILHÉUS/BA, 13 A 16 DE AGOSTO DE 2012



A Comissão Organizadora do VI Encontro Estadual de História, informa aos associados e ao público em geral que as inscrições de propostas de MINI CURSOS encontram-se abertas para o evento" --post_category='cultura'
rm -f /tmp/wp-post-363.html

echo '  [365/375] post: UFRB divulga Edital e realiza Concurso para Profes...'
$WP post create --post_type="post" --post_title="UFRB divulga Edital e realiza Concurso para Professor Substituto" --post_status="publish" --post_content="$(cat /tmp/wp-post-364.html)" --post_date="2012-03-27T13:22:00.000-07:00" --post_excerpt="Divulgamos abaixo os links e informações básicas para os interessados em participar do Processo Seletivo para Professores Substitutos na UFRB em três diferentes áreas de conhecimento. Confira os detalhes e participe.

Professor Substituto - Edital Nº 03/2012 CFP| Imprimir 



Veja o Edital e outras" --post_category='educacao'
rm -f /tmp/wp-post-364.html

echo '  [366/375] livro: CURSO DE LIBRAS INTERMEDIÁRIO...'
$WP post create --post_type="livro" --post_title="CURSO DE LIBRAS INTERMEDIÁRIO" --post_status="publish" --post_content="$(cat /tmp/wp-post-365.html)" --post_date="2012-03-27T12:55:00.000-07:00" --post_excerpt="CURSO DE LIBRAS INTERMEDIÁRIO (EXTENSIVO - 60h) para ouvintes - CAS WILSON LINS BAHIAAtenção! Ainda temos vagas para o curso Intermediário de Libras no Colégio Cas Wilson Lins!!As aulas acontecerão as segundas e quartas, das 08 as 12h.O curso iniciará no dia 02/04 e finalizará no dia 06/06.Com o ..."
rm -f /tmp/wp-post-365.html

echo '  [367/375] post: CONCURSO: Prefeitura de Amargosa prorroga inscriçõ...'
$WP post create --post_type="post" --post_title="CONCURSO: Prefeitura de Amargosa prorroga inscrições para 535 vagas" --post_status="publish" --post_content="$(cat /tmp/wp-post-366.html)" --post_date="2012-03-25T15:39:00.002-07:00" --post_excerpt="São 190 vagas efetivas e 345 para cadastro de reserva.Os salários vão de R$ 622 a R$ 8.000.









Comente agora





saiba mais
CONFIRA A LISTA COMPLETA DE CONCURSOS E OPORTUNIDADES
Veja o edital no site da Fundação de Administração e Pesquisa Econômico-Social



A Prefeitura de Amargosa (BA)" --post_category='filosofia'
rm -f /tmp/wp-post-366.html

echo '  [368/375] post: Assista Futebol Aqui - Ao Vivo e Grátis...'
$WP post create --post_type="post" --post_title="Assista Futebol Aqui - Ao Vivo e Grátis" --post_status="publish" --post_content="$(cat /tmp/wp-post-367.html)" --post_date="2012-03-24T15:26:00.001-07:00" --post_excerpt="http://www.esportetvonline.com.br/" --post_category='cultura'
rm -f /tmp/wp-post-367.html

echo '  [369/375] post: ARRISCANDO O VERSO[1]...'
$WP post create --post_type="post" --post_title="ARRISCANDO O VERSO[1]" --post_status="publish" --post_content="$(cat /tmp/wp-post-368.html)" --post_date="2012-03-24T13:13:00.001-07:00" --post_excerpt="Irenilson de Jesus
Barbosa



Mulher linda, embebida em paixão pela palavra, que afaga e ressoa, 

No olhar sedutor que afeiçoa e me faz arriscar-me nos versos; 

Na inteireza da linda pessoa, na canção que em mim já entoa, 

No pulsar destes versos em loas, dou-te logo meu texto inconverso.



En" --post_category='filosofia'
rm -f /tmp/wp-post-368.html

echo '  [370/375] publicacao: MORREU CHICO ANYSIO... UMA HOMENAGEM EM VERSOS AO ...'
$WP post create --post_type="publicacao" --post_title="MORREU CHICO ANYSIO... UMA HOMENAGEM EM VERSOS AO MAIOR HUMORISTA BRASILEIRO" --post_status="publish" --post_content="$(cat /tmp/wp-post-369.html)" --post_date="2012-03-23T15:38:00.000-07:00" --post_excerpt="Chico Anísio, interpretando o Professor Raimundo, encenando o seu famoso
 bordão que criticava os baixos salários dos professores: “... E o 
salário ó!”. Morreu sem ver as mudanças que todos desejamos... 

Morreu às 14h52 desta sexta-feira (23), aos 80 anos, o humorista Chico Anysio.
 Segundo nota"
rm -f /tmp/wp-post-369.html

echo '  [371/375] post: 21 de março – Dia Internacional pela Eliminação da...'
$WP post create --post_type="post" --post_title="21 de março – Dia Internacional pela Eliminação da Discriminação Racial" --post_status="publish" --post_content="$(cat /tmp/wp-post-370.html)" --post_date="2012-03-21T07:41:00.000-07:00" --post_excerpt="A Organização das Nações Unidas - ONU - instituiu o dia 21 de março como o Dia Internacional de Luta pela Eliminação da Discriminação Racial em memória do Massacre de Shaperville. Em 21 de março de 1960, 20.000 negros protestavam contra a lei do passe, que os obrigava a portar cartões de identifi" --post_category='filosofia'
rm -f /tmp/wp-post-370.html

echo '  [372/375] material: PARFOR Presencial oferece mais de 14 mil vagas par...'
$WP post create --post_type="material" --post_title="PARFOR Presencial oferece mais de 14 mil vagas para formação de professores em todo o Brasil" --post_status="publish" --post_content="$(cat /tmp/wp-post-371.html)" --post_date="2012-03-20T15:42:00.000-07:00" --post_excerpt="Na UFRB serão mais 150 novas vagas nos cursos do PARFOR em 2012.2






A partir desta terça-feira, 20, estão abertas as pré-inscrições para o Plano Nacional de Formação dos Professores da Educação Básica – Parfor Presencial. Serão oferecidas 14.277 mil vagas para cursos que terão início no segundo"
rm -f /tmp/wp-post-371.html

echo '  [373/375] post: Governo promete investir R$ 1,8 bilhões para const...'
$WP post create --post_type="post" --post_title="Governo promete investir R$ 1,8 bilhões para construir 20 mil escolas no campo" --post_status="publish" --post_content="$(cat /tmp/wp-post-372.html)" --post_date="2012-03-20T13:11:00.000-07:00" --post_excerpt="Maurício Savarese, do UOL, em Brasília

Roberto Stuckert Filho/PR




A presidente Dilma Rousseff e o ministro Aloizio Mercadante durante o lançamento do Pronacampo

Projeto cria regra mais rígida para evitar fechamento de escolas do campo



O governo federal lançou nesta terça-feira (20) o Prona" --post_category='educacao'
rm -f /tmp/wp-post-372.html

echo '  [374/375] publicacao: PUBLICAMOS O RELATÓRIO DE NOTAS DO COMPONENTE OEBP...'
$WP post create --post_type="publicacao" --post_title="PUBLICAMOS O RELATÓRIO DE NOTAS DO COMPONENTE OEBPP - Organização da Educação Brasileira e Políticas Píublicas (Turma 03 - Mista/Vespertina)" --post_status="publish" --post_content="$(cat /tmp/wp-post-373.html)" --post_date="2012-03-15T17:04:00.000-07:00" --post_excerpt="NOTAS
 DE OEBPP - CFP 156 

Prof.
 IRENILSON - TURMA 03 - MISTA 

NOMES 

 
 
Prova

 
 
Seminários

 
 
Produção de textos e Atividades em
 classe

 
 
Média

 
 
Situação

 

 
 
FABRÍCIO SANTIAGO PEIXOTO

 
 
7,4

 
 
8

 
 
10

 
 
8,5

 
 
AP

 

 
 
CLEISIANE OLIVEIRA DA SILVA

 
 
9,"
rm -f /tmp/wp-post-373.html

echo '  [375/375] publicacao: RELATÓRIO DE NOTAS DE ORGANIZAÇÃO DA EDUCAÇÃO BRAS...'
$WP post create --post_type="publicacao" --post_title="RELATÓRIO DE NOTAS DE ORGANIZAÇÃO DA EDUCAÇÃO BRASILEIRA E POLÍTICAS PÚBLICAS - CFP 151 - Prof. Irenilson Barbosa (I Sem./Pedagogia - Noturno)" --post_status="publish" --post_content="$(cat /tmp/wp-post-374.html)" --post_date="2012-03-15T14:35:00.001-07:00"
rm -f /tmp/wp-post-374.html

echo ""
echo "Resumo: 224 artigos, 81 publicações, 25 livros, 45 materiais"
echo "Total: 375 posts"