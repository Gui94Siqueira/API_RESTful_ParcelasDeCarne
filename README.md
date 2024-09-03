# API RESTful para Parcelas de Carnê

## Descrição do Problema

Esta API RESTful em PHP foi desenvolvida para gerar e apresentar as parcelas de um carnê. A API recebe os seguintes parâmetros:

- **valor_total**: O valor total do carnê.
- **qtd_parcelas**: A quantidade de parcelas.
- **data_primeiro_vencimento**: A data do primeiro vencimento das parcelas (formato YYYY-MM-DD).
- **periodicidade**: A periodicidade das parcelas (valores possíveis: "mensal", "semanal").
- **valor_entrada** (opcional): Um valor de entrada.

A resposta da API inclui o valor total, o valor de entrada (se houver) e uma lista de parcelas, onde cada parcela contém a data de vencimento, o valor, e o número da parcela. A soma total das parcelas é sempre igual ao valor total enviado. Se houver um valor de entrada, ele será tratado como uma parcela independente, sem necessidade de respeitar a periodicidade e com a propriedade `entrada=true`.

## Funcionalidades da API

### 1. Criação de um Carnê

**Parâmetros de entrada:**
- `valor_total` (float): O valor total do carnê.
- `qtd_parcelas` (int): A quantidade de parcelas.
- `data_primeiro_vencimento` (string, formato YYYY-MM-DD): A data do primeiro vencimento.
- `periodicidade` (string): Periodicidade das parcelas ("mensal" ou "semanal").
- `valor_entrada` (float, opcional): O valor de entrada.

**Resposta em JSON:**
```json
{
  "total": 100.00,
  "valor_entrada": 0.10,
  "parcelas": [
    {
      "data_vencimento": "2024-08-01",
      "valor": 5.00,
      "numero": 1,
      "entrada": true
    },
    ...
  ]
}
