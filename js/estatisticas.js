
window.addEventListener("DOMContentLoaded", () => {
  fetch("estatisticas_dados.php")
    .then(response => response.json())
    .then(dados => {
      preencherVisaoGeral(dados.visaoGeral);
      preencherTabelaCategorias(dados.detalhesCategorias);
      preencherTabelaLucrativos(dados.produtosLucrativos);
      preencherTabelaEstoqueBaixo(dados.estoqueBaixo);
      renderizarGraficos(dados.graficos);
    })
    .catch(error => {
      console.error("Erro ao buscar estatísticas:", error);
    });
});

function preencherVisaoGeral(d) {
  document.getElementById("total-produtos").textContent = d.totalProdutos;
  document.getElementById("total-itens").textContent = d.totalItens;
  document.getElementById("valor-estoque").textContent = formatarMoeda(d.valorEstoque);
  document.getElementById("estoque-baixo").textContent = d.estoqueBaixo;
  document.getElementById("valor-custo").textContent = formatarMoeda(d.valorCusto);
  document.getElementById("valor-venda").textContent = formatarMoeda(d.valorVenda);
  document.getElementById("lucro-potencial").textContent = formatarMoeda(d.lucroPotencial);
  document.getElementById("margem-media").textContent = d.margemMedia.toFixed(1) + "%";
}

function preencherTabelaCategorias(detalhes) {
  const tbody = document.getElementById("tabela-categorias");
  tbody.innerHTML = "";

  detalhes.forEach(cat => {
    const tr = document.createElement("tr");
    tr.innerHTML = `
      <td>${cat.nome}</td>
      <td>${cat.totalProdutos}</td>
      <td>${cat.quantidadeTotal}</td>
      <td>${formatarMoeda(cat.valorTotal)}</td>
      <td>${formatarMoeda(cat.lucroPotencial)}</td>
    `;
    tbody.appendChild(tr);
  });
}

function preencherTabelaLucrativos(produtos) {
  const tbody = document.getElementById("tabela-lucrativos");
  tbody.innerHTML = "";

  produtos.forEach(prod => {
    const tr = document.createElement("tr");
    tr.innerHTML = `
      <td>${prod.nome}</td>
      <td>${prod.categoria}</td>
      <td>${formatarMoeda(prod.custo)}</td>
      <td>${formatarMoeda(prod.valor_venda)}</td>
      <td>${prod.margem}%</td>
      <td>${formatarMoeda(prod.lucroUnidade)}</td>
    `;
    tbody.appendChild(tr);
  });
}

function preencherTabelaEstoqueBaixo(produtos) {
  const tbody = document.getElementById("tabela-estoque-baixo");
  tbody.innerHTML = "";

  produtos.forEach(prod => {
    const tr = document.createElement("tr");
    const status = prod.estoque < prod.minimo ? "<span class='text-danger'>Baixo</span>" : "Ok";
    tr.innerHTML = `
      <td>${prod.nome}</td>
      <td>${prod.categoria}</td>
      <td>${prod.estoque}</td>
      <td>${prod.minimo}</td>
      <td>${status}</td>
    `;
    tbody.appendChild(tr);
  });
}

function formatarMoeda(valor) {
  return valor.toLocaleString("pt-BR", {
    style: "currency",
    currency: "BRL"
  });
}

function renderizarGraficos(dados) {
  // Apaga gráficos antigos se existirem
  if (Chart.getChart("chart-categorias")) Chart.getChart("chart-categorias").destroy();
  if (Chart.getChart("chart-valor-categorias")) Chart.getChart("chart-valor-categorias").destroy();
  if (Chart.getChart("chart-categorias-detalhado")) Chart.getChart("chart-categorias-detalhado").destroy();
  if (Chart.getChart("chart-margem-lucro")) Chart.getChart("chart-margem-lucro").destroy();
  if (Chart.getChart("chart-estoque")) Chart.getChart("chart-estoque").destroy();

  new Chart(document.getElementById("chart-categorias"), {
    type: "bar",
    data: {
      labels: dados.categorias,
      datasets: [{
        label: "Qtd. Produtos",
        data: dados.produtosPorCategoria,
        backgroundColor: "#0d6efd"
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { display: false },
        tooltip: { mode: 'index', intersect: false }
      },
      scales: {
        y: { beginAtZero: true }
      }
    }
  });

  new Chart(document.getElementById("chart-valor-categorias"), {
    type: "pie",
    data: {
      labels: dados.categorias,
      datasets: [{
        label: "Valor Total",
        data: dados.valorPorCategoria,
        backgroundColor: [
          "#0d6efd", "#198754", "#ffc107", "#dc3545", "#6610f2",
          "#20c997", "#fd7e14", "#6f42c1", "#0dcaf0"
        ]
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { position: "bottom" }
      }
    }
  });

  new Chart(document.getElementById("chart-categorias-detalhado"), {
    type: "bar",
    data: {
      labels: dados.categorias,
      datasets: [{
        label: "Qtd. Produtos",
        data: dados.produtosPorCategoria,
        backgroundColor: "#20c997"
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { display: false },
        tooltip: { mode: 'index', intersect: false }
      },
      scales: {
        y: { beginAtZero: true }
      }
    }
  });

  new Chart(document.getElementById("chart-margem-lucro"), {
    type: "bar",
    data: {
      labels: dados.categorias,
      datasets: [{
        label: "Margem (%)",
        data: dados.margemPorCategoria,
        backgroundColor: "#ffc107"
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { display: false },
        tooltip: { mode: 'index', intersect: false }
      },
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            callback: function(value) {
              return value + '%';
            }
          }
        }
      }
    }
  });

  new Chart(document.getElementById("chart-estoque"), {
    type: "bar",
    data: {
      labels: dados.categorias,
      datasets: [{
        label: "Qtd. em Estoque",
        data: dados.estoquePorCategoria,
        backgroundColor: "#dc3545"
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { display: false },
        tooltip: { mode: 'index', intersect: false }
      },
      scales: {
        y: { beginAtZero: true }
      }
    }
  });
}
