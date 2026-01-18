## betPagando

Aplicação Laravel para listar jogos de slots por provedor com métricas de RTP e visualização rápida.

### Visão geral
- Provedores organizados em cards.
- RTP mínimo, médio e máximo por provedor.
- Lista de jogos com RTP e metadados.
- Gráficos de barras simples (CSS) para comparação rápida.

### Requisitos
- PHP 8.2+
- Composer
- MySQL (XAMPP)

### Configuração rápida
1. Crie um banco MySQL chamado betPagando.
2. Ajuste as credenciais no arquivo .env se necessário.
3. Rode as migrations e o seeder para dados iniciais.
4. Inicie o servidor de desenvolvimento.

### Estrutura principal
- Controller: SlotCatalogController
- View: resources/views/slots/index.blade.php
- Migrations: providers e slot_games
- Seeder: SlotCatalogSeeder

### Notas sobre os dados
Os dados de RTP e jogos são exemplos iniciais e devem ser validados e atualizados conforme a fonte oficial de cada provedor.

### Notas sobre imagens
As imagens em public/images (incluindo logos de provedores) são ilustrações de placeholder e devem ser substituídas por artes finais.

### Pesquisa resumida (para aprimoramento)
- RTP é um indicador estatístico de retorno a longo prazo; o valor individual por jogo pode variar por configuração e jurisdição.
- Para confiabilidade, mantenha o RTP e metadados versionados por provedor e data de revisão.
- Estruture a base por provedores e categorias para otimizar filtros e comparações.
- Considere armazenar múltiplas configurações de RTP por jogo quando o provedor disponibilizar versões diferentes.
- Gráficos simples ajudam no comparativo, mas um painel com filtros por RTP, volatilidade e data de lançamento melhora a usabilidade.
