document.addEventListener("DOMContentLoaded", () => {
  fetch("../pages/estatisticas_dados.php")
    .then(response => response.json())
    .then(dados => {
      atualizarVisaoGeral(dados.visaoGeral);
      preencherTabelaCategorias(dados.detalhesCategorias);
      preencherTabelaLucrativos(dados.produtosLucrativos);
      preencherTabelaEstoqueBaixo(dados.estoqueBaixo);
      renderizarGraficos(dados.graficos);
    })
    .catch(error => console.error("Erro ao carregar estatísticas:", error));
});

function atualizarVisaoGeral(geral) {
  document.getElementById("total-produtos").innerText = geral.totalProdutos;
  document.getElementById("total-itens").innerText = geral.totalItens;
  document.getElementById("valor-estoque").innerText = "R$ " + geral.valorEstoque.toFixed(2);
  document.getElementById("estoque-baixo").innerText = geral.estoqueBaixo;
  document.getElementById("valor-custo").innerText = "R$ " + geral.valorCusto.toFixed(2);
  document.getElementById("valor-venda").innerText = "R$ " + geral.valorVenda.toFixed(2);
  document.getElementById("lucro-potencial").innerText = "R$ " + geral.lucroPotencial.toFixed(2);
  document.getElementById("margem-media").innerText = geral.margemMedia.toFixed(1) + "%";
}

function preencherTabelaCategorias(categorias) {
  const tbody = document.getElementById("tabela-categorias");
  tbody.innerHTML = "";
  categorias.forEach(cat => {
    const linha = `
      <tr>
        <td>${cat.nome}</td>
        <td>${cat.totalProdutos}</td>
        <td>${cat.quantidadeTotal}</td>
        <td>R$ ${cat.valorTotal.toFixed(2)}</td>
        <td>R$ ${cat.lucroPotencial.toFixed(2)}</td>
      </tr>`;
    tbody.innerHTML += linha;
  });
}

function preencherTabelaLucrativos(produtos) {
  const tbody = document.getElementById("tabela-lucrativos");
  tbody.innerHTML = "";
  produtos.forEach(p => {
    const linha = `
      <tr>
        <td>${p.nome}</td>
        <td>${p.categoria}</td>
        <td>R$ ${p.custo.toFixed(2)}</td>
        <td>R$ ${p.venda.toFixed(2)}</td>
        <td>${p.margem.toFixed(1)}%</td>
        <td>R$ ${p.lucroUnidade.toFixed(2)}</td>
      </tr>`;
    tbody.innerHTML += linha;
  });
}

function preencherTabelaEstoqueBaixo(produtos) {
  const tbody = document.getElementById("tabela-estoque-baixo");
  tbody.innerHTML = "";
  produtos.forEach(p => {
    const linha = `
      <tr>
        <td>${p.nome}</td>
        <td>${p.categoria}</td>
        <td>${p.estoque}</td>
        <td>${p.minimo}</td>
        <td><span class="badge bg-danger">Baixo</span></td>
      </tr>`;
    tbody.innerHTML += linha;
  });
}

function renderizarGraficos(graficos) {
  const cores = ['#0d6efd', '#198754', '#ffc107', '#dc3545', '#6f42c1', '#20c997', '#fd7e14'];

  new Chart(document.getElementById("chart-categorias"), {
    type: "bar",
    data: {
      labels: graficos.categorias,
      datasets: [{
        label: "Qtd. Produtos",
        backgroundColor: cores,
        data: graficos.produtosPorCategoria
      }]
    }
  });

  new Chart(document.getElementById("chart-valor-categorias"), {
    type: "pie",
    data: {
      labels: graficos.categorias,
      datasets: [{
        label: "Valor Total",
        backgroundColor: cores,
        data: graficos.valorPorCategoria
      }]
    }
  });

  new Chart(document.getElementById("chart-margem-lucro"), {
    type: "bar",
    data: {
      labels: graficos.categorias,
      datasets: [{
        label: "Margem Média (%)",
        backgroundColor: cores,
        data: graficos.margemPorCategoria
      }]
    }
  });

  new Chart(document.getElementById("chart-estoque"), {
    type: "doughnut",
    data: {
      labels: graficos.categorias,
      datasets: [{
        label: "Qtd. Estoque",
        backgroundColor: cores,
        data: graficos.estoquePorCategoria
      }]
    }
  });
}
