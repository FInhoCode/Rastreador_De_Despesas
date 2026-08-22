# 💰 Rastreador de Despesas

Um sistema em linha de comando (CLI) simples, leve e eficiente para gerenciamento e controle de despesas pessoais, desenvolvido em **PHP puro** com **programação estruturada** e persistência de dados em formato **JSON**.

Inspirado no desafio [Expense Tracker do roadmap.sh](https://roadmap.sh/projects/expense-tracker).

---

## 📌 Sumário

- [Sobre o Projeto](#-sobre-o-projeto)
- [Funcionalidades](#-funcionalidades)
- [Arquitetura e Tecnologias](#-arquitetura-e-tecnologias)
- [Pré-requisitos](#-pré-requisitos)
- [Como Instalar e Executar](#-como-instalar-e-executar)
- [Exemplos de Uso](#-exemplos-de-uso)
- [Estrutura do Arquivo de Dados](#-estrutura-do-arquivo-de-dados)
- [Licença](#-licença)

---

## 📑 Sobre o Projeto

O **Expense Tracker CLI** é uma aplicação para terminal criada para ajudar desenvolvedores e usuários a monitorar seus gastos diários sem a necessidade de interfaces gráficas complexas ou bancos de dados pesados.

O objetivo principal é oferecer uma solução direta para registrar, visualizar, filtrar e remover despesas de forma rápida e prática.

---

## ✨ Funcionalidades

- ➕ **Adicionar despesas:** Registre novas despesas com descrição e valor.
- 📋 **Listar despesas:** Visualize todas as despesas cadastradas em tabela/lista formatada.
- 🗑️ **Deletar despesas:** Remova registros antigos ou incorretos utilizando o ID.
- 📊 **Resumo financeiro (Summary):**
  - Visualize o valor total de todas as despesas acumuladas.
  - Filtre o resumo total por mês específico.
- 💾 **Persistência em JSON:** Salva automaticamente todos os dados em um arquivo `.json` local.

---

## 🛠️ Arquitetura e Tecnologias

- **Linguagem:** PHP (Puro / Standard Library)
- **Paradigma:** Programação Estruturada
- **Armazenamento:** Arquivo `JSON` local (não requer banco de dados SQL)
- **Execução:** CLI (Command Line Interface) — sem necessidade de servidor web como Apache ou Nginx.

---

## ⚙️ Pré-requisitos

Para rodar este projeto, você precisa apenas ter o **PHP** instalado em sua máquina (versão 7.4 ou superior recomendada).

Para verificar se o PHP está instalado, abra o terminal e execute:

```bash
php -v
```

---

## 🚀 Como Instalar e Executar

1. **Clone o repositório** (ou faça o download dos arquivos):
   ```bash
   git clone https://github.com/seu-usuario/seu-repositorio.git
   cd seu-repositorio
   ```

2. **Execute a aplicação:**
   Você não precisa de um servidor local (XAMPP, WAMP, Docker, etc.). Basta abrir o terminal no diretório do projeto (ou no terminal da sua IDE) e executar:

   ```bash
   php index.php
   ```

---

## 💡 Exemplos de Uso

Abaixo estão alguns exemplos de como interagir com o CLI:

### 1. Adicionar uma nova despesa
```bash
php index.php add --description "Almoço" --amount 25.50
# Saída esperada: Despesa adicionada com sucesso (ID: 1)
```

### 2. Listar todas as despesas
```bash
php index.php list
# Saída esperada:
# ID  Data        Descrição  Valor
# 1   2026-08-22  Almoço     R$ 25.50
```

### 3. Exibir o resumo total de gastos
```bash
php index.php summary
# Saída esperada: Total de despesas: R$ 25.50
```

### 4. Exibir o resumo de um mês específico
```bash
php index.php summary --month 8
# Saída esperada: Total de despesas no mês 8: R$ 25.50
```

### 5. Deletar uma despesa pelo ID
```bash
php index.php delete --id 1
# Saída esperada: Despesa deletada com sucesso
```

---

## 📁 Estrutura do Arquivo de Dados

Os dados são armazenados localmente no formato JSON (geralmente em um arquivo `expenses.json`). Exemplo da estrutura interna:

```json
[
  {
    "id": 1,
    "date": "2026-08-22",
    "description": "Almoço",
    "amount": 25.50
  }
]
```

---

## 📜 Licença

Este projeto é de uso livre e acadêmico. Fique à vontade para estudar, clonar e modificar conforme suas necessidades!