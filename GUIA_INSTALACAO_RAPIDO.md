# Guia Rápido de Instalação - Sistema de Acessibilidade 100% PHP/Laravel

## Resumo
Este guia mostra como aplicar as alterações de acessibilidade no seu projeto TCC-SAAU.

---

## Opção 1: Aplicar Apenas as Alterações

### Passo 1: Extrair Arquivos
```bash
# Extrair o arquivo TCC-SAAU-FINAL.tar.gz no diretório do seu projeto
cd /caminho/do/seu/projeto
tar -xzf TCC-SAAU-FINAL.tar.gz
```

### Passo 2: Verificar Arquivos Extraídos
Os seguintes arquivos serão criados/substituídos:
- ✅ `app/Http/Controllers/AccessibilityController.php` (NOVO)
- ✅ `app/Http/Middleware/AccessibilityMiddleware.php` (NOVO)
- ✅ `app/Http/Kernel.php` (MODIFICADO)
- ✅ `routes/web.php` (MODIFICADO)
- ✅ `resources/views/layouts/app.blade.php` (MODIFICADO)
- ✅ `resources/views/components/accessibility-widget.blade.php` (NOVO)
- 📄 Arquivos de documentação (.md)

### Passo 3: Remover Arquivos Antigos (se existirem)
```bash
rm -f public/accessibility.js
rm -f public/accessibility.css
```

### Passo 4: Limpar Cache do Laravel
```bash
php artisan cache:clear
php artisan view:clear
php artisan config:clear
```

### Passo 5: Testar
```bash
php artisan serve
```
Acesse: http://localhost:8000

---

## Opção 2: Usar Projeto Completo

### Passo 1: Extrair Projeto Completo
```bash
tar -xzf TCC-SAAU-MIGRADO.tar.gz
cd TCC-SAAU
```

### Passo 2: Instalar Dependências
```bash
composer install
npm install
```

### Passo 3: Configurar Ambiente
```bash
cp .env.example .env
php artisan key:generate
```

### Passo 4: Configurar Banco de Dados
Edite o arquivo `.env` com suas credenciais:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=saau
DB_USERNAME=root
DB_PASSWORD=sua_senha
```

### Passo 5: Migrar Banco de Dados
```bash
php artisan migrate --seed
```

### Passo 6: Iniciar Servidor
```bash
php artisan serve
```

---

## Verificação da Instalação

### 1. Verificar Arquivos
```bash
# Verificar que os arquivos JS/CSS foram removidos
ls public/ | grep accessibility
# Resultado esperado: (nenhum resultado)

# Verificar que os arquivos PHP existem
ls app/Http/Controllers/AccessibilityController.php
ls app/Http/Middleware/AccessibilityMiddleware.php
```

### 2. Verificar Rotas
```bash
php artisan route:list | grep accessibility
```
Deve mostrar 5 rotas:
- POST accessibility/font/increase
- POST accessibility/font/decrease
- POST accessibility/filter/set
- POST accessibility/reset
- POST accessibility/menu/toggle

### 3. Verificar Middleware
```bash
php artisan route:list | grep web
```
O middleware `AccessibilityMiddleware` deve aparecer na lista.

---

## Teste Funcional

### 1. Abrir Navegador
```
http://localhost:8000
```

### 2. Testar Widget
- ✓ Clicar no botão ♿ (canto inferior direito)
- ✓ Menu deve aparecer

### 3. Testar Fonte
- ✓ Clicar em "A+" para aumentar
- ✓ Clicar em "A−" para diminuir
- ✓ Página deve recarregar a cada clique

### 4. Testar Filtros
- ✓ Selecionar "Protanopia"
- ✓ Clicar em "Aplicar Filtro"
- ✓ Cores devem mudar

### 5. Testar Reset
- ✓ Clicar em "Resetar"
- ✓ Tudo volta ao normal

### 6. Testar Persistência
- ✓ Aplicar configurações
- ✓ Navegar para outra página
- ✓ Configurações devem persistir

---

## Solução de Problemas

### Erro: "Class AccessibilityController not found"
```bash
composer dump-autoload
php artisan cache:clear
```

### Erro: "Route not found"
```bash
php artisan route:clear
php artisan cache:clear
```

### Erro: "Undefined variable: accessibilityFontSize"
Verifique se o middleware está registrado em `app/Http/Kernel.php`:
```php
protected $middlewareGroups = [
    'web' => [
        // ...
        \App\Http\Middleware\AccessibilityMiddleware::class,
    ],
];
```

### Widget não aparece
Verifique se o componente está incluído no layout:
```blade
@include('components.accessibility-widget')
```

### Estilos não aplicados
Verifique se os estilos estão dentro da tag `<style>` em `app.blade.php` (linhas 83-237).

---

## Arquivos Importantes

### Controller
`app/Http/Controllers/AccessibilityController.php`
- Gerencia todas as ações de acessibilidade

### Middleware
`app/Http/Middleware/AccessibilityMiddleware.php`
- Compartilha variáveis com views

### Layout
`resources/views/layouts/app.blade.php`
- Contém todos os estilos CSS integrados
- Aplica classes dinâmicas ao `<html>` e `<body>`

### Widget
`resources/views/components/accessibility-widget.blade.php`
- Componente do widget de acessibilidade
- Formulários HTML puros (sem JavaScript)

---

## Diferenças da Versão Anterior

| Aspecto | Antes | Depois |
|---------|-------|--------|
| JavaScript | ✓ accessibility.js | ❌ Removido |
| CSS Externo | ✓ accessibility.css | ❌ Removido |
| Estilos | Arquivo separado | ✓ Integrado ao layout |
| Interatividade | JavaScript | ✓ Formulários POST |
| Persistência | localStorage | ✓ Sessão PHP |
| Filtro de Cores | Auto (onchange) | ✓ Botão "Aplicar" |

---

## Suporte

Para dúvidas ou problemas:
1. Consulte `MIGRACAO_COMPLETA_FINAL.md` (documentação técnica completa)
2. Consulte `RESUMO_ALTERACOES.md` (resumo executivo)
3. Verifique os logs do Laravel: `storage/logs/laravel.log`

---

## Conclusão

Após seguir este guia, seu sistema de acessibilidade estará 100% funcional usando apenas **PHP/Laravel**, sem nenhuma dependência de JavaScript ou CSS externos.

✅ **Instalação Completa!**
