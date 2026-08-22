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

- **Linguagem:** PHP (Puro)
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
   git clone https://github.com/FInhoCode/Rastreador_De_Despesas.git
   cd Rastreador_De_Despesas
   ```

2. **Execute a aplicação:**
   Você não precisa de um servidor local (XAMPP, WAMP, Docker, etc.). Basta abrir o terminal no diretório do projeto (ou no terminal da sua IDE) e executar:

   ```bash
   php index.php
   ```

---

## 📜 Licença

Este projeto é de uso livre e acadêmico. Fique à vontade para estudar, clonar e modificar conforme suas necessidades!